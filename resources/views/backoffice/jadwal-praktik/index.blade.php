@extends('backoffice.layouts.app')

@section('breadcrumb', 'Jadwal Praktik')
@section('title', 'Jadwal Praktik')

@section('content')
<style>
    .schedule-page {
        padding: 8px 0 2px;
    }

    .schedule-shell {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 28px;
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
        overflow: hidden;
    }

    .schedule-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
        padding: 30px 30px 22px;
        border-bottom: 1px solid #eef2f7;
        background:
            radial-gradient(circle at top right, rgba(59, 130, 246, 0.12), transparent 28%),
            linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
    }

    .schedule-title {
        margin: 0;
        font-size: 32px;
        line-height: 1.1;
        font-weight: 900;
        color: #1e293b;
    }

    .schedule-subtitle {
        margin: 10px 0 0;
        font-size: 15px;
        color: #64748b;
        max-width: 640px;
    }

    .schedule-toolbar {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }

    .schedule-meta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        background: #eff6ff;
        border-radius: 999px;
        color: #2563eb;
        font-size: 13px;
        font-weight: 800;
        white-space: nowrap;
    }

    .schedule-add-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 14px 20px;
        border-radius: 16px;
        background: linear-gradient(135deg, #0ea5e9, #2563eb);
        color: #ffffff;
        font-size: 14px;
        font-weight: 800;
        text-decoration: none;
        box-shadow: 0 14px 28px rgba(37, 99, 235, 0.22);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .schedule-add-btn:hover {
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 18px 32px rgba(37, 99, 235, 0.28);
    }

    .schedule-body {
        padding: 18px 18px 22px;
    }

    .schedule-table-wrap {
        overflow-x: auto;
        border-radius: 22px;
        background: #f8fafc;
        border: 1px solid #eef2f7;
        padding: 10px;
    }

    .schedule-table {
        width: 100%;
        min-width: 1080px;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .schedule-table th {
        padding: 10px 16px 14px;
        font-size: 12px;
        font-weight: 900;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        text-align: left;
    }

    .schedule-table th.center,
    .schedule-table td.center {
        text-align: center;
    }

    .schedule-table td {
        padding: 18px 16px;
        background: #ffffff;
        color: #334155;
        font-size: 14px;
        vertical-align: middle;
        border-top: 1px solid #eef2f7;
        border-bottom: 1px solid #eef2f7;
    }

    .schedule-table td:first-child {
        border-left: 1px solid #eef2f7;
        border-radius: 18px 0 0 18px;
    }

    .schedule-table td:last-child {
        border-right: 1px solid #eef2f7;
        border-radius: 0 18px 18px 0;
    }

    .schedule-table tr:hover td {
        background: #fcfdff;
    }

    .schedule-number {
        width: 56px;
        text-align: center;
        font-size: 20px;
        font-weight: 900;
        color: #2563eb;
    }

    .schedule-doctor {
        min-width: 280px;
    }

    .schedule-doctor-name {
        margin: 0;
        font-size: 16px;
        font-weight: 800;
        color: #1e293b;
    }

    .schedule-doctor-role {
        margin-top: 4px;
        font-size: 13px;
        color: #64748b;
    }

    .schedule-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        white-space: nowrap;
    }

    .schedule-pill-blue {
        background: #eff6ff;
        color: #2563eb;
    }

    .schedule-pill-cyan {
        background: #ecfeff;
        color: #0891b2;
    }

    .schedule-pill-green {
        background: #dcfce7;
        color: #16a34a;
    }

    .schedule-pill-red {
        background: #fee2e2;
        color: #dc2626;
    }

    .schedule-time {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-weight: 800;
        color: #334155;
    }

    .schedule-time i {
        color: #0ea5e9;
    }

    .schedule-capacity {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-weight: 800;
        color: #475569;
    }

    .schedule-capacity strong {
        font-size: 18px;
        color: #2563eb;
    }

    .schedule-actions {
        display: flex;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .schedule-action-link,
    .schedule-action-btn {
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

    .schedule-action-link {
        background: #eff6ff;
        color: #2563eb;
    }

    .schedule-action-link:hover {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .schedule-action-btn {
        background: #fef2f2;
        color: #dc2626;
    }

    .schedule-action-btn:hover {
        background: #fee2e2;
    }

    .schedule-empty {
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
        .schedule-header {
            flex-direction: column;
            align-items: stretch;
        }

        .schedule-toolbar {
            justify-content: space-between;
            flex-wrap: wrap;
        }
    }

    @media (max-width: 640px) {
        .schedule-page {
            padding-top: 0;
        }

        .schedule-header {
            padding: 24px 20px 18px;
        }

        .schedule-body {
            padding: 12px;
        }

        .schedule-title {
            font-size: 26px;
        }

        .schedule-add-btn {
            width: 100%;
        }

        .schedule-meta {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="schedule-page">
    <div class="schedule-shell">
        <div class="schedule-header">
            <div>
                <h1 class="schedule-title">Jadwal Praktik Dokter</h1>
                <p class="schedule-subtitle">
                    Kelola jadwal praktik tenaga medis berdasarkan hari, jam, dan kuota pasien dengan susunan yang lebih rapi dan mudah dicek cepat.
                </p>
            </div>

            <div class="schedule-toolbar">
                <div class="schedule-meta">
                    <i class="ni ni-calendar-grid-58"></i>
                    <span>{{ $jadwal->count() }} jadwal aktif tersimpan</span>
                </div>

                <a href="{{ route('admin.backoffice.jadwal-praktik.create') }}" class="schedule-add-btn">
                    <i class="ni ni-fat-add"></i>
                    <span>Tambah Jadwal</span>
                </a>
            </div>
        </div>

        <div class="schedule-body">
            <div class="schedule-table-wrap">
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th class="center">No</th>
                            <th>Dokter</th>
                            <th>Hari</th>
                            <th>Jam Praktik</th>
                            <th>Kuota</th>
                            <th>Status</th>
                            <th class="center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($jadwal as $item)
                            <tr>
                                <td class="schedule-number">{{ $loop->iteration }}</td>

                                <td class="schedule-doctor">
                                    <p class="schedule-doctor-name">{{ $item->tenagaMedis->nama ?? '-' }}</p>
                                    <div class="schedule-doctor-role">{{ $item->tenagaMedis->spesialis ?? '-' }}</div>
                                </td>

                                <td>
                                    <span class="schedule-pill schedule-pill-blue">
                                        {{ $item->hari }}
                                    </span>
                                </td>

                                <td>
                                    <span class="schedule-time">
                                        <i class="ni ni-watch-time"></i>
                                        {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}
                                    </span>
                                </td>

                                <td>
                                    <span class="schedule-capacity">
                                        <strong>{{ $item->kuota }}</strong>
                                        <span>pasien</span>
                                    </span>
                                </td>

                                <td>
                                    @if($item->is_active)
                                        <span class="schedule-pill schedule-pill-green">Aktif</span>
                                    @else
                                        <span class="schedule-pill schedule-pill-red">Nonaktif</span>
                                    @endif
                                </td>

                                <td class="center">
                                    <div class="schedule-actions">
                                        <a href="{{ route('admin.backoffice.jadwal-praktik.edit', $item->id) }}"
                                           class="schedule-action-link">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.backoffice.jadwal-praktik.destroy', $item->id) }}"
                                              method="POST"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button"
                                                    onclick="confirmDelete(this)"
                                                    class="schedule-action-btn">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="schedule-empty">
                                    Belum ada jadwal praktik.
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
