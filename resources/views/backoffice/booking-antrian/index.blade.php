@extends('backoffice.layouts.app')

@section('breadcrumb', 'Booking & Antrian')
@section('title', 'Booking & Antrian')

@section('content')
<style>
    .booking-admin-wrapper {
        padding: 26px;
    }

    .booking-admin-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 8px 22px rgba(15, 23, 42, .08);
    }

    .booking-admin-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 24px;
    }

    .booking-admin-title {
        font-size: 26px;
        font-weight: 900;
        color: #1e293b;
        margin: 0;
    }

    .booking-admin-subtitle {
        color: #94a3b8;
        margin-top: 8px;
        font-size: 15px;
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

    .booking-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
    }

    .booking-table thead th {
        font-size: 12px;
        text-transform: uppercase;
        color: #64748b;
        text-align: left;
        padding: 12px 16px;
        font-weight: 900;
    }

    .booking-table tbody tr {
        background: #ffffff;
        box-shadow: 0 5px 14px rgba(15, 23, 42, .08);
    }

    .booking-table tbody td {
        padding: 16px;
        color: #334155;
        font-size: 14px;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
    }

    .booking-table tbody td:first-child {
        border-left: 1px solid #f1f5f9;
        border-radius: 16px 0 0 16px;
    }

    .booking-table tbody td:last-child {
        border-right: 1px solid #f1f5f9;
        border-radius: 0 16px 16px 0;
    }

    .queue-number {
        font-size: 24px;
        font-weight: 900;
        color: #2563eb;
    }

    .small-muted {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 4px;
    }

    .status-badge {
        padding: 7px 13px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        white-space: nowrap;
    }

    .status-menunggu {
        background: #fef9c3;
        color: #ca8a04;
    }

    .status-diproses {
        background: #dbeafe;
        color: #2563eb;
    }

    .status-selesai {
        background: #dcfce7;
        color: #16a34a;
    }

    .status-batal {
        background: #fee2e2;
        color: #dc2626;
    }

    .status-form select {
        height: 38px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 0 10px;
        font-size: 13px;
        color: #475569;
        outline: none;
    }

    .btn-update {
        height: 38px;
        border: none;
        border-radius: 12px;
        padding: 0 12px;
        background: #2563eb;
        color: white;
        font-weight: 800;
        font-size: 13px;
        margin-left: 6px;
        cursor: pointer;
    }

    @media(max-width: 1000px) {
        .table-responsive {
            overflow-x: auto;
        }

        .booking-table {
            min-width: 1000px;
        }
    }
</style>

<div class="booking-admin-wrapper">
    <div class="booking-admin-card">

        <div class="booking-admin-header">
            <div>
                <h1 class="booking-admin-title">Booking & Antrian</h1>
                <p class="booking-admin-subtitle">
                    Kelola booking konsultasi pasien, nomor antrian, dan status pelayanan.
                </p>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.backoffice.booking-antrian.index') }}" class="filter-box">
            <input type="date" name="tanggal" value="{{ request('tanggal') }}">

            <select name="status">
                <option value="">Semua Status</option>
                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Batal</option>
            </select>

            <button type="submit" class="btn-filter">Filter</button>

            <a href="{{ route('admin.backoffice.booking-antrian.index') }}" class="btn-reset">
                Reset
            </a>
        </form>

        @if(session('success'))
            <div style="background:#dcfce7;color:#15803d;padding:14px 16px;border-radius:16px;margin-bottom:18px;font-weight:800;">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>Antrian</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Jadwal</th>
                        <th>Keluhan</th>
                        <th>Status</th>
                        <th>Ubah Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($bookings as $booking)
                        @php
                            $statusClass = match($booking->status) {
                                'diproses' => 'status-diproses',
                                'selesai' => 'status-selesai',
                                'batal' => 'status-batal',
                                default => 'status-menunggu',
                            };
                        @endphp

                        <tr>
                            <td>
                                <div class="queue-number">{{ $booking->nomor_antrian }}</div>
                                <div class="small-muted">{{ $booking->kode_booking }}</div>
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
                                    {{ \Carbon\Carbon::parse($booking->tanggal_konsultasi)->format('d/m/Y') }}
                                </strong>
                                <div class="small-muted">
                                    {{ \Carbon\Carbon::parse($booking->jam_konsultasi)->format('H:i') }} WIB
                                </div>
                            </td>

                            <td>
                                {{ $booking->keluhan }}
                            </td>

                            <td>
                                <span class="status-badge {{ $statusClass }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>

                            <td>
                                <form action="{{ route('admin.backoffice.booking-antrian.update-status', $booking->id) }}"
                                      method="POST"
                                      class="status-form">
                                    @csrf
                                    @method('PATCH')

                                    <select name="status">
                                        <option value="menunggu" {{ $booking->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                        <option value="diproses" {{ $booking->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="selesai" {{ $booking->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="batal" {{ $booking->status == 'batal' ? 'selected' : '' }}>Batal</option>
                                    </select>

                                    <button type="submit" class="btn-update">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center;color:#94a3b8;padding:30px;">
                                Belum ada data booking.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection