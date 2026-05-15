<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPraktik extends Model
{
    protected $fillable = [
        'tenaga_medis_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'kuota',
        'is_active'
    ];

    public function tenagaMedis()
    {
        return $this->belongsTo(TenagaMedis::class);
    }
}