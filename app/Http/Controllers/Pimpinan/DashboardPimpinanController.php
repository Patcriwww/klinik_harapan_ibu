<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TenagaMedis;
use App\Models\BookingKonsultasi;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class DashboardPimpinanController extends Controller
{
    public function index()
    {
       $totalPasien = User::whereHas('roles', function ($query) {
            $query->where('name', 'pasien');
        })->count();

        $totalTenagaMedis = TenagaMedis::where('is_active', true)->count();

        $totalBooking = BookingKonsultasi::count();

        $bookingHariIni = BookingKonsultasi::whereDate('tanggal_konsultasi', today())->count();

        $pembayaranMenunggu = Pembayaran::where('status', 'menunggu_verifikasi')->count();

        $totalPendapatan = Pembayaran::where('status', 'dibayar')->sum('nominal');

        $pendapatanBulanIni = Pembayaran::where('status', 'dibayar')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('nominal');

        $bookingPerBulan = BookingKonsultasi::select(
                DB::raw("TO_CHAR(tanggal_konsultasi, 'Mon') as bulan"),
                DB::raw("EXTRACT(MONTH FROM tanggal_konsultasi) as bulan_angka"),
                DB::raw("COUNT(*) as total")
            )
            ->whereYear('tanggal_konsultasi', now()->year)
            ->groupBy('bulan', 'bulan_angka')
            ->orderBy('bulan_angka')
            ->get();

        $dokterFavorit = BookingKonsultasi::with('tenagaMedis')
            ->select('tenaga_medis_id', DB::raw('COUNT(*) as total_booking'))
            ->groupBy('tenaga_medis_id')
            ->orderByDesc('total_booking')
            ->limit(5)
            ->get();

        $statusBooking = BookingKonsultasi::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get();

        return view('pimpinan.dashboard.index', compact(
            'totalPasien',
            'totalTenagaMedis',
            'totalBooking',
            'bookingHariIni',
            'pembayaranMenunggu',
            'totalPendapatan',
            'pendapatanBulanIni',
            'bookingPerBulan',
            'dokterFavorit',
            'statusBooking'
        ));
    }
}