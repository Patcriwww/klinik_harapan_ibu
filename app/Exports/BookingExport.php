<?php

namespace App\Exports;

use App\Models\BookingKonsultasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookingExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return BookingKonsultasi::with(['pasien', 'tenagaMedis'])
            ->get()
            ->map(function ($item) {
                return [
                    'kode_booking' => $item->kode_booking,
                    'nomor_antrian' => $item->nomor_antrian,
                    'pasien' => $item->pasien->name ?? '-',
                    'dokter' => $item->tenagaMedis->nama ?? '-',
                    'tanggal_konsultasi' => $item->tanggal_konsultasi,
                    'jam_konsultasi' => $item->jam_konsultasi,
                    'keluhan' => $item->keluhan,
                    'status' => $item->status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Kode Booking',
            'Nomor Antrian',
            'Pasien',
            'Dokter',
            'Tanggal Konsultasi',
            'Jam Konsultasi',
            'Keluhan',
            'Status',
        ];
    }
}