<?php

namespace App\Http\Controllers\TenagaMedis;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\TenagaMedis;
use Illuminate\Http\Request;
use App\Helpers\ActivityLogger;

class HasilLabController extends Controller
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
            ->when($request->search, function ($query) use ($request) {
                $query->whereHas('pasien', function ($q) use ($request) {
                    $q->where('name', 'ILIKE', '%' . $request->search . '%');
                });
            })
            ->latest('tanggal_pemeriksaan')
            ->get();

        return view('tenaga-medis.hasil-lab.index', compact('rekamMedis', 'tenagaMedis'));
    }

    public function edit(RekamMedis $rekamMedis)
    {
        $tenagaMedis = $this->getTenagaMedis();

        if ($rekamMedis->tenaga_medis_id !== $tenagaMedis->id) {
            abort(403);
        }

        $rekamMedis->load('pasien');

        return view('tenaga-medis.hasil-lab.edit', compact('rekamMedis'));
    }

    public function update(Request $request, RekamMedis $rekamMedis)
    {
        $tenagaMedis = $this->getTenagaMedis();

        if ($rekamMedis->tenaga_medis_id !== $tenagaMedis->id) {
            abort(403);
        }

        $request->validate([
            'hasil_lab' => 'nullable|string|max:2000',
        ]);

        $rekamMedis->update([
            'hasil_lab' => $request->hasil_lab,
        ]);

        ActivityLogger::log(
            'Update Hasil Lab',
            'Rekam Medis',
            'Mengubah hasil laboratorium pasien ' . $rekamMedis->pasien->name
        );

        return redirect()
            ->route('tenaga-medis.hasil-lab.index')
            ->with('success', 'Hasil laboratorium berhasil disimpan.');
    }
}
