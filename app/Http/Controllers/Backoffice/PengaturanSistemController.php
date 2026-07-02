<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanSistemController extends Controller
{
    public function index()
    {
        $setting = Setting::data();

        return view('backoffice.pengaturan-sistem.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::data();

        $request->validate([
            'nama_klinik' => 'required|string|max:255',
            'subtitle_klinik' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'jam_operasional' => 'nullable|string|max:255',
            'footer' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only([
            'nama_klinik',
            'subtitle_klinik',
            'alamat',
            'telepon',
            'email',
            'jam_operasional',
            'footer',
        ]);

        if ($request->hasFile('logo')) {
            if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {
                Storage::disk('public')->delete($setting->logo);
            }

            $data['logo'] = $request->file('logo')->store('settings', 'public');
        }

        $setting->update($data);
        ActivityLogger::log(
            'Update Pengaturan Sistem',
            'Pengaturan',
            'Mengubah informasi Klinik Harapan Ibu.'
        );

        return back()->with('success', 'Pengaturan sistem berhasil diperbarui.');
    }
}