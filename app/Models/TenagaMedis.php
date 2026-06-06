<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenagaMedis extends Model
{
    protected $table = 'tenaga_medis';

    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'spesialis',
        'sip',
        'foto',
        'is_active',
    ];

    public function jadwalPraktik()
    {
        return $this->hasMany(JadwalPraktik::class);
    }

}