<?php

namespace App\Exports;

use App\Models\RekamMedis;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekamMedisExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return RekamMedis::with(['pasien', 'tenagaMedis', 'booking'])
            ->get()
            ->map(function ($item) {
                return [
                    'tanggal_pemeriksaan' => $item->tanggal_pemeriksaan,
                    'pasien' => $item->pasien->name ?? '-',
                    'dokter' => $item->tenagaMedis->nama ?? '-',
                    'kode_booking' => $item->booking->kode_booking ?? '-',
                    'keluhan' => $item->keluhan,
                    'diagnosa' => $item->diagnosa,
                    'tindakan' => $item->tindakan,
                    'resep_obat' => $item->resep_obat,
                    'berat_badan' => $item->berat_badan,
                    'tinggi_badan' => $item->tinggi_badan,
                    'lingkar_kepala' => $item->lingkar_kepala,
                    'suhu' => $item->suhu,
                    'tekanan_darah' => $item->tekanan_darah,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Tanggal Pemeriksaan',
            'Pasien',
            'Dokter',
            'Kode Booking',
            'Keluhan',
            'Diagnosa',
            'Tindakan',
            'Resep Obat',
            'Berat Badan',
            'Tinggi Badan',
            'Lingkar Kepala',
            'Suhu',
            'Tekanan Darah',
        ];
    }
}