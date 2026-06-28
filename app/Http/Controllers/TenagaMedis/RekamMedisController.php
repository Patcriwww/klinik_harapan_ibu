<?php

namespace App\Http\Controllers\TenagaMedis;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\TenagaMedis;
use Illuminate\Http\Request;
use App\Models\BookingKonsultasi;

class RekamMedisController extends Controller
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

        $bookings = BookingKonsultasi::with([
                'pasien',
                'tenagaMedis',
                'pembayaran',
                'rekamMedis'
            ])
            ->where('tenaga_medis_id', $tenagaMedis->id)
            ->when($request->tanggal, function ($query) use ($request) {
                $query->whereDate('tanggal_konsultasi', $request->tanggal);
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->search, function ($query) use ($request) {
                $query->whereHas('pasien', function ($q) use ($request) {
                    $q->where('name', 'ILIKE', '%' . $request->search . '%')
                      ->orWhere('email', 'ILIKE', '%' . $request->search . '%');
                });
            })
            ->latest()
            ->get();

        return view('tenaga-medis.rekam-medis.index', compact(
            'bookings',
            'tenagaMedis'
        ));
    }

    public function show(RekamMedis $rekamMedis)
    {
        $tenagaMedis = $this->getTenagaMedis();

        if ($rekamMedis->tenaga_medis_id !== $tenagaMedis->id) {
            abort(403);
        }

        $rekamMedis->load([
            'pasien',
            'tenagaMedis',
            'booking',
        ]);

        return view('tenaga-medis.rekam-medis.show', compact('rekamMedis'));
    }

    public function edit(RekamMedis $rekamMedis)
    {
        $tenagaMedis = $this->getTenagaMedis();

        if ($rekamMedis->tenaga_medis_id !== $tenagaMedis->id) {
            abort(403);
        }

        $rekamMedis->load([
            'pasien',
            'tenagaMedis',
            'booking',
        ]);

        return view('tenaga-medis.rekam-medis.edit', compact('rekamMedis'));
    }

    public function update(Request $request, RekamMedis $rekamMedis)
    {
        $tenagaMedis = $this->getTenagaMedis();

        if ($rekamMedis->tenaga_medis_id !== $tenagaMedis->id) {
            abort(403);
        }

        $request->validate([
            'diagnosa' => 'required|string|max:2000',
            'tindakan' => 'nullable|string|max:2000',
            'resep_obat' => 'nullable|string|max:2000',
            'catatan_dokter' => 'nullable|string|max:2000',
            'berat_badan' => 'nullable|numeric',
            'tinggi_badan' => 'nullable|numeric',
            'lingkar_kepala' => 'nullable|numeric',
            'suhu' => 'nullable|numeric',
            'tekanan_darah' => 'nullable|string|max:50',
        ]);

        $rekamMedis->update([
            'diagnosa' => $request->diagnosa,
            'tindakan' => $request->tindakan,
            'resep_obat' => $request->resep_obat,
            'catatan_dokter' => $request->catatan_dokter,
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'lingkar_kepala' => $request->lingkar_kepala,
            'suhu' => $request->suhu,
            'tekanan_darah' => $request->tekanan_darah,
        ]);

        return redirect()
            ->route('tenaga-medis.rekam-medis.show', $rekamMedis->id)
            ->with('success', 'Rekam medis berhasil diperbarui.');
    }
}