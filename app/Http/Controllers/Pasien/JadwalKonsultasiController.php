<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\TenagaMedis;
use App\Models\JadwalPraktik;
use App\Models\BookingKonsultasi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class JadwalKonsultasiController extends Controller
{
    private function namaHariIndonesia(string $tanggal): string
    {
        $hari = Carbon::parse($tanggal)->format('l');

        return [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu',
        ][$hari];
    }

    public function index(Request $request)
    {
        $selectedDate = $request->tanggal ?? now()->format('Y-m-d');
        $hariDipilih = $this->namaHariIndonesia($selectedDate);

        $spesialisList = TenagaMedis::where('is_active', 1)
            ->whereNotNull('spesialis')
            ->distinct()
            ->orderBy('spesialis')
            ->pluck('spesialis');

        $dokters = TenagaMedis::with([
                'jadwalPraktik' => function ($query) use ($hariDipilih) {
                    $query->where('is_active', 1)
                        ->where('hari', $hariDipilih)
                        ->orderBy('jam_mulai');
                }
            ])
            ->where('is_active', 1)
            ->whereHas('jadwalPraktik', function ($query) use ($hariDipilih) {
                $query->where('is_active', 1)
                    ->where('hari', $hariDipilih);
            })
            ->when($request->spesialis, function ($query) use ($request) {
                $query->where('spesialis', $request->spesialis);
            })
            ->latest()
            ->get();

        return view('pasien.jadwal-konsultasi.index', compact(
            'dokters',
            'spesialisList',
            'selectedDate',
            'hariDipilih'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tenaga_medis_id' => 'required|exists:tenaga_medis,id',
            'jadwal_praktik_id' => 'required|exists:jadwal_praktiks,id',
            'tanggal_konsultasi' => 'required|date|after_or_equal:today',
            'jam_konsultasi' => 'required',
            'keluhan' => 'required|string|max:1000',
        ]);

        $hariDipilih = $this->namaHariIndonesia($request->tanggal_konsultasi);

        $jadwal = JadwalPraktik::where('id', $request->jadwal_praktik_id)
            ->where('tenaga_medis_id', $request->tenaga_medis_id)
            ->where('hari', $hariDipilih)
            ->where('is_active', 1)
            ->first();

        if (!$jadwal) {
            return response()->json([
                'success' => false,
                'message' => 'Dokter tidak memiliki jadwal praktik pada tanggal yang dipilih.'
            ], 422);
        }

        $jamMulai = Carbon::parse($jadwal->jam_mulai)->format('H:i');
        $jamSelesai = Carbon::parse($jadwal->jam_selesai)->format('H:i');
        $jamBooking = Carbon::parse($request->jam_konsultasi)->format('H:i');

        if ($jamBooking < $jamMulai || $jamBooking > $jamSelesai) {
            return response()->json([
                'success' => false,
                'message' => 'Jam booking berada di luar jam praktik dokter.'
            ], 422);
        }

        $totalBooking = BookingKonsultasi::where('jadwal_praktik_id', $jadwal->id)
            ->whereDate('tanggal_konsultasi', $request->tanggal_konsultasi)
            ->where('status', '!=', 'batal')
            ->count();

        if ($totalBooking >= $jadwal->kuota) {
            return response()->json([
                'success' => false,
                'message' => 'Kuota jadwal ini sudah penuh. Silakan pilih jadwal lain.'
            ], 422);
        }

        $nomorUrut = $totalBooking + 1;

        $booking = BookingKonsultasi::create([
            'user_id' => auth()->id(),
            'tenaga_medis_id' => $request->tenaga_medis_id,
            'jadwal_praktik_id' => $jadwal->id,
            'tanggal_konsultasi' => $request->tanggal_konsultasi,
            'jam_konsultasi' => $jamBooking,
            'keluhan' => $request->keluhan,
            'nomor_antrian' => 'A-' . str_pad($nomorUrut, 3, '0', STR_PAD_LEFT),
            'kode_booking' => 'BK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5)),
            'status' => 'menunggu',
        ]);

        Pembayaran::create([
            'booking_konsultasi_id' => $booking->id,
            'invoice_no' => 'INV-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(4)),
            'nominal' => 50000,
            'metode' => 'Transfer Bank',
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking berhasil dibuat.',
            'nomor_antrian' => $booking->nomor_antrian,
            'kode_booking' => $booking->kode_booking,
        ]);
    }

    public function riwayat()
    {
        $bookings = BookingKonsultasi::with([
                'tenagaMedis',
                'jadwalPraktik',
                'pembayaran'
            ])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('pasien.jadwal-konsultasi.riwayat', compact('bookings'));
    }

    public function tiket(BookingKonsultasi $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $booking->load([
            'tenagaMedis',
            'jadwalPraktik',
            'pembayaran',
            'pasien',
        ]);

        if (!$booking->pembayaran || $booking->pembayaran->status !== 'dibayar') {
            return redirect()
                ->route('pasien.jadwal-konsultasi.riwayat')
                ->with('error', 'Tiket digital hanya tersedia setelah pembayaran disetujui.');
        }

        return view('pasien.jadwal-konsultasi.tiket', compact('booking'));
    }
}