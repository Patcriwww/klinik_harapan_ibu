@extends('backoffice.layouts.app')

@section('breadcrumb', 'Data Pasien')
@section('title', 'Data Pasien')

@section('content')
<style>
    .patients-page {
        padding: 8px 0 2px;
    }

    .patients-shell {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 28px;
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
        overflow: hidden;
    }

    .patients-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
        padding: 30px 30px 22px;
        border-bottom: 1px solid #eef2f7;
        background:
            radial-gradient(circle at top right, rgba(16, 185, 129, 0.12), transparent 28%),
            linear-gradient(180deg, #ffffff 0%, #f8fffc 100%);
    }

    .patients-title {
        margin: 0;
        font-size: 32px;
        line-height: 1.1;
        font-weight: 900;
        color: #1e293b;
    }

    .patients-subtitle {
        margin: 10px 0 0;
        font-size: 15px;
        color: #64748b;
        max-width: 640px;
    }

    .patients-toolbar {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }

    .patients-meta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        background: #ecfdf5;
        border-radius: 999px;
        color: #059669;
        font-size: 13px;
        font-weight: 800;
        white-space: nowrap;
    }

    .patients-add-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 14px 20px;
        border-radius: 16px;
        background: linear-gradient(135deg, #10b981, #059669);
        color: #ffffff;
        font-size: 14px;
        font-weight: 800;
        text-decoration: none;
        box-shadow: 0 14px 28px rgba(5, 150, 105, 0.22);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .patients-add-btn:hover {
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 18px 32px rgba(5, 150, 105, 0.28);
    }

    .patients-body {
        padding: 18px 18px 22px;
    }

    .patients-table-wrap {
        overflow-x: auto;
        border-radius: 22px;
        background: #f8fafc;
        border: 1px solid #eef2f7;
        padding: 10px;
    }

    .patients-table {
        width: 100%;
        min-width: 980px;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .patients-table th {
        padding: 10px 16px 14px;
        font-size: 12px;
        font-weight: 900;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        text-align: left;
    }

    .patients-table th.center,
    .patients-table td.center {
        text-align: center;
    }

    .patients-table td {
        padding: 18px 16px;
        background: #ffffff;
        color: #334155;
        font-size: 14px;
        vertical-align: middle;
        border-top: 1px solid #eef2f7;
        border-bottom: 1px solid #eef2f7;
    }

    .patients-table td:first-child {
        border-left: 1px solid #eef2f7;
        border-radius: 18px 0 0 18px;
    }

    .patients-table td:last-child {
        border-right: 1px solid #eef2f7;
        border-radius: 0 18px 18px 0;
    }

    .patients-table tr:hover td {
        background: #fcfffe;
    }

    .patients-number {
        width: 56px;
        text-align: center;
        font-size: 20px;
        font-weight: 900;
        color: #059669;
    }

    .patients-person {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .patients-avatar {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: #047857;
        font-size: 19px;
        font-weight: 900;
        border: 1px solid #d1fae5;
    }

    .patients-name {
        margin: 0;
        font-size: 16px;
        font-weight: 800;
        color: #1e293b;
    }

    .patients-id {
        margin-top: 4px;
        font-size: 13px;
        color: #64748b;
    }

    .patients-email {
        color: #334155;
        font-weight: 700;
        word-break: break-word;
    }

    .patients-role {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        background: #ecfdf5;
        color: #059669;
        text-transform: capitalize;
    }

    .patients-created {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .patients-created strong {
        color: #334155;
        font-size: 14px;
    }

    .patients-created span {
        color: #94a3b8;
        font-size: 12px;
    }

    .patients-actions {
        display: flex;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .patients-action-link,
    .patients-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 74px;
        padding: 9px 14px;
        border: none;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 800;
        text-decoration: none;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .patients-action-link {
        background: #eff6ff;
        color: #2563eb;
    }

    .patients-action-link:hover {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .patients-action-btn {
        background: #fef2f2;
        color: #dc2626;
    }

    .patients-action-btn:hover {
        background: #fee2e2;
    }

    .patients-empty {
        padding: 54px 24px !important;
        text-align: center;
        color: #94a3b8;
        font-size: 15px;
        font-weight: 700;
        border-radius: 18px !important;
        border: 1px dashed #cbd5e1 !important;
        background: #ffffff !important;
    }

    @media (max-width: 1100px) {
        .patients-header {
            flex-direction: column;
            align-items: stretch;
        }

        .patients-toolbar {
            justify-content: space-between;
            flex-wrap: wrap;
        }
    }

    @media (max-width: 640px) {
        .patients-page {
            padding-top: 0;
        }

        .patients-header {
            padding: 24px 20px 18px;
        }

        .patients-body {
            padding: 12px;
        }

        .patients-title {
            font-size: 26px;
        }

        .patients-add-btn {
            width: 100%;
        }

        .patients-meta {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="patients-page">
    <div class="patients-shell">
        <div class="patients-header">
            <div>
                <h1 class="patients-title">Data Pasien</h1>
                <p class="patients-subtitle">
                    Kelola daftar akun pasien yang terdaftar di sistem klinik dengan tampilan yang lebih bersih, mudah dipindai, dan konsisten dengan halaman backoffice lainnya.
                </p>
            </div>

            <div class="patients-toolbar">
                <div class="patients-meta">
                    <i class="ni ni-single-02"></i>
                    <span>{{ $users->count() }} pasien terdaftar</span>
                </div>

                <a href="{{ route('admin.backoffice.users.create') }}" class="patients-add-btn">
                    <i class="ni ni-fat-add"></i>
                    <span>Tambah Pasien</span>
                </a>
            </div>
        </div>

        <div class="patients-body">
            <div class="patients-table-wrap">
                <table class="patients-table">
                    <thead>
                        <tr>
                            <th class="center">No</th>
                            <th>Pasien</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Terdaftar</th>
                            <th class="center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="patients-number">{{ $loop->iteration }}</td>

                                <td>
                                    <div class="patients-person">
                                        <div class="patients-avatar">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>

                                        <div>
                                            <p class="patients-name">{{ $user->name }}</p>
                                            <div class="patients-id">User ID: {{ $user->id }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="patients-email">{{ $user->email }}</span>
                                </td>

                                <td>
                                    <span class="patients-role">
                                        {{ $user->roles->pluck('name')->join(', ') ?: 'pasien' }}
                                    </span>
                                </td>

                                <td>
                                    <div class="patients-created">
                                        <strong>{{ optional($user->created_at)->format('d M Y') ?? '-' }}</strong>
                                        <span>{{ optional($user->created_at)->format('H:i') ? optional($user->created_at)->format('H:i') . ' WIB' : '' }}</span>
                                    </div>
                                </td>

                                <td class="center">
                                    <div class="patients-actions">
                                        <a href="{{ route('admin.backoffice.users.edit', $user->id) }}"
                                           class="patients-action-link">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.backoffice.users.destroy', $user->id) }}"
                                              method="POST"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button"
                                                    onclick="confirmDelete(this)"
                                                    class="patients-action-btn">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="patients-empty">
                                    Belum ada data pasien.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

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

    function confirmDelete(button) {
        Swal.fire({
            title: 'Yakin?',
            text: 'Data pasien akan dihapus permanen!',
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
