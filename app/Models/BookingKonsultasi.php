<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingKonsultasi extends Model
{
    protected $fillable = [
        'user_id',
        'tenaga_medis_id',
        'jadwal_praktik_id',
        'tanggal_konsultasi',
        'jam_konsultasi',
        'keluhan',
        'nomor_antrian',
        'kode_booking',
        'status',
    ];

    public function pasien()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tenagaMedis()
    {
        return $this->belongsTo(TenagaMedis::class);
    }

    public function jadwalPraktik()
    {
        return $this->belongsTo(JadwalPraktik::class);
    }
}