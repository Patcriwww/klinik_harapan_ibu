@extends('backoffice.layouts.app')

@section('breadcrumb', 'Data Layanan')
@section('title', 'Data Layanan')

@section('content')
<style>
    .services-page {
        padding: 8px 0 2px;
    }

    .services-shell {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 28px;
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
        overflow: hidden;
    }

    .services-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
        padding: 30px 30px 22px;
        border-bottom: 1px solid #eef2f7;
        background:
            radial-gradient(circle at top right, rgba(244, 114, 182, 0.12), transparent 28%),
            linear-gradient(180deg, #ffffff 0%, #fffafc 100%);
    }

    .services-title {
        margin: 0;
        font-size: 32px;
        line-height: 1.1;
        font-weight: 900;
        color: #1e293b;
    }

    .services-subtitle {
        margin: 10px 0 0;
        font-size: 15px;
        color: #64748b;
        max-width: 640px;
    }

    .services-toolbar {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }

    .services-meta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        background: #fdf2f8;
        border-radius: 999px;
        color: #db2777;
        font-size: 13px;
        font-weight: 800;
        white-space: nowrap;
    }

    .services-add-btn {
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

    .services-add-btn:hover {
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 18px 32px rgba(37, 99, 235, 0.28);
    }

    .services-body {
        padding: 18px 18px 22px;
    }

    .services-table-wrap {
        overflow-x: auto;
        border-radius: 22px;
        background: #f8fafc;
        border: 1px solid #eef2f7;
        padding: 10px;
    }

    .services-table {
        width: 100%;
        min-width: 1080px;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .services-table th {
        padding: 10px 16px 14px;
        font-size: 12px;
        font-weight: 900;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        text-align: left;
    }

    .services-table th.center,
    .services-table td.center {
        text-align: center;
    }

    .services-table td {
        padding: 18px 16px;
        background: #ffffff;
        color: #334155;
        font-size: 14px;
        vertical-align: middle;
        border-top: 1px solid #eef2f7;
        border-bottom: 1px solid #eef2f7;
    }

    .services-table td:first-child {
        border-left: 1px solid #eef2f7;
        border-radius: 18px 0 0 18px;
    }

    .services-table td:last-child {
        border-right: 1px solid #eef2f7;
        border-radius: 0 18px 18px 0;
    }

    .services-table tr:hover td {
        background: #fffdfd;
    }

    .services-number {
        width: 56px;
        text-align: center;
        font-size: 20px;
        font-weight: 900;
        color: #db2777;
    }

    .services-name {
        min-width: 340px;
    }

    .services-name strong {
        display: block;
        color: #1e293b;
        font-size: 16px;
        font-weight: 800;
    }

    .services-description {
        margin-top: 4px;
        color: #64748b;
        font-size: 13px;
        line-height: 1.5;
    }

    .services-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        white-space: nowrap;
    }

    .services-pill-purple {
        background: #f5f3ff;
        color: #7c3aed;
    }

    .services-pill-green {
        background: #dcfce7;
        color: #16a34a;
    }

    .services-pill-red {
        background: #fee2e2;
        color: #dc2626;
    }

    .services-price {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .services-price strong {
        color: #0f172a;
        font-size: 18px;
        font-weight: 900;
    }

    .services-price span {
        color: #94a3b8;
        font-size: 12px;
    }

    .services-actions {
        display: flex;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .services-action-link,
    .services-action-btn {
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

    .services-action-link {
        background: #eff6ff;
        color: #2563eb;
    }

    .services-action-link:hover {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .services-action-btn {
        background: #fef2f2;
        color: #dc2626;
    }

    .services-action-btn:hover {
        background: #fee2e2;
    }

    .services-empty {
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
        .services-header {
            flex-direction: column;
            align-items: stretch;
        }

        .services-toolbar {
            justify-content: space-between;
            flex-wrap: wrap;
        }
    }

    @media (max-width: 640px) {
        .services-page {
            padding-top: 0;
        }

        .services-header {
            padding: 24px 20px 18px;
        }

        .services-body {
            padding: 12px;
        }

        .services-title {
            font-size: 26px;
        }

        .services-add-btn {
            width: 100%;
        }

        .services-meta {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="services-page">
    <div class="services-shell">
        <div class="services-header">
            <div>
                <h1 class="services-title">Data Layanan Klinik</h1>
                <p class="services-subtitle">
                    Kelola daftar layanan konsultasi, tarif, dan durasi pelayanan klinik dengan tampilan yang lebih rapi dan konsisten seperti halaman backoffice lainnya.
                </p>
            </div>

            <div class="services-toolbar">
                <div class="services-meta">
                    <i class="ni ni-collection"></i>
                    <span>{{ $layanans->count() }} layanan tersimpan</span>
                </div>

                <a href="{{ route('admin.backoffice.layanan.create') }}" class="services-add-btn">
                    <i class="ni ni-fat-add"></i>
                    <span>Tambah Layanan</span>
                </a>
            </div>
        </div>

        <div class="services-body">
            <div class="services-table-wrap">
                <table class="services-table">
                    <thead>
                        <tr>
                            <th class="center">No</th>
                            <th>Nama Layanan</th>
                            <th>Durasi</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th class="center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($layanans as $layanan)
                            <tr>
                                <td class="services-number">{{ $loop->iteration }}</td>

                                <td class="services-name">
                                    <strong>{{ $layanan->nama_layanan }}</strong>
                                    <div class="services-description">{{ $layanan->deskripsi ?? '-' }}</div>
                                </td>

                                <td>
                                    <span class="services-pill services-pill-purple">
                                        {{ $layanan->durasi }} menit
                                    </span>
                                </td>

                                <td>
                                    <div class="services-price">
                                        <strong>Rp {{ number_format($layanan->harga, 0, ',', '.') }}</strong>
                                        <span>Tarif layanan</span>
                                    </div>
                                </td>

                                <td>
                                    @if($layanan->is_active)
                                        <span class="services-pill services-pill-green">Aktif</span>
                                    @else
                                        <span class="services-pill services-pill-red">Nonaktif</span>
                                    @endif
                                </td>

                                <td class="center">
                                    <div class="services-actions">
                                        <a href="{{ route('admin.backoffice.layanan.edit', $layanan->id) }}"
                                           class="services-action-link">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.backoffice.layanan.destroy', $layanan->id) }}"
                                              method="POST"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button"
                                                    onclick="confirmDelete(this)"
                                                    class="services-action-btn">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="services-empty">
                                    Belum ada data layanan.
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
            text: 'Data layanan akan dihapus!',
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
