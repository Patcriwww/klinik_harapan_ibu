@extends('backoffice.layouts.app')

@section('breadcrumb', 'Tambah Layanan')
@section('title', 'Tambah Layanan')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="max-w-4xl mx-auto bg-white shadow-soft-xl rounded-2xl p-6">

        <div class="mb-6">
            <h6 class="text-xl font-bold text-slate-700">Tambah Layanan Klinik</h6>
            <p class="text-sm text-slate-400 mt-1">Tambahkan jenis layanan yang tersedia di klinik.</p>
        </div>

        <form action="{{ route('admin.backoffice.layanan.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Nama Layanan</label>
                    <input type="text" name="nama_layanan" value="{{ old('nama_layanan') }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm"
                           placeholder="Contoh: Konsultasi Anak" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Durasi Layanan</label>
                    <input type="number" name="durasi" value="{{ old('durasi', 30) }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm"
                           placeholder="Durasi dalam menit" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Harga</label>
                    <input type="number" name="harga" value="{{ old('harga') }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm"
                           placeholder="Contoh: 100000" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Status</label>
                    <select name="is_active"
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm" required>
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Deskripsi</label>
                    <textarea name="deskripsi" rows="4"
                              class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm"
                              placeholder="Deskripsi layanan">{{ old('deskripsi') }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('admin.backoffice.layanan.index') }}"
                   class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-slate-100 rounded-xl">
                    Kembali
                </a>

                <button type="submit"
                        class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-500 rounded-xl hover:bg-blue-600">
                    Simpan
                </button>
            </div>
        </form>

    </div>
</div>
@endsection