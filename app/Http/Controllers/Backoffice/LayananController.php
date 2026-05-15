<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::latest()->get();

        return view('backoffice.layanan.index', compact('layanans'));
    }

    public function create()
    {
        return view('backoffice.layanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'durasi' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
        ]);

        Layanan::create($request->all());

        return redirect()
            ->route('admin.backoffice.layanan.index')
            ->with('success', 'Data layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan)
    {
        return view('backoffice.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'durasi' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
        ]);

        $layanan->update($request->all());

        return redirect()
            ->route('admin.backoffice.layanan.index')
            ->with('success', 'Data layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        $layanan->delete();

        return redirect()
            ->route('admin.backoffice.layanan.index')
            ->with('success', 'Data layanan berhasil dihapus.');
    }
}