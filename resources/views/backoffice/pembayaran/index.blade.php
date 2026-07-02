@extends('backoffice.layouts.app')

@section('breadcrumb', 'Pembayaran')
@section('title', 'Pembayaran')

@section('content')
<style>
    .payment-admin-wrapper {
        padding: 26px;
    }

    .payment-admin-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 8px 22px rgba(15, 23, 42, .08);
    }

    .payment-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
        margin-bottom: 26px;
    }

    .payment-title {
        font-size: 26px;
        font-weight: 900;
        color: #1e293b;
        margin: 0;
    }

    .payment-subtitle {
        color: #94a3b8;
        margin-top: 8px;
        font-size: 15px;
    }

    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: #f8fafc;
        border-radius: 20px;
        padding: 20px;
        border: 1px solid #e2e8f0;
    }

    .stat-label {
        color: #64748b;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .stat-value {
        font-size: 24px;
        font-weight: 900;
        color: #1e293b;
    }

    .filter-box {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 24px;
        background: #f8fafc;
        padding: 16px;
        border-radius: 18px;
    }

    .filter-box select,
    .filter-box input {
        height: 44px;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 0 14px;
        color: #475569;
        outline: none;
    }

    .filter-box button,
    .filter-box a {
        height: 44px;
        border-radius: 14px;
        padding: 0 18px;
        border: none;
        font-weight: 800;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        cursor: pointer;
    }

    .btn-filter {
        background: #0ea5e9;
        color: white;
    }

    .btn-reset {
        background: #e2e8f0;
        color: #475569;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .payment-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
        min-width: 1150px;
    }

    .payment-table thead th {
        font-size: 12px;
        text-transform: uppercase;
        color: #64748b;
        text-align: left;
        padding: 12px 16px;
        font-weight: 900;
    }

    .payment-table tbody tr {
        background: #ffffff;
        box-shadow: 0 5px 14px rgba(15, 23, 42, .08);
    }

    .payment-table tbody td {
        padding: 16px;
        color: #334155;
        font-size: 14px;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: top;
    }

    .payment-table tbody td:first-child {
        border-left: 1px solid #f1f5f9;
        border-radius: 16px 0 0 16px;
    }

    .payment-table tbody td:last-child {
        border-right: 1px solid #f1f5f9;
        border-radius: 0 16px 16px 0;
    }

    .invoice-text {
        font-size: 14px;
        font-weight: 900;
        color: #2563eb;
    }

    .small-muted {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 4px;
    }

    .nominal-text {
        font-size: 16px;
        font-weight: 900;
        color: #1e293b;
    }

    .status-badge {
        display: inline-block;
        padding: 7px 13px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        white-space: nowrap;
    }

    .pay-pending {
        background: #fef3c7;
        color: #d97706;
    }

    .pay-menunggu_verifikasi {
        background: #dbeafe;
        color: #2563eb;
    }

    .pay-dibayar {
        background: #dcfce7;
        color: #16a34a;
    }

    .pay-ditolak {
        background: #fee2e2;
        color: #dc2626;
    }

    .proof-link {
        display: inline-flex;
        padding: 8px 12px;
        border-radius: 12px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 12px;
        font-weight: 900;
        text-decoration: none;
    }

    .action-form {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .btn-approve,
    .btn-reject {
        border: none;
        border-radius: 12px;
        padding: 9px 13px;
        font-size: 12px;
        font-weight: 900;
        color: white;
        cursor: pointer;
    }

    .btn-approve {
        background: #16a34a;
    }

    .btn-reject {
        background: #dc2626;
    }

    .empty-data {
        text-align: center;
        color: #94a3b8;
        padding: 34px;
    }
    .btn-export{
    display:inline-flex;
    align-items:center;
    gap:8px;

    padding:14px 28px;
    border-radius:18px;

    background:#16a34a;
    color:#fff !important;

    font-weight:700;
    font-size:16px;

    text-decoration:none;
    transition:.25s;
    box-shadow:0 8px 20px rgba(22,163,74,.25);
    }

    .btn-export:hover{
        background:#15803d;
        color:#fff !important;
        transform:translateY(-2px);
    }

    .btn-export i{
        font-size:18px;
    }

    @media(max-width: 1100px) {
        .stat-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media(max-width: 700px) {
        .payment-header {
            flex-direction: column;
        }

        .stat-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="payment-admin-wrapper">
    <div class="payment-admin-card">

        <div class="payment-header">
            <div>
                <h1 class="payment-title">Pembayaran</h1>
                <p class="payment-subtitle">
                    Kelola invoice, bukti pembayaran, dan verifikasi pembayaran pasien.
                </p>
            </div>
        </div>

        <div class="stat-grid">
            <div class="stat-card">
                <div class="stat-label">Total Invoice</div>
                <div class="stat-value">{{ $totalInvoice ?? 0 }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Menunggu Verifikasi</div>
                <div class="stat-value">{{ $totalMenunggu ?? 0 }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Sudah Dibayar</div>
                <div class="stat-value">{{ $totalDibayar ?? 0 }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Total Pendapatan</div>
                <div class="stat-value">
                    Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
                </div>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.backoffice.pembayaran.index') }}" class="filter-box">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari invoice / pasien">

            <select name="status">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="menunggu_verifikasi" {{ request('status') == 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                <option value="dibayar" {{ request('status') == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>

            <select name="metode">
                <option value="">Semua Metode</option>
                <option value="Transfer Bank" {{ request('metode') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                <option value="QRIS" {{ request('metode') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                <option value="E-Wallet" {{ request('metode') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
            </select>

            <button type="submit" class="btn-filter">Filter</button>

            <a href="{{ route('admin.backoffice.pembayaran.index') }}" class="btn-reset">
                Reset
            </a>
           <a href="{{ route('admin.backoffice.export.pembayaran') }}"
            class="btn-export">
                <i class="fas fa-file-excel"></i>
                Export Excel
            </a>
        </form>

        @if(session('success'))
            <div style="background:#dcfce7;color:#15803d;padding:14px 16px;border-radius:16px;margin-bottom:18px;font-weight:800;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background:#fee2e2;color:#dc2626;padding:14px 16px;border-radius:16px;margin-bottom:18px;font-weight:800;">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="payment-table">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Jadwal</th>
                        <th>Nominal</th>
                        <th>Metode</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pembayarans as $pembayaran)
                        @php
                            $status = $pembayaran->status ?? 'pending';
                            $statusClass = 'pay-' . $status;
                            $booking = $pembayaran->booking;
                        @endphp

                        <tr>
                            <td>
                                <div class="invoice-text">{{ $pembayaran->invoice_no }}</div>
                                <div class="small-muted">
                                    {{ $pembayaran->created_at?->format('d/m/Y H:i') }}
                                </div>
                            </td>

                            <td>
                                <strong>{{ $booking->pasien->name ?? '-' }}</strong>
                                <div class="small-muted">{{ $booking->pasien->email ?? '-' }}</div>
                            </td>

                            <td>
                                <strong>{{ $booking->tenagaMedis->nama ?? '-' }}</strong>
                                <div class="small-muted">{{ $booking->tenagaMedis->spesialis ?? '-' }}</div>
                            </td>

                            <td>
                                <strong>
                                    {{ $booking?->tanggal_konsultasi ? \Carbon\Carbon::parse($booking->tanggal_konsultasi)->format('d/m/Y') : '-' }}
                                </strong>
                                <div class="small-muted">
                                    {{ $booking?->jam_konsultasi ? \Carbon\Carbon::parse($booking->jam_konsultasi)->format('H:i') . ' WIB' : '-' }}
                                </div>
                            </td>

                            <td>
                                <div class="nominal-text">
                                    Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}
                                </div>
                            </td>

                            <td>
                                {{ $pembayaran->metode }}
                            </td>

                            <td>
                                @if($pembayaran->bukti_bayar)
                                    <a href="{{ asset('storage/' . $pembayaran->bukti_bayar) }}"
                                       target="_blank"
                                       class="proof-link">
                                        Lihat Bukti
                                    </a>
                                @else
                                    <span class="small-muted">Belum upload</span>
                                @endif
                            </td>

                            <td>
                                <span class="status-badge {{ $statusClass }}">
                                    {{ ucwords(str_replace('_', ' ', $status)) }}
                                </span>
                            </td>

                            <td>
                                @if($pembayaran->status === 'menunggu_verifikasi')
                                    <div class="action-form">
                                        <form action="{{ route('admin.backoffice.pembayaran.approve', $pembayaran->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Setujui pembayaran ini?')">
                                            @csrf
                                            <button type="submit" class="btn-approve">
                                                Approve
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.backoffice.pembayaran.reject', $pembayaran->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Tolak pembayaran ini?')">
                                            @csrf
                                            <button type="submit" class="btn-reject">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="small-muted">Tidak ada aksi</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="empty-data">
                                Belum ada data pembayaran.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($pembayarans, 'links'))
            <div style="margin-top:20px;">
                {{ $pembayarans->links() }}
            </div>
        @endif

    </div>
</div>
@endsection