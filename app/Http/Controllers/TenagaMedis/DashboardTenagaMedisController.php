<?php

namespace App\Http\Controllers\TenagaMedis;

use App\Http\Controllers\Controller;
use App\Models\BookingKonsultasi;
use App\Models\TenagaMedis;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use App\Helpers\ActivityLogger;

class DashboardTenagaMedisController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $tanggal = $request->tanggal ?? now()->format('Y-m-d');

        $tenagaMedis = TenagaMedis::where('email', $user->email)
            ->orWhere('nama', $user->name)
            ->first();

        $bookings = collect();

        if ($tenagaMedis) {
            $bookings = BookingKonsultasi::with([
                    'pasien',
                    'pembayaran',
                    'tenagaMedis',
                    'jadwalPraktik'
                ])
                ->where('tenaga_medis_id', $tenagaMedis->id)
                ->whereDate('tanggal_konsultasi', $tanggal)
                ->orderBy('jam_konsultasi')
                ->get();
        }

        return view('tenaga-medis.dashboard.index', compact(
            'bookings',
            'tenagaMedis',
            'tanggal'
        ));
    }

    public function updateStatus(Request $request, BookingKonsultasi $booking)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,batal',
        ]);

        $booking->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status pasien berhasil diperbarui.');
    }

    public function createRekamMedis(BookingKonsultasi $booking)
    {
        $booking->load(['pasien', 'tenagaMedis', 'pembayaran', 'rekamMedis']);

        if ($booking->rekamMedis) {
            return redirect()
                ->route('tenaga-medis.dashboard')
                ->with('success', 'Rekam medis pasien ini sudah pernah dibuat.');
        }

        return view('tenaga-medis.rekam-medis.create', compact('booking'));
    }

    public function storeRekamMedis(Request $request, BookingKonsultasi $booking)
    {
        $request->validate([
            'diagnosa' => 'required|string|max:2000',
            'tindakan' => 'nullable|string|max:2000',
            'resep_obat' => 'nullable|string|max:2000',
            'catatan_dokter' => 'nullable|string|max:2000',
            'berat_badan' => 'nullable|numeric',
            'tinggi_badan' => 'nullable|numeric',
            'lingkar_kepala' => 'nullable|numeric',
            'suhu' => 'nullable|numeric',
            'tekanan_darah' => 'nullable|string|max:50',
        ]);

        RekamMedis::create([
            'booking_konsultasi_id' => $booking->id,
            'user_id' => $booking->user_id,
            'tenaga_medis_id' => $booking->tenaga_medis_id,
            'keluhan' => $booking->keluhan,
            'diagnosa' => $request->diagnosa,
            'tindakan' => $request->tindakan,
            'resep_obat' => $request->resep_obat,
            'catatan_dokter' => $request->catatan_dokter,
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'lingkar_kepala' => $request->lingkar_kepala,
            'suhu' => $request->suhu,
            'tekanan_darah' => $request->tekanan_darah,
            'tanggal_pemeriksaan' => now()->format('Y-m-d'),
        ]);

        $booking->update([
            'status' => 'selesai',
        ]);
        ActivityLogger::log(
            'Tambah Rekam Medis',
            'Rekam Medis',
            'Menambahkan rekam medis pasien ' . $booking->pasien->name
        );

        return redirect()
            ->route('tenaga-medis.dashboard', ['tanggal' => $booking->tanggal_konsultasi])
            ->with('success', 'Rekam medis berhasil disimpan.');
    }
}