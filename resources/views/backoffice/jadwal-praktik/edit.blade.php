@extends('backoffice.layouts.app')

@section('breadcrumb', 'Edit Jadwal Praktik')
@section('title', 'Edit Jadwal Praktik')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="max-w-4xl mx-auto bg-white shadow-soft-xl rounded-2xl p-6">

        <div class="mb-6">
            <h6 class="text-xl font-bold text-slate-700">Edit Jadwal Praktik</h6>
            <p class="text-sm text-slate-400 mt-1">
                Perbarui jadwal praktik tenaga medis.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-5 px-4 py-3 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.backoffice.jadwal-praktik.update', $jadwal->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Tenaga Medis</label>
                    <select name="tenaga_medis_id"
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm"
                            required>
                        <option value="">Pilih Tenaga Medis</option>
                        @foreach($tenagaMedis as $dokter)
                            <option value="{{ $dokter->id }}" {{ old('tenaga_medis_id', $jadwal->tenaga_medis_id) == $dokter->id ? 'selected' : '' }}>
                                {{ $dokter->nama }} - {{ $dokter->spesialis }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Hari</label>
                    <select name="hari"
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm"
                            required>
                        <option value="">Pilih Hari</option>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $hari)
                            <option value="{{ $hari }}" {{ old('hari', $jadwal->hari) == $hari ? 'selected' : '' }}>
                                {{ $hari }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Kuota Pasien</label>
                    <input type="number"
                           name="kuota"
                           value="{{ old('kuota', $jadwal->kuota) }}"
                           min="1"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm"
                           required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Jam Mulai</label>
                    <input type="time"
                           name="jam_mulai"
                           value="{{ old('jam_mulai', \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i')) }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm"
                           required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Jam Selesai</label>
                    <input type="time"
                           name="jam_selesai"
                           value="{{ old('jam_selesai', \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i')) }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm"
                           required>
                </div>

                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-semibold text-slate-600">Status</label>
                    <select name="is_active"
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm"
                            required>
                        <option value="1" {{ old('is_active', $jadwal->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('is_active', $jadwal->is_active) == 0 ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('admin.backoffice.jadwal-praktik.index') }}"
                   class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-slate-100 rounded-xl">
                    Kembali
                </a>

                <button type="submit"
                        class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-500 rounded-xl hover:bg-blue-600">
                    Update Jadwal
                </button>
            </div>
        </form>

    </div>
</div>
@endsection