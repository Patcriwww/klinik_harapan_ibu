@extends('backoffice.layouts.app')

@section('breadcrumb', 'Jadwal Dokter')
@section('title', 'Jadwal Dokter')

@section('content')
<div class="w-full px-6 py-6 mx-auto">

    <div class="bg-white rounded-2xl shadow-soft-xl p-6 mb-6">
        <div class="flex flex-wrap items-center gap-5">
            @if($dokter->foto)
                <img src="{{ asset('storage/'.$dokter->foto) }}"
                     style="width:96px;height:96px;object-fit:cover;border-radius:20px;"
                     class="shadow-md"
                     alt="{{ $dokter->nama }}">
            @else
                <div class="w-24 h-24 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-3xl font-bold">
                    {{ strtoupper(substr($dokter->nama, 0, 1)) }}
                </div>
            @endif

            <div>
                <h5 class="text-2xl font-bold text-slate-700 mb-1">{{ $dokter->nama }}</h5>
                <p class="text-sm text-slate-400 mb-2">{{ $dokter->email ?? '-' }}</p>

                <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-bold">
                    {{ $dokter->spesialis }}
                </span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-soft-xl p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h6 class="text-xl font-bold text-slate-700">Jadwal Praktik</h6>
                <p class="text-sm text-slate-400 mt-1">
                    Pilih jadwal untuk melanjutkan booking konsultasi.
                </p>
            </div>

            <a href="{{ route('pasien.dokter.index') }}"
               class="px-4 py-2 bg-slate-100 text-slate-600 rounded-xl text-sm font-semibold">
                Kembali
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
            @forelse($dokter->jadwalPraktik as $jadwal)
                <div class="border border-slate-100 rounded-2xl p-5 hover:border-blue-300 hover:bg-blue-50 transition">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h6 class="text-lg font-bold text-slate-700">{{ $jadwal->hari }}</h6>
                            <p class="text-sm text-slate-400">
                                {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}
                                -
                                {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                            </p>
                        </div>

                        <span class="px-3 py-1 rounded-full bg-green-50 text-green-600 text-xs font-bold">
                            Aktif
                        </span>
                    </div>

                    <div class="mb-5">
                        <p class="text-sm text-slate-500">
                            Kuota tersedia:
                            <span class="font-bold text-slate-700">{{ $jadwal->kuota }} pasien</span>
                        </p>
                    </div>

                    <a href="#"
                       class="block text-center px-4 py-2 bg-blue-500 text-white rounded-xl text-sm font-semibold hover:bg-blue-600">
                        Booking Jadwal
                    </a>
                </div>
            @empty
                <div class="col-span-full border border-dashed border-slate-200 rounded-2xl p-10 text-center">
                    <p class="text-slate-400">Dokter ini belum memiliki jadwal praktik aktif.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection