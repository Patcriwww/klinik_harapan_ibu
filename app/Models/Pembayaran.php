<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'booking_konsultasi_id',
        'invoice_no',
        'nominal',
        'metode',
        'bukti_bayar',
        'status',
        'catatan',
    ];

    public function booking()
    {
        return $this->belongsTo(BookingKonsultasi::class, 'booking_konsultasi_id');
    }
}