<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\BookingKonsultasi;
use App\Models\Pembayaran;
use App\Models\RekamMedis;
use App\Models\TenagaMedis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanKlinikController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun ?? now()->year;

        $totalPasien = User::whereHas('roles', function ($query) {
            $query->where('name', 'pasien');
        })->count();

        $totalTenagaMedis = TenagaMedis::where('is_active', true)->count();

        $totalBooking = BookingKonsultasi::whereYear('tanggal_konsultasi', $tahun)->count();

        $totalRekamMedis = RekamMedis::whereYear('tanggal_pemeriksaan', $tahun)->count();

        $totalPendapatan = Pembayaran::where('status', 'dibayar')
            ->whereYear('created_at', $tahun)
            ->sum('nominal');

        $bookingBulanan = BookingKonsultasi::selectRaw('EXTRACT(MONTH FROM tanggal_konsultasi) as bulan, COUNT(*) as total')
            ->whereYear('tanggal_konsultasi', $tahun)
            ->groupBy(DB::raw('EXTRACT(MONTH FROM tanggal_konsultasi)'))
            ->orderBy(DB::raw('EXTRACT(MONTH FROM tanggal_konsultasi)'))
            ->pluck('total', 'bulan');

        $pendapatanBulanan = Pembayaran::selectRaw('EXTRACT(MONTH FROM created_at) as bulan, SUM(nominal) as total')
            ->where('status', 'dibayar')
            ->whereYear('created_at', $tahun)
            ->groupBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
            ->orderBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
            ->pluck('total', 'bulan');

        $labels = [];
        $bookingData = [];
        $pendapatanData = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = \Carbon\Carbon::create()->month($i)->translatedFormat('M');
            $bookingData[] = (int) ($bookingBulanan[$i] ?? 0);
            $pendapatanData[] = (int) ($pendapatanBulanan[$i] ?? 0);
        }

        $statusBooking = BookingKonsultasi::select('status', DB::raw('COUNT(*) as total'))
            ->whereYear('tanggal_konsultasi', $tahun)
            ->groupBy('status')
            ->pluck('total', 'status');

        $dokterTerfavorit = BookingKonsultasi::with('tenagaMedis')
            ->select('tenaga_medis_id', DB::raw('COUNT(*) as total'))
            ->whereYear('tanggal_konsultasi', $tahun)
            ->groupBy('tenaga_medis_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $rekamMedisTerbaru = RekamMedis::with(['pasien', 'tenagaMedis'])
            ->latest()
            ->limit(5)
            ->get();

        return view('pimpinan.laporan-klinik.index', compact(
            'tahun',
            'totalPasien',
            'totalTenagaMedis',
            'totalBooking',
            'totalRekamMedis',
            'totalPendapatan',
            'labels',
            'bookingData',
            'pendapatanData',
            'statusBooking',
            'dokterTerfavorit',
            'rekamMedisTerbaru'
        ));
    }
}