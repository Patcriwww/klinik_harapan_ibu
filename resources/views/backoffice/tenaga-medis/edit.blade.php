@extends('backoffice.layouts.app')

@section('breadcrumb', 'Edit Tenaga Medis')
@section('title', 'Edit Tenaga Medis')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="max-w-4xl mx-auto bg-white shadow-soft-xl rounded-2xl p-6">

        <div class="mb-6">
            <h6 class="text-xl font-bold text-slate-700">Edit Tenaga Medis</h6>
            <p class="text-sm text-slate-400 mt-1">Perbarui data dokter atau tenaga kesehatan klinik.</p>
        </div>

        @if ($errors->any())
            <div class="mb-5 px-4 py-3 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.backoffice.tenaga-medis.update', $tenagaMedis->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $tenagaMedis->nama) }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Spesialis</label>
                    <input type="text" name="spesialis" value="{{ old('spesialis', $tenagaMedis->spesialis) }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Email</label>
                    <input type="email" name="email" value="{{ old('email', $tenagaMedis->email) }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">No. HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $tenagaMedis->no_hp) }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Nomor SIP</label>
                    <input type="text" name="sip" value="{{ old('sip', $tenagaMedis->sip) }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Status</label>
                    <select name="is_active" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm" required>
                        <option value="1" {{ $tenagaMedis->is_active ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ !$tenagaMedis->is_active ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Foto</label>

                    @if($tenagaMedis->foto)
                        <img src="{{ asset('storage/'.$tenagaMedis->foto) }}"
                             class="w-20 h-20 rounded-xl object-cover mb-3">
                    @endif

                    <input type="file" name="foto"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm"
                           accept="image/*">
                    <p class="text-xs text-slate-400 mt-1">Kosongkan jika tidak ingin mengganti foto.</p>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('admin.backoffice.tenaga-medis.index') }}"
                   class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-slate-100 rounded-xl">
                    Kembali
                </a>

                <button type="submit"
                        class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-500 rounded-xl hover:bg-blue-600">
                    Update
                </button>
            </div>
        </form>

    </div>
</div>
@endsection