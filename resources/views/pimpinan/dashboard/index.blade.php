@extends('backoffice.layouts.app')

@section('breadcrumb', 'Dashboard Pimpinan')
@section('title', 'Dashboard Pimpinan')

@section('content')
<style>
    .leader-page {
        padding: 26px;
    }

    .leader-header {
        margin-bottom: 24px;
    }

    .leader-title {
        font-size: 30px;
        font-weight: 900;
        color: #1e293b;
        margin: 0;
    }

    .leader-subtitle {
        color: #94a3b8;
        margin-top: 8px;
        font-size: 15px;
    }

    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 24px;
    }

    .kpi-card {
        background: #ffffff;
        border-radius: 22px;
        padding: 22px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
        border: 1px solid #f1f5f9;
    }

    .kpi-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
    }

    .kpi-label {
        font-size: 13px;
        color: #64748b;
        font-weight: 900;
        text-transform: uppercase;
    }

    .kpi-icon {
        width: 46px;
        height: 46px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-weight: 900;
        font-size: 18px;
    }

    .kpi-value {
        font-size: 30px;
        font-weight: 900;
        color: #1e293b;
        margin-top: 16px;
    }

    .kpi-note {
        font-size: 13px;
        color: #94a3b8;
        margin-top: 6px;
        font-weight: 700;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 1.4fr .8fr;
        gap: 22px;
    }

    .panel-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 24px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
        border: 1px solid #f1f5f9;
    }

    .panel-title {
        font-size: 20px;
        font-weight: 900;
        color: #1e293b;
        margin-bottom: 18px;
    }

    .chart-bars {
        display: flex;
        align-items: end;
        gap: 14px;
        height: 260px;
        padding: 20px 8px 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .bar-item {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: end;
        height: 100%;
    }

    .bar {
        width: 100%;
        max-width: 44px;
        background: linear-gradient(180deg, #0ea5e9, #2563eb);
        border-radius: 12px 12px 0 0;
        min-height: 8px;
    }

    .bar-label {
        margin-top: 10px;
        font-size: 12px;
        color: #64748b;
        font-weight: 800;
    }

    .bar-total {
        font-size: 12px;
        color: #1e293b;
        font-weight: 900;
        margin-bottom: 6px;
    }

    .doctor-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .doctor-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        background: #f8fafc;
        border-radius: 18px;
        padding: 16px;
    }

    .doctor-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .doctor-avatar {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        background: #2563eb;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
    }

    .doctor-name {
        font-size: 14px;
        font-weight: 900;
        color: #1e293b;
    }

    .doctor-specialist {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 3px;
        font-weight: 700;
    }

    .doctor-count {
        color: #2563eb;
        font-size: 18px;
        font-weight: 900;
    }

    .status-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-top: 22px;
    }

    .status-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
        border: 1px solid #f1f5f9;
    }

    .status-label {
        font-size: 13px;
        color: #64748b;
        font-weight: 900;
        text-transform: capitalize;
    }

    .status-value {
        margin-top: 10px;
        font-size: 26px;
        color: #2563eb;
        font-weight: 900;
    }

    @media(max-width: 1200px) {
        .kpi-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    @media(max-width: 700px) {
        .kpi-grid,
        .status-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="leader-page">

    <div class="leader-header">
        <h1 class="leader-title">Dashboard Pimpinan</h1>
        <p class="leader-subtitle">
            Monitoring performa layanan klinik, booking, pembayaran, dan tenaga medis.
        </p>
    </div>

    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-top">
                <div class="kpi-label">Total Pasien</div>
                <div class="kpi-icon" style="background:#0ea5e9;">👥</div>
            </div>
            <div class="kpi-value">{{ $totalPasien }}</div>
            <div class="kpi-note">Pasien terdaftar</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-top">
                <div class="kpi-label">Tenaga Medis</div>
                <div class="kpi-icon" style="background:#6366f1;">🩺</div>
            </div>
            <div class="kpi-value">{{ $totalTenagaMedis }}</div>
            <div class="kpi-note">Tenaga medis aktif</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-top">
                <div class="kpi-label">Total Booking</div>
                <div class="kpi-icon" style="background:#22c55e;">📅</div>
            </div>
            <div class="kpi-value">{{ $totalBooking }}</div>
            <div class="kpi-note">{{ $bookingHariIni }} booking hari ini</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-top">
                <div class="kpi-label">Pendapatan</div>
                <div class="kpi-icon" style="background:#f97316;">💳</div>
            </div>
            <div class="kpi-value">
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </div>
            <div class="kpi-note">
                Bulan ini Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}
            </div>
        </div>
    </div>

    <div class="status-grid">
        <div class="status-card">
            <div class="status-label">Booking Hari Ini</div>
            <div class="status-value">{{ $bookingHariIni }}</div>
        </div>

        <div class="status-card">
            <div class="status-label">Menunggu Verifikasi</div>
            <div class="status-value">{{ $pembayaranMenunggu }}</div>
        </div>

        @foreach($statusBooking as $status)
            <div class="status-card">
                <div class="status-label">{{ $status->status }}</div>
                <div class="status-value">{{ $status->total }}</div>
            </div>
        @endforeach
    </div>

    <div class="dashboard-grid" style="margin-top:24px;">
        <div class="panel-card">
            <div class="panel-title">Grafik Booking Tahun Ini</div>

            @php
                $maxBooking = max($bookingPerBulan->max('total') ?? 1, 1);
            @endphp

            <div class="chart-bars">
                @forelse($bookingPerBulan as $item)
                    @php
                        $height = ($item->total / $maxBooking) * 220;
                    @endphp

                    <div class="bar-item">
                        <div class="bar-total">{{ $item->total }}</div>
                        <div class="bar" style="height: {{ $height }}px;"></div>
                        <div class="bar-label">{{ $item->bulan }}</div>
                    </div>
                @empty
                    <div style="width:100%;text-align:center;color:#94a3b8;font-weight:700;">
                        Belum ada data booking tahun ini.
                    </div>
                @endforelse
            </div>
        </div>

        <div class="panel-card">
            <div class="panel-title">Dokter Terfavorit</div>

            <div class="doctor-list">
                @forelse($dokterFavorit as $item)
                    <div class="doctor-item">
                        <div class="doctor-left">
                            <div class="doctor-avatar">
                                {{ strtoupper(substr($item->tenagaMedis->nama ?? 'D', 0, 1)) }}
                            </div>

                            <div>
                                <div class="doctor-name">
                                    {{ $item->tenagaMedis->nama ?? '-' }}
                                </div>
                                <div class="doctor-specialist">
                                    {{ $item->tenagaMedis->spesialis ?? 'Tenaga Medis' }}
                                </div>
                            </div>
                        </div>

                        <div class="doctor-count">
                            {{ $item->total_booking }}
                        </div>
                    </div>
                @empty
                    <div style="text-align:center;color:#94a3b8;font-weight:700;padding:30px;">
                        Belum ada data dokter favorit.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection