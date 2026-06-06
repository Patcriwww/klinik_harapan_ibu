@extends('backoffice.layouts.app')

@section('breadcrumb', 'Management User')
@section('title', 'Data User')

@section('content')

<div class="w-full px-6 py-6 mx-auto">
    <div class="bg-white shadow-soft-xl rounded-2xl p-6">

        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <div>
                <h6 class="text-xl font-bold text-slate-700">Management User</h6>
                <p class="text-sm text-slate-400 mt-1">Kelola data pengguna dan role akun sistem</p>
            </div>

            <a href="{{ route('admin.backoffice.users.create') }}"
               class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-blue-500 rounded-xl shadow hover:bg-blue-600 transition">
                + Tambah User
            </a>
        </div>


        <div class="mt-6 overflow-x-auto">
            <table id="usersTable" class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 uppercase text-xs">
                        <th class="px-4 py-4 rounded-l-xl">No</th>
                        <th class="px-4 py-4">Nama</th>
                        <th class="px-4 py-4">Email</th>
                        <th class="px-4 py-4">Role</th>
                        <th class="px-4 py-4 text-center rounded-r-xl">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                            <td class="px-4 py-4 font-semibold text-slate-700">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 min-w-9 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-slate-700">{{ $user->name }}</div>
                                        <div class="text-xs text-slate-400">User ID: {{ $user->id }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-4">
                                {{ $user->email }}
                            </td>

                            <td class="px-4 py-4">
                                @php
                                    $roles = $user->roles->pluck('name')->join(', ');
                                @endphp

                                @if($roles)
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-600">
                                        {{ $roles }}
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-500">
                                        Belum ada role
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.backoffice.users.edit', $user->id) }}"
                                       class="px-3 py-1.5 text-xs font-semibold text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.backoffice.users.destroy', $user->id) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                        onclick="confirmDelete(this)"
                                        class="px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition">
                                    Hapus
                                </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

<style>
    #usersTable {
        border-collapse: separate !important;
        border-spacing: 0 10px !important;
        width: 100% !important;
    }

    #usersTable thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        padding: 14px 16px !important;
        border: none !important;
    }

    #usersTable tbody tr {
        background: #ffffff;
        box-shadow: 0 4px 12px rgba(15, 23, 42, .05);
    }

    #usersTable tbody td {
        padding: 16px !important;
        border-top: 1px solid #f1f5f9 !important;
        border-bottom: 1px solid #f1f5f9 !important;
        vertical-align: middle !important;
        color: #475569;
    }

    #usersTable tbody td:first-child,
    #usersTable thead th:first-child {
        border-radius: 14px 0 0 14px;
        width: 60px !important;
        text-align: center;
    }

    #usersTable tbody td:last-child,
    #usersTable thead th:last-child {
        border-radius: 0 14px 14px 0;
        width: 150px !important;
        text-align: center;
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 18px;
        color: #64748b !important;
        font-size: 14px;
    }

    .dataTables_wrapper .dataTables_length select {
        width: 76px;
        height: 38px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 6px 10px;
        margin: 0 6px;
        background-color: #fff;
    }

    .dataTables_wrapper .dataTables_filter input {
        width: 280px;
        height: 40px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 8px 14px;
        margin-left: 8px;
        outline: none;
        background-color: #fff;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #0ea5e9;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, .12);
    }

    .dataTables_wrapper .dataTables_info {
        padding-top: 18px !important;
        color: #64748b !important;
        font-size: 14px;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding-top: 14px !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: none !important;
        border-radius: 10px !important;
        padding: 8px 13px !important;
        margin: 0 3px !important;
        color: #64748b !important;
        background: transparent !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #eff6ff !important;
        color: #0284c7 !important;
        font-weight: 700 !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #f1f5f9 !important;
        color: #0284c7 !important;
    }

    table.dataTable.no-footer {
        border-bottom: none !important;
    }
    .swal2-actions {
        gap: 10px !important;
    }

    .swal2-confirm {
        background: #ef4444 !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 10px !important;
        padding: 10px 22px !important;
        font-weight: 700 !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    .swal2-cancel {
        background: #64748b !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 10px !important;
        padding: 10px 22px !important;
        font-weight: 700 !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    .swal2-confirm:hover {
        background: #dc2626 !important;
    }

    .swal2-cancel:hover {
        background: #475569 !important;
    }
</style>
@endpush

@push('scripts')
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}'
        });
    @endif
</script>
<script>
    function confirmDelete(button) {
        Swal.fire({
            title: 'Yakin?',
            text: 'Data akan dihapus permanen!',
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#usersTable').DataTable({
            pageLength: 10,
            responsive: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                zeroRecords: "Data tidak ditemukan",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Selanjutnya"
                }
            }
        });
    });
</script>
@endpush