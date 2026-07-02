<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';

    protected $fillable = [
        'booking_konsultasi_id',
        'user_id',
        'tenaga_medis_id',
        'keluhan',
        'diagnosa',
        'tindakan',
        'resep_obat',
        'catatan_dokter',
        'tanggal_pemeriksaan',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'suhu',
        'tekanan_darah',
    ];

    public function booking()
    {
        return $this->belongsTo(BookingKonsultasi::class, 'booking_konsultasi_id');
    }

    public function pasien()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tenagaMedis()
    {
        return $this->belongsTo(TenagaMedis::class, 'tenaga_medis_id');
    }
}