<?php

namespace App\Http\Controllers\TenagaMedis;

use App\Http\Controllers\Controller;
use App\Models\TenagaMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ActivityLogger;

class ProfilController extends Controller
{
    private function getTenagaMedis()
    {
        return TenagaMedis::where('email', auth()->user()->email)
            ->orWhere('nama', auth()->user()->name)
            ->firstOrFail();
    }

    public function index()
    {
        $tenagaMedis = $this->getTenagaMedis();

        return view('tenaga-medis.profil.index', compact('tenagaMedis'));
    }

    public function update(Request $request)
    {
        $tenagaMedis = $this->getTenagaMedis();

        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:30',
            'spesialis' => 'nullable|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama', 'no_hp', 'spesialis']);

        if ($request->hasFile('foto')) {
            if ($tenagaMedis->foto) {
                Storage::disk('public')->delete($tenagaMedis->foto);
            }

            $data['foto'] = $request->file('foto')->store('tenaga-medis', 'public');
        }

        $tenagaMedis->update($data);

        ActivityLogger::log(
            'Update Profil',
            'Tenaga Medis',
            'Tenaga medis ' . $tenagaMedis->nama . ' memperbarui profilnya.'
        );

        return redirect()
            ->route('tenaga-medis.profil.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
