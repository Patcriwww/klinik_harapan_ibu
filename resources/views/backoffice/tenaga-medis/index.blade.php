@extends('backoffice.layouts.app')

@section('breadcrumb', 'Data Tenaga Medis')
@section('title', 'Data Tenaga Medis')

@section('content')
<style>
    .medics-page {
        padding: 8px 0 2px;
    }

    .medics-shell {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 28px;
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
        overflow: hidden;
    }

    .medics-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
        padding: 30px 30px 22px;
        border-bottom: 1px solid #eef2f7;
        background:
            radial-gradient(circle at top right, rgba(14, 165, 233, 0.12), transparent 28%),
            linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
    }

    .medics-title {
        margin: 0;
        font-size: 32px;
        line-height: 1.1;
        font-weight: 900;
        color: #1e293b;
    }

    .medics-subtitle {
        margin: 10px 0 0;
        font-size: 15px;
        color: #64748b;
        max-width: 620px;
    }

    .medics-toolbar {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }

    .medics-meta {
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

    .medics-add-btn {
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

    .medics-add-btn:hover {
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 18px 32px rgba(37, 99, 235, 0.28);
    }

    .medics-body {
        padding: 18px 18px 22px;
    }

    .medics-table-wrap {
        overflow-x: auto;
        border-radius: 22px;
        background: #f8fafc;
        border: 1px solid #eef2f7;
        padding: 10px;
    }

    .medics-table {
        width: 100%;
        min-width: 980px;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .medics-table th {
        padding: 10px 16px 14px;
        font-size: 12px;
        font-weight: 900;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        text-align: left;
    }

    .medics-table th.center,
    .medics-table td.center {
        text-align: center;
    }

    .medics-table td {
        padding: 18px 16px;
        background: #ffffff;
        color: #334155;
        font-size: 14px;
        vertical-align: middle;
        border-top: 1px solid #eef2f7;
        border-bottom: 1px solid #eef2f7;
    }

    .medics-table td:first-child {
        border-left: 1px solid #eef2f7;
        border-radius: 18px 0 0 18px;
    }

    .medics-table td:last-child {
        border-right: 1px solid #eef2f7;
        border-radius: 0 18px 18px 0;
    }

    .medics-table tr:hover td {
        background: #fcfdff;
    }

    .medics-number {
        width: 56px;
        text-align: center;
        font-size: 20px;
        font-weight: 900;
        color: #2563eb;
    }

    .medics-person {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .medics-avatar,
    .medics-avatar img {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        flex-shrink: 0;
    }

    .medics-avatar {
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        color: #1d4ed8;
        font-size: 20px;
        font-weight: 900;
        border: 1px solid #dbeafe;
    }

    .medics-avatar img {
        object-fit: cover;
    }

    .medics-name {
        margin: 0;
        font-size: 16px;
        font-weight: 800;
        color: #1e293b;
    }

    .medics-email {
        margin-top: 4px;
        font-size: 13px;
        color: #64748b;
        word-break: break-word;
    }

    .medics-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        white-space: nowrap;
    }

    .medics-pill-blue {
        background: #eff6ff;
        color: #2563eb;
    }

    .medics-pill-green {
        background: #dcfce7;
        color: #16a34a;
    }

    .medics-pill-red {
        background: #fee2e2;
        color: #dc2626;
    }

    .medics-sip {
        font-weight: 800;
        color: #475569;
        letter-spacing: 0.02em;
    }

    .medics-actions {
        display: flex;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .medics-action-link,
    .medics-action-btn {
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

    .medics-action-link {
        background: #eff6ff;
        color: #2563eb;
    }

    .medics-action-link:hover {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .medics-action-btn {
        background: #fef2f2;
        color: #dc2626;
    }

    .medics-action-btn:hover {
        background: #fee2e2;
    }

    .medics-empty {
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
        .medics-header {
            flex-direction: column;
            align-items: stretch;
        }

        .medics-toolbar {
            justify-content: space-between;
            flex-wrap: wrap;
        }
    }

    @media (max-width: 640px) {
        .medics-page {
            padding-top: 0;
        }

        .medics-header {
            padding: 24px 20px 18px;
        }

        .medics-body {
            padding: 12px;
        }

        .medics-title {
            font-size: 26px;
        }

        .medics-add-btn {
            width: 100%;
        }

        .medics-meta {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="medics-page">
    <div class="medics-shell">
        <div class="medics-header">
            <div>
                <h1 class="medics-title">Data Tenaga Medis</h1>
                <p class="medics-subtitle">
                    Kelola data dokter, bidan, dan tenaga kesehatan klinik dengan tampilan yang lebih rapi, cepat dipindai, dan nyaman saat diedit.
                </p>
            </div>

            <div class="medics-toolbar">
                <div class="medics-meta">
                    <i class="ni ni-single-copy-04"></i>
                    <span>{{ $tenagaMedis->count() }} tenaga medis terdaftar</span>
                </div>

                <a href="{{ route('admin.backoffice.tenaga-medis.create') }}" class="medics-add-btn">
                    <i class="ni ni-fat-add"></i>
                    <span>Tambah Tenaga Medis</span>
                </a>
            </div>
        </div>

        <div class="medics-body">
            <div class="medics-table-wrap">
                <table class="medics-table">
                    <thead>
                        <tr>
                            <th class="center">No</th>
                            <th>Tenaga Medis</th>
                            <th>Spesialis</th>
                            <th>SIP</th>
                            <th>Status</th>
                            <th class="center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($tenagaMedis as $item)
                            <tr>
                                <td class="medics-number">{{ $loop->iteration }}</td>

                                <td>
                                    <div class="medics-person">
                                        @if($item->foto)
                                            <div class="medics-avatar">
                                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}">
                                            </div>
                                        @else
                                            <div class="medics-avatar">
                                                {{ strtoupper(substr($item->nama, 0, 1)) }}
                                            </div>
                                        @endif

                                        <div>
                                            <p class="medics-name">{{ $item->nama }}</p>
                                            <div class="medics-email">{{ $item->email ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="medics-pill medics-pill-blue">
                                        {{ $item->spesialis ?? 'Belum diisi' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="medics-sip">{{ $item->sip ?? '-' }}</span>
                                </td>

                                <td>
                                    @if($item->is_active)
                                        <span class="medics-pill medics-pill-green">Aktif</span>
                                    @else
                                        <span class="medics-pill medics-pill-red">Nonaktif</span>
                                    @endif
                                </td>

                                <td class="center">
                                    <div class="medics-actions">
                                        <a href="{{ route('admin.backoffice.tenaga-medis.edit', $item->id) }}"
                                           class="medics-action-link">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.backoffice.tenaga-medis.destroy', $item->id) }}"
                                              method="POST"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button"
                                                    onclick="confirmDelete(this)"
                                                    class="medics-action-btn">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="medics-empty">
                                    Belum ada data tenaga medis.
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

    function confirmDelete(button) {
        Swal.fire({
            title: 'Yakin?',
            text: 'Data tenaga medis akan dihapus!',
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
