@extends('backoffice.layouts.app')

@section('breadcrumb', 'Dokter')
@section('title', 'Daftar Dokter')

@section('content')
<div class="w-full px-6 py-6 mx-auto">

    <div class="bg-white rounded-2xl shadow-soft-xl p-6 mb-6">
        <div class="flex flex-wrap justify-between items-center gap-4">
            <div>
                <h6 class="text-xl font-bold text-slate-700">Daftar Dokter</h6>
                <p class="text-sm text-slate-400 mt-1">
                    Pilih dokter dan lihat jadwal praktik yang tersedia.
                </p>
            </div>

            <form method="GET" action="{{ route('pasien.dokter.index') }}" class="flex gap-3">
                <select name="spesialis"
                        class="px-4 py-3 border border-slate-200 rounded-xl text-sm min-w-[220px]">
                    <option value="">Semua Spesialis</option>
                    @foreach($spesialisList as $spesialis)
                        <option value="{{ $spesialis }}" {{ request('spesialis') == $spesialis ? 'selected' : '' }}>
                            {{ $spesialis }}
                        </option>
                    @endforeach
                </select>

                <button class="px-5 py-3 bg-blue-500 text-white rounded-xl text-sm font-semibold">
                    Filter
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse($dokters as $dokter)
            <div class="bg-white rounded-2xl shadow-soft-xl overflow-hidden hover:shadow-lg transition">
                <div class="h-36 bg-gradient-to-r from-blue-500 to-cyan-400"></div>

                <div class="p-6 -mt-16">
                    <div class="flex items-end gap-4 mb-4">
                        @if($dokter->foto)
                            <img src="{{ asset('storage/'.$dokter->foto) }}"
                                 style="width:88px;height:88px;object-fit:cover;border-radius:18px;"
                                 class="border-4 border-white shadow-md"
                                 alt="{{ $dokter->nama }}">
                        @else
                            <div class="w-22 h-22 bg-blue-100 text-blue-600 border-4 border-white shadow-md rounded-2xl flex items-center justify-center font-bold text-2xl">
                                {{ strtoupper(substr($dokter->nama, 0, 1)) }}
                            </div>
                        @endif

                        <div class="pb-2">
                            <h6 class="text-lg font-bold text-slate-700">{{ $dokter->nama }}</h6>
                            <span class="inline-block mt-1 px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-600">
                                {{ $dokter->spesialis }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-2 text-sm text-slate-500 mb-5">
                        <div class="flex items-center gap-2">
                            <i class="ni ni-email-83 text-blue-500"></i>
                            <span>{{ $dokter->email ?? '-' }}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <i class="ni ni-mobile-button text-green-500"></i>
                            <span>{{ $dokter->no_hp ?? '-' }}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <i class="ni ni-calendar-grid-58 text-orange-500"></i>
                            <span>{{ $dokter->jadwalPraktik->where('is_active', 1)->count() }} jadwal tersedia</span>
                        </div>
                    </div>

                    <a href="{{ route('pasien.dokter.jadwal', $dokter->id) }}"
                       class="block w-full text-center px-5 py-3 bg-blue-500 text-white rounded-xl text-sm font-semibold hover:bg-blue-600">
                        Lihat Jadwal
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl shadow-soft-xl p-10 text-center">
                <p class="text-slate-400">Belum ada dokter tersedia.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection