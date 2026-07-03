<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokterFavorit extends Model
{
    protected $fillable = [
        'user_id',
        'tenaga_medis_id',
    ];

    public function pasien()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tenagaMedis()
    {
        return $this->belongsTo(TenagaMedis::class, 'tenaga_medis_id');
    }
}