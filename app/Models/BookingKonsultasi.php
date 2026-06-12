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
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function tenagaMedis()
    {
        return $this->belongsTo(\App\Models\TenagaMedis::class, 'tenaga_medis_id');
    }

    public function jadwalPraktik()
    {
        return $this->belongsTo(\App\Models\JadwalPraktik::class, 'jadwal_praktik_id');
    }

    public function pembayaran()
    {
        return $this->hasOne(\App\Models\Pembayaran::class, 'booking_konsultasi_id');
    }

    public function rekamMedis()
    {
        return $this->hasOne(\App\Models\RekamMedis::class, 'booking_konsultasi_id');
    }
}