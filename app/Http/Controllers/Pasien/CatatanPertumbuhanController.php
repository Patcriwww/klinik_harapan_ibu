<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Helpers\ActivityLogger;

class CatatanPertumbuhanController extends Controller
{
    public function index()
    {
        $records = RekamMedis::where('user_id', auth()->id())
            ->orderBy('tanggal_pemeriksaan')
            ->get();

        return view(
            'pasien.catatan-pertumbuhan.index',
            compact('records')
        );
    }
}