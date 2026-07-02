<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ActivityLogger;

class PasienController extends Controller
{
   public function index(Request $request)
    {
        $pasiens = User::whereHas('roles', function ($query) {
                $query->where('name', 'pasien');
            })
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'ILIKE', '%' . $request->search . '%')
                    ->orWhere('email', 'ILIKE', '%' . $request->search . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('backoffice.pasien.index', compact('pasiens'));
    }
    public function create()
    {
        return view('backoffice.pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'no_hp' => 'nullable|string|max:30',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
        ]);

        $pasien = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        $pasien->assignRole('pasien');

        ActivityLogger::log(
            'Tambah Pasien',
            'Pasien',
            'Admin menambahkan pasien baru: ' . $pasien->name
        );

        return redirect()
            ->route('admin.backoffice.pasien.index')
            ->with('success', 'Data pasien berhasil ditambahkan.');
    }

    public function edit(User $pasien)
    {
        return view('backoffice.pasien.edit', compact('pasien'));
    }

    public function update(Request $request, User $pasien)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $pasien->id,
            'password' => 'nullable|min:6',
            'no_hp' => 'nullable|string|max:30',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
        ]);

        $data = $request->only([
            'name',
            'email',
            'no_hp',
            'alamat',
            'tanggal_lahir',
            'jenis_kelamin',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pasien->update($data);

        ActivityLogger::log(
            'Update Pasien',
            'Pasien',
            'Admin mengubah data pasien: ' . $pasien->name
        );

        return redirect()
            ->route('admin.backoffice.pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(User $pasien)
    {
        $nama = $pasien->name;

        $pasien->delete();

        ActivityLogger::log(
            'Hapus Pasien',
            'Pasien',
            'Admin menghapus data pasien: ' . $nama
        );

        return redirect()
            ->route('admin.backoffice.pasien.index')
            ->with('success', 'Data pasien berhasil dihapus.');
    }
}