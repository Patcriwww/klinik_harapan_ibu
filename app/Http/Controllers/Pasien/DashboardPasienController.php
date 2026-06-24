<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\BookingKonsultasi;
use App\Models\Pembayaran;
use App\Models\RekamMedis;

class DashboardPasienController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $totalBooking = BookingKonsultasi::where('user_id', $userId)->count();

        $bookingAktif = BookingKonsultasi::where('user_id', $userId)
            ->whereIn('status', ['menunggu', 'diproses'])
            ->count();

        $totalPembayaran = Pembayaran::whereHas('booking', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->count();

        $totalRekamMedis = RekamMedis::where('user_id', $userId)->count();

        $bookingTerakhir = BookingKonsultasi::with([
                'tenagaMedis',
                'pembayaran',
                'jadwalPraktik'
            ])
            ->where('user_id', $userId)
            ->latest()
            ->first();

        $pembayaranTerakhir = Pembayaran::with('booking.tenagaMedis')
            ->whereHas('booking', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->latest()
            ->first();

        return view('pasien.dashboard', compact(
            'totalBooking',
            'bookingAktif',
            'totalPembayaran',
            'totalRekamMedis',
            'bookingTerakhir',
            'pembayaranTerakhir'
        ));
    }
}