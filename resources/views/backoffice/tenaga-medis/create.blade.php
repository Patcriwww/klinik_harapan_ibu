@extends('backoffice.layouts.app')

@section('breadcrumb', 'Tambah Tenaga Medis')
@section('title', 'Tambah Tenaga Medis')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="max-w-4xl mx-auto bg-white shadow-soft-xl rounded-2xl p-6">

        <div class="mb-6">
            <h6 class="text-xl font-bold text-slate-700">Tambah Tenaga Medis</h6>
            <p class="text-sm text-slate-400 mt-1">Tambahkan data dokter atau tenaga kesehatan klinik.</p>
        </div>

        @if ($errors->any())
            <div class="mb-5 px-4 py-3 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.backoffice.tenaga-medis.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm"
                           placeholder="Nama tenaga medis" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Spesialis</label>
                    <input type="text" name="spesialis" value="{{ old('spesialis') }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm"
                           placeholder="Contoh: Dokter Anak / Bidan" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm"
                           placeholder="Email">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">No. HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm"
                           placeholder="Nomor handphone">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Nomor SIP</label>
                    <input type="text" name="sip" value="{{ old('sip') }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm"
                           placeholder="Nomor SIP">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Status</label>
                    <select name="is_active" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm" required>
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Foto</label>
                    <input type="file" name="foto"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm"
                           accept="image/*">
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('admin.backoffice.tenaga-medis.index') }}"
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