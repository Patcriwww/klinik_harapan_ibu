@extends('backoffice.layouts.app')

@section('breadcrumb', 'Rekam Medis')
@section('title', 'Rekam Medis')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <h1 class="text-2xl font-bold text-slate-700">Data Rekam Medis</h1>
        <p class="text-sm text-slate-400 mt-1 mb-6">
            Daftar rekam medis pasien yang telah Anda tangani.
        </p>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-slate-500 border-b">
                        <th class="py-3 px-4">Tanggal</th>
                        <th class="py-3 px-4">Pasien</th>
                        <th class="py-3 px-4">Keluhan</th>
                        <th class="py-3 px-4">Diagnosa</th>
                        <th class="py-3 px-4">Tindakan</th>
                        <th class="py-3 px-4">Resep</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekamMedis as $item)
                        <tr class="border-b hover:bg-slate-50">
                            <td class="py-4 px-4 font-bold text-blue-600">
                                {{ \Carbon\Carbon::parse($item->tanggal_pemeriksaan)->format('d/m/Y') }}
                            </td>
                            <td class="py-4 px-4">
                                <div class="font-bold text-slate-700">{{ $item->pasien->name ?? '-' }}</div>
                                <div class="text-xs text-slate-400">{{ $item->pasien->email ?? '-' }}</div>
                            </td>
                            <td class="py-4 px-4">{{ $item->keluhan ?? '-' }}</td>
                            <td class="py-4 px-4">{{ $item->diagnosa ?? '-' }}</td>
                            <td class="py-4 px-4">{{ $item->tindakan ?? '-' }}</td>
                            <td class="py-4 px-4">{{ $item->resep_obat ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-slate-400 py-10">
                                Belum ada rekam medis yang dibuat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection