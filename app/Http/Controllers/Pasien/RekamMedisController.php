<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Helpers\ActivityLogger;

class RekamMedisController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::with(['booking', 'tenagaMedis'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('pasien.rekam-medis.index', compact('rekamMedis'));
    }
}