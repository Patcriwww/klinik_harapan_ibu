<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PasienExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::whereHas('roles', function ($query) {
                $query->where('name', 'pasien');
            })
            ->select('id', 'name', 'email', 'created_at')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Pasien',
            'Email',
            'Tanggal Daftar',
        ];
    }
}