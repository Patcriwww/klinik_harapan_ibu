<?php

namespace App\Http\Controllers\TenagaMedis;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\TenagaMedis;
use Illuminate\Http\Request;
use App\Models\BookingKonsultasi;

class RekamMedisController extends Controller
{
    public function index(Request $request)
    {
        $tenagaMedis = TenagaMedis::where('email', auth()->user()->email)
            ->orWhere('nama', auth()->user()->name)
            ->firstOrFail();

        $bookings = BookingKonsultasi::with([
                'pasien',
                'tenagaMedis',
                'pembayaran',
                'rekamMedis'
            ])
            ->where('tenaga_medis_id', $tenagaMedis->id)
            ->when($request->tanggal, function ($query) use ($request) {
                $query->whereDate('tanggal_konsultasi', $request->tanggal);
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->search, function ($query) use ($request) {
                $query->whereHas('pasien', function ($q) use ($request) {
                    $q->where('name', 'ILIKE', '%' . $request->search . '%')
                    ->orWhere('email', 'ILIKE', '%' . $request->search . '%');
                });
            })
            ->latest()
            ->get();

        return view('tenaga-medis.rekam-medis.index', compact(
            'bookings',
            'tenagaMedis'
        ));
    }
}