@extends('backoffice.layouts.app')

@section('breadcrumb', 'Dashboard Tenaga Medis')
@section('title', 'Antrean Pasien')

@section('content')
<style>
    .doctor-dashboard-wrapper { padding: 26px; }
    .doctor-card-main {
        background: white;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 8px 22px rgba(15,23,42,.08);
    }
    .doctor-title {
        font-size: 26px;
        font-weight: 900;
        color: #1e293b;
        margin: 0;
    }
    .doctor-subtitle {
        color: #94a3b8;
        margin-top: 8px;
        font-size: 15px;
    }
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin: 24px 0;
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
        font-size: 28px;
        font-weight: 900;
        color: #2563eb;
    }
    .queue-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
    }
    .queue-table th {
        font-size: 12px;
        text-transform: uppercase;
        color: #64748b;
        text-align: left;
        padding: 12px 16px;
        font-weight: 900;
    }
    .queue-table td {
        background: white;
        padding: 16px;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 14px;
    }
    .queue-table td:first-child {
        border-left: 1px solid #f1f5f9;
        border-radius: 16px 0 0 16px;
    }
    .queue-table td:last-child {
        border-right: 1px solid #f1f5f9;
        border-radius: 0 16px 16px 0;
    }
    .queue-number {
        font-size: 26px;
        font-weight: 900;
        color: #2563eb;
    }
    .small-muted {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 4px;
    }
    .badge {
        padding: 7px 13px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
    }
    .badge-menunggu { background: #fef9c3; color: #ca8a04; }
    .badge-diproses { background: #dbeafe; color: #2563eb; }
    .badge-selesai { background: #dcfce7; color: #16a34a; }
    .badge-batal { background: #fee2e2; color: #dc2626; }
    .status-select {
        height: 38px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 0 10px;
        color: #475569;
    }
    .btn-update {
        height: 38px;
        border: none;
        border-radius: 12px;
        padding: 0 12px;
        background: #2563eb;
        color: white;
        font-weight: 800;
        margin-left: 6px;
        cursor: pointer;
    }
    @media(max-width: 1000px) {
        .stat-grid { grid-template-columns: repeat(2, 1fr); }
        .table-responsive { overflow-x: auto; }
        .queue-table { min-width: 900px; }
    }
</style>

<div class="doctor-dashboard-wrapper">
    <div class="doctor-card-main">
        <form method="GET" action="{{ route('tenaga-medis.dashboard') }}" style="margin: 24px 0; display:flex; gap:12px;">
            <input type="date"
                name="tanggal"
                value="{{ $tanggal }}"
                style="height:44px;border:1px solid #e2e8f0;border-radius:14px;padding:0 14px;">

            <button type="submit"
                    style="height:44px;border:none;border-radius:14px;background:#0ea5e9;color:white;font-weight:800;padding:0 18px;">
                Filter
            </button>
        </form>
        <h1 class="doctor-title">Antrean Pasien Hari Ini</h1>
        <p class="doctor-subtitle">
            Kelola daftar pasien yang sudah membayar dan siap diperiksa.
        </p>

        @if(session('success'))
            <div style="background:#dcfce7;color:#15803d;padding:14px 16px;border-radius:16px;margin-top:18px;font-weight:800;">
                {{ session('success') }}
            </div>
        @endif

        <div class="stat-grid">
            <div class="stat-card">
                <div class="stat-label">Total Pasien</div>
                <div class="stat-value">{{ $bookings->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Menunggu</div>
                <div class="stat-value">{{ $bookings->where('status', 'menunggu')->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Diproses</div>
                <div class="stat-value">{{ $bookings->where('status', 'diproses')->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Selesai</div>
                <div class="stat-value">{{ $bookings->where('status', 'selesai')->count() }}</div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="queue-table">
                <thead>
                    <tr>
                        <th>Antrian</th>
                        <th>Pasien</th>
                        <th>Jam</th>
                        <th>Keluhan</th>
                        <th>Rekam Medis</th>
                        <th>Status</th>
                        <th>Ubah Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        @php
                            $statusClass = 'badge-' . $booking->status;
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
                                <strong>{{ \Carbon\Carbon::parse($booking->jam_konsultasi)->format('H:i') }} WIB</strong>
                                <div class="small-muted">{{ \Carbon\Carbon::parse($booking->tanggal_konsultasi)->format('d/m/Y') }}</div>
                            </td>
                            <td>{{ $booking->keluhan }}</td>
                            <td>
                                @if($booking->rekamMedis)
                                    <span style="background:#dcfce7;color:#16a34a;padding:7px 12px;border-radius:999px;font-size:12px;font-weight:900;">
                                        Sudah Dibuat
                                    </span>
                                @else
                                    <a href="{{ route('tenaga-medis.rekam-medis.create', $booking->id) }}"
                                    style="background:#2563eb;color:white;padding:9px 13px;border-radius:12px;font-size:12px;font-weight:900;text-decoration:none;">
                                        Isi Rekam Medis
                                    </a>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $statusClass }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('tenaga-medis.booking.update-status', $booking->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="status-select">
                                        <option value="menunggu" {{ $booking->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                        <option value="diproses" {{ $booking->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="selesai" {{ $booking->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                    <button type="submit" class="btn-update">Update</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;color:#94a3b8;padding:30px;">
                                Belum ada antrean pasien hari ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection