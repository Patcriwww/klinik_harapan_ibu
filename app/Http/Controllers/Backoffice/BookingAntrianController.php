<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\BookingKonsultasi;
use Illuminate\Http\Request;

class BookingAntrianController extends Controller
{
    public function index(Request $request)
    {
        $bookings = BookingKonsultasi::with(['pasien', 'tenagaMedis', 'jadwalPraktik'])
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->tanggal, function ($query) use ($request) {
                $query->whereDate('tanggal_konsultasi', $request->tanggal);
            })
            ->latest()
            ->get();

        return view('backoffice.booking-antrian.index', compact('bookings'));
    }

    public function updateStatus(Request $request, BookingKonsultasi $booking)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,batal',
        ]);

        $booking->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.backoffice.booking-antrian.index')
            ->with('success', 'Status booking berhasil diperbarui.');
    }
}