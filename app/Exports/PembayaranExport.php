<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PembayaranExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pembayaran::with(['booking.pasien', 'booking.tenagaMedis'])
            ->get()
            ->map(function ($item) {
                return [
                    'invoice_no' => $item->invoice_no,
                    'kode_booking' => $item->booking->kode_booking ?? '-',
                    'pasien' => $item->booking->pasien->name ?? '-',
                    'dokter' => $item->booking->tenagaMedis->nama ?? '-',
                    'metode' => $item->metode,
                    'nominal' => $item->nominal,
                    'status' => $item->status,
                    'tanggal' => $item->created_at?->format('Y-m-d H:i:s'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Invoice',
            'Kode Booking',
            'Pasien',
            'Dokter',
            'Metode',
            'Nominal',
            'Status',
            'Tanggal',
        ];
    }
}