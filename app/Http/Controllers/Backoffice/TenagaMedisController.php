<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\TenagaMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ActivityLogger;

class TenagaMedisController extends Controller
{
    public function index()
    {
        $tenagaMedis = TenagaMedis::latest()->get();
        return view('backoffice.tenaga-medis.index', compact('tenagaMedis'));
    }

    public function create()
    {
        return view('backoffice.tenaga-medis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'no_hp' => 'nullable|string|max:20',
            'spesialis' => 'required|string|max:255',
            'sip' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->only([
            'nama',
            'email',
            'no_hp',
            'spesialis',
            'sip',
            'is_active',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('tenaga-medis', 'public');
        }

        TenagaMedis::create($data);

        ActivityLogger::log(
            'Tambah Tenaga Medis',
            'Master Data',
            'Menambahkan tenaga medis baru.'
        );
        return redirect()
            ->route('admin.backoffice.tenaga-medis.index')
            ->with('success', 'Data tenaga medis berhasil ditambahkan.');
    }

    public function edit(TenagaMedis $tenaga_medi)
    {
        $tenagaMedis = $tenaga_medi;
        return view('backoffice.tenaga-medis.edit', compact('tenagaMedis'));
    }

    public function update(Request $request, TenagaMedis $tenaga_medi)
    {
        $tenagaMedis = $tenaga_medi;

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'no_hp' => 'nullable|string|max:20',
            'spesialis' => 'required|string|max:255',
            'sip' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->only([
            'nama',
            'email',
            'no_hp',
            'spesialis',
            'sip',
            'is_active',
        ]);

        if ($request->hasFile('foto')) {
            if ($tenagaMedis->foto && Storage::disk('public')->exists($tenagaMedis->foto)) {
                Storage::disk('public')->delete($tenagaMedis->foto);
            }

            $data['foto'] = $request->file('foto')->store('tenaga-medis', 'public');
        }

        $tenagaMedis->update($data);

        return redirect()
            ->route('admin.backoffice.tenaga-medis.index')
            ->with('success', 'Data tenaga medis berhasil diperbarui.');
    }

    public function destroy(TenagaMedis $tenaga_medi)
    {
        if ($tenaga_medi->foto && Storage::disk('public')->exists($tenaga_medi->foto)) {
            Storage::disk('public')->delete($tenaga_medi->foto);
        }

        $tenaga_medi->delete();

        return redirect()
            ->route('admin.backoffice.tenaga-medis.index')
            ->with('success', 'Data tenaga medis berhasil dihapus.');
    }
}