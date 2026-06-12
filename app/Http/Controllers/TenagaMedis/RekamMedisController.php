<?php

namespace App\Http\Controllers\TenagaMedis;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\TenagaMedis;

class RekamMedisController extends Controller
{
    public function index()
    {
        $tenagaMedis = TenagaMedis::where('email', auth()->user()->email)
            ->orWhere('nama', auth()->user()->name)
            ->first();

        $rekamMedis = collect();

        if ($tenagaMedis) {
            $rekamMedis = RekamMedis::with(['pasien', 'booking'])
                ->where('tenaga_medis_id', $tenagaMedis->id)
                ->latest()
                ->get();
        }

        return view('tenaga-medis.rekam-medis.index', compact('rekamMedis', 'tenagaMedis'));
    }
}