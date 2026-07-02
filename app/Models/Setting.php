<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'nama_klinik',
        'subtitle_klinik',
        'alamat',
        'telepon',
        'email',
        'jam_operasional',
        'logo',
        'footer',
    ];

    public static function data()
    {
        return self::firstOrCreate([
            'id' => 1,
        ], [
            'nama_klinik' => 'Klinik Harapan Ibu',
            'subtitle_klinik' => 'Ibu dan Anak',
            'alamat' => 'Jl. Harapan Ibu No. 01',
            'telepon' => '(021) 12345678',
            'email' => 'info@klinikharapanibu.com',
            'jam_operasional' => 'Senin - Sabtu, 08.00 - 17.00 WIB',
            'footer' => '© 2026 Klinik Harapan Ibu',
        ]);
    }
}