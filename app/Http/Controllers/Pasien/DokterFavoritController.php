<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\DokterFavorit;
use App\Models\TenagaMedis;
use Illuminate\Http\Request;
use App\Helpers\ActivityLogger;

class DokterFavoritController extends Controller
{
    public function index()
    {
        $favorits = DokterFavorit::with('tenagaMedis.jadwalPraktik')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('pasien.dokter-favorit.index', compact('favorits'));
    }

    public function toggle(TenagaMedis $tenagaMedis)
    {
        $favorit = DokterFavorit::where('user_id', auth()->id())
            ->where('tenaga_medis_id', $tenagaMedis->id)
            ->first();

        if ($favorit) {
            $favorit->delete();

            ActivityLogger::log(
                'Hapus Dokter Favorit',
                'Dokter Favorit',
                'Menghapus dokter ' . $tenagaMedis->nama . ' dari daftar favorit.'
            );

            return back()->with('success', 'Dokter berhasil dihapus dari favorit.');
        }

        DokterFavorit::create([
            'user_id' => auth()->id(),
            'tenaga_medis_id' => $tenagaMedis->id,
        ]);

        ActivityLogger::log(
            'Tambah Dokter Favorit',
            'Dokter Favorit',
            'Menambahkan dokter ' . $tenagaMedis->nama . ' ke daftar favorit.'
        );

        return back()->with('success', 'Dokter berhasil ditambahkan ke favorit.');
    }
}