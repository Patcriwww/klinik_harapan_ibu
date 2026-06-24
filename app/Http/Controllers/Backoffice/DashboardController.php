<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TenagaMedis;
use App\Models\BookingKonsultasi;
use App\Models\Pembayaran;
use App\Models\RekamMedis;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPasien = User::whereHas('roles', function ($query) {
            $query->where('name', 'pasien');
        })->count();

        $totalTenagaMedis = TenagaMedis::where('is_active', true)->count();

        $bookingHariIni = BookingKonsultasi::whereDate('tanggal_konsultasi', today())->count();

        $pembayaranPending = Pembayaran::whereIn('status', [
            'pending',
            'menunggu_verifikasi'
        ])->count();

        $totalBooking = BookingKonsultasi::count();

        $totalRekamMedis = RekamMedis::count();

        $totalPendapatan = Pembayaran::where('status', 'dibayar')->sum('nominal');

        $bookingTerbaru = BookingKonsultasi::with([
                'pasien',
                'tenagaMedis',
                'pembayaran'
            ])
            ->latest()
            ->limit(6)
            ->get();

        $booking7Hari = collect();

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::today()->subDays($i);

            $booking7Hari->push([
                'tanggal' => $tanggal->format('d M'),
                'total' => BookingKonsultasi::whereDate('tanggal_konsultasi', $tanggal)->count(),
            ]);
        }

        $statusBooking = BookingKonsultasi::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get();

        return view('backoffice.dashboard', compact(
            'totalPasien',
            'totalTenagaMedis',
            'bookingHariIni',
            'pembayaranPending',
            'totalBooking',
            'totalRekamMedis',
            'totalPendapatan',
            'bookingTerbaru',
            'booking7Hari',
            'statusBooking'
        ));
    }
}