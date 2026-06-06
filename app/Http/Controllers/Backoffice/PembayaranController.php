<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembayaran::with([
            'booking.pasien',
            'booking.tenagaMedis',
            'booking.jadwalPraktik',
        ]);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('metode')) {
            $query->where('metode', $request->metode);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('invoice_no', 'ILIKE', "%{$search}%")
                    ->orWhereHas('booking.pasien', function ($pasien) use ($search) {
                        $pasien->where('name', 'ILIKE', "%{$search}%")
                            ->orWhere('email', 'ILIKE', "%{$search}%");
                    });
            });
        }

        $pembayarans = $query->latest()->paginate(10)->withQueryString();

        $totalInvoice = Pembayaran::count();

        $totalMenunggu = Pembayaran::where('status', 'menunggu_verifikasi')->count();

        $totalDibayar = Pembayaran::where('status', 'dibayar')->count();

        $totalPendapatan = Pembayaran::where('status', 'dibayar')->sum('nominal');

        return view('backoffice.pembayaran.index', compact(
            'pembayarans',
            'totalInvoice',
            'totalMenunggu',
            'totalDibayar',
            'totalPendapatan'
        ));
    }

    public function approve(Pembayaran $pembayaran)
    {
        if (!$pembayaran->bukti_bayar) {
            return back()->with('error', 'Bukti pembayaran belum diupload oleh pasien.');
        }

        $pembayaran->update([
            'status' => 'dibayar',
            'catatan' => 'Pembayaran telah diverifikasi admin.',
        ]);

        return back()->with('success', 'Pembayaran berhasil disetujui.');
    }

    public function reject(Pembayaran $pembayaran)
    {
        $pembayaran->update([
            'status' => 'ditolak',
            'catatan' => 'Pembayaran ditolak oleh admin.',
        ]);

        return back()->with('success', 'Pembayaran berhasil ditolak.');
    }
}