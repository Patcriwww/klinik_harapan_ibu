<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Helpers\ActivityLogger;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('booking.tenagaMedis')
            ->latest()
            ->get();

        return view(
            'pasien.pembayaran.index',
            compact('pembayarans')
        );
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        return view(
            'pasien.pembayaran.show',
            compact('pembayaran')
        );
    }

    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|max:2048'
        ]);

        $pembayaran = Pembayaran::findOrFail($id);

        $path = $request
            ->file('bukti_bayar')
            ->store('bukti-pembayaran', 'public');

        $pembayaran->update([
            'bukti_bayar' => $path,
            'status' => 'menunggu_verifikasi'
        ]);
        ActivityLogger::log(
            'Upload Bukti Pembayaran',
            'Pembayaran',
            'Mengunggah bukti pembayaran.'
        );

        return back()->with(
            'success',
            'Bukti pembayaran berhasil diupload.'
        );
    }
}