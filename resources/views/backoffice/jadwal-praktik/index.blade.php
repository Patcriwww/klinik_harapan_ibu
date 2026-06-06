@extends('backoffice.layouts.app')

@section('breadcrumb', 'Jadwal Praktik')
@section('title', 'Jadwal Praktik')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="bg-white shadow-soft-xl rounded-2xl p-6">

        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <div>
                <h6 class="text-xl font-bold text-slate-700">Jadwal Praktik Dokter</h6>
                <p class="text-sm text-slate-400 mt-1">
                    Kelola jadwal praktik tenaga medis berdasarkan hari, jam, dan kuota pasien.
                </p>
            </div>

            <a href="{{ route('admin.backoffice.jadwal-praktik.create') }}"
               class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-blue-500 rounded-xl shadow hover:bg-blue-600 transition">
                + Tambah Jadwal
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 uppercase text-xs">
                        <th class="px-4 py-4 rounded-l-xl">No</th>
                        <th class="px-4 py-4">Dokter</th>
                        <th class="px-4 py-4">Hari</th>
                        <th class="px-4 py-4">Jam Praktik</th>
                        <th class="px-4 py-4">Kuota</th>
                        <th class="px-4 py-4">Status</th>
                        <th class="px-4 py-4 text-center rounded-r-xl">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($jadwal as $item)
                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                            <td class="px-4 py-4 font-semibold text-slate-600">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-4 py-4">
                                <div class="font-bold text-slate-700">
                                    {{ $item->tenagaMedis->nama ?? '-' }}
                                </div>
                                <div class="text-xs text-slate-400">
                                    {{ $item->tenagaMedis->spesialis ?? '-' }}
                                </div>
                            </td>

                            <td class="px-4 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-600">
                                    {{ $item->hari }}
                                </span>
                            </td>

                            <td class="px-4 py-4 font-semibold text-slate-600">
                                {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}
                                -
                                {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}
                            </td>

                            <td class="px-4 py-4">
                                {{ $item->kuota }} pasien
                            </td>

                            <td class="px-4 py-4">
                                @if($item->is_active)
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-50 text-green-600">
                                        Aktif
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-50 text-red-600">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-4 text-center">
                                <a href="{{ route('admin.backoffice.jadwal-praktik.edit', $item->id) }}"
                                   class="px-3 py-1.5 text-xs font-semibold text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100">
                                    Edit
                                </a>

                                <form action="{{ route('admin.backoffice.jadwal-praktik.destroy', $item->id) }}"
                                      method="POST"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                            onclick="confirmDelete(this)"
                                            class="px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-50 rounded-lg hover:bg-red-100">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-slate-400">
                                Belum ada jadwal praktik.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 1800,
            showConfirmButton: false
        });
    @endif

    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ $errors->first() }}'
        });
    @endif

    function confirmDelete(button) {
        Swal.fire({
            title: 'Yakin?',
            text: 'Jadwal praktik akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        });
    }
</script>
@endpush