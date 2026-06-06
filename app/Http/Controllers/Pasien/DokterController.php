<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\TenagaMedis;
use App\Models\JadwalPraktik;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index(Request $request)
    {
        $spesialisList = TenagaMedis::where('is_active', 1)
            ->whereNotNull('spesialis')
            ->distinct()
            ->pluck('spesialis');

        $dokters = TenagaMedis::with('jadwalPraktik')
            ->where('is_active', 1)
            ->when($request->spesialis, function ($query) use ($request) {
                $query->where('spesialis', $request->spesialis);
            })
            ->latest()
            ->get();

        return view('pasien.dokter.index', compact('dokters', 'spesialisList'));
    }

    public function jadwal($id)
    {
        $dokter = TenagaMedis::with(['jadwalPraktik' => function ($query) {
            $query->where('is_active', 1)
                ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')");
        }])->findOrFail($id);

        return view('pasien.dokter.jadwal', compact('dokter'));
    }
}