<?php

namespace App\Http\Controllers\TenagaMedis;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\TenagaMedis;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    private function getTenagaMedis()
    {
        return TenagaMedis::where('email', auth()->user()->email)
            ->orWhere('nama', auth()->user()->name)
            ->firstOrFail();
    }

    public function index(Request $request)
    {
        $tenagaMedis = $this->getTenagaMedis();

        $rekamMedis = RekamMedis::with(['pasien'])
            ->where('tenaga_medis_id', $tenagaMedis->id)
            ->whereNotNull('resep_obat')
            ->where('resep_obat', '!=', '')
            ->when($request->search, function ($query) use ($request) {
                $query->whereHas('pasien', function ($q) use ($request) {
                    $q->where('name', 'ILIKE', '%' . $request->search . '%');
                });
            })
            ->latest('tanggal_pemeriksaan')
            ->get();

        return view('tenaga-medis.resep.index', compact('rekamMedis', 'tenagaMedis'));
    }
}
