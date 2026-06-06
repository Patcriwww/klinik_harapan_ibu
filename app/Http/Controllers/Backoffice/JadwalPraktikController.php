<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\JadwalPraktik;
use App\Models\TenagaMedis;
use Illuminate\Http\Request;

class JadwalPraktikController extends Controller
{
    public function index()
    {
        $jadwal = JadwalPraktik::with('tenagaMedis')->latest()->get();

        return view('backoffice.jadwal-praktik.index', compact('jadwal'));
    }

    public function create()
    {
        $tenagaMedis = TenagaMedis::where('is_active', 1)->get();

        return view('backoffice.jadwal-praktik.create', compact('tenagaMedis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tenaga_medis_id' => 'required|exists:tenaga_medis,id',
            'hari' => 'required|array|min:1',
            'hari.*' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kuota' => 'required|integer|min:1',
            'is_active' => 'required|boolean',
        ]);

        foreach ($request->hari as $hari) {
            JadwalPraktik::create([
                'tenaga_medis_id' => $request->tenaga_medis_id,
                'hari' => $hari,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'kuota' => $request->kuota,
                'is_active' => $request->is_active,
            ]);
        }

        return redirect()
            ->route('admin.backoffice.jadwal-praktik.index')
            ->with('success', 'Jadwal praktik berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jadwal = JadwalPraktik::findOrFail($id);
        $tenagaMedis = TenagaMedis::all();

        return view('backoffice.jadwal-praktik.edit', compact('jadwal', 'tenagaMedis'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalPraktik::findOrFail($id);

        $jadwal->update($request->all());

        return redirect()
            ->route('admin.backoffice.jadwal-praktik.index')
            ->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy($id)
    {
        JadwalPraktik::findOrFail($id)->delete();

        return back()->with('success', 'Jadwal berhasil dihapus');
    }
}