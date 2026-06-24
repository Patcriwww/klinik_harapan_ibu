@extends('backoffice.layouts.app')

@section('breadcrumb', 'Dashboard')
@section('title', 'Dashboard Pasien')

@section('content')
<style>
    .patient-dashboard {
        padding: 26px;
    }

    .patient-header {
        margin-bottom: 26px;
    }

    .patient-title {
        font-size: 30px;
        font-weight: 900;
        color: #1e293b;
        margin: 0;
    }

    .patient-subtitle {
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
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
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
        grid-template-columns: 1.2fr .8fr;
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

    .booking-box {
        background: #f8fafc;
        border-radius: 20px;
        padding: 22px;
        border: 1px solid #e2e8f0;
    }

    .queue-number {
        font-size: 42px;
        font-weight: 900;
        color: #2563eb;
        margin-bottom: 6px;
    }

    .booking-code {
        color: #64748b;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 18px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        gap: 14px;
        padding: 12px 0;
        border-bottom: 1px dashed #e2e8f0;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: #94a3b8;
        font-weight: 800;
        font-size: 13px;
    }

    .info-value {
        color: #1e293b;
        font-weight: 900;
        font-size: 14px;
        text-align: right;
    }

    .badge {
        display: inline-block;
        padding: 7px 13px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
    }

    .badge-menunggu {
        background: #fef3c7;
        color: #d97706;
    }

    .badge-diproses {
        background: #dbeafe;
        color: #2563eb;
    }

    .badge-selesai {
        background: #dcfce7;
        color: #16a34a;
    }

    .badge-batal {
        background: #fee2e2;
        color: #dc2626;
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

    .quick-menu {
        display: grid;
        gap: 14px;
    }

    .quick-link {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px;
        border-radius: 18px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        text-decoration: none;
        color: #1e293b;
        font-weight: 900;
        transition: .2s;
    }

    .quick-link:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
        color: #2563eb;
    }

    .quick-icon {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
    }

    .empty-box {
        text-align: center;
        color: #94a3b8;
        font-weight: 700;
        padding: 34px;
        border: 1px dashed #cbd5e1;
        border-radius: 18px;
        background: #f8fafc;
    }

    .payment-alert {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 20px;
        padding: 20px;
    }

    .payment-title {
        color: #1e293b;
        font-weight: 900;
        font-size: 17px;
        margin-bottom: 12px;
    }

    .payment-nominal {
        font-size: 30px;
        color: #2563eb;
        font-weight: 900;
        margin-bottom: 12px;
    }

    .btn-action {
        display: inline-block;
        margin-top: 16px;
        padding: 12px 18px;
        border-radius: 14px;
        background: #2563eb;
        color: white;
        text-decoration: none;
        font-weight: 900;
        font-size: 14px;
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
        .kpi-grid {
            grid-template-columns: 1fr;
        }

        .info-row {
            flex-direction: column;
        }

        .info-value {
            text-align: left;
        }
    }
</style>

<div class="patient-dashboard">

    <div class="patient-header">
        <h1 class="patient-title">Dashboard Pasien</h1>
        <p class="patient-subtitle">
            Selamat datang, {{ auth()->user()->name }}. Pantau booking, pembayaran, dan rekam medis Anda di sini.
        </p>
    </div>

    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-top">
                <div class="kpi-label">Total Booking</div>
                <div class="kpi-icon" style="background:#0ea5e9;">📅</div>
            </div>
            <div class="kpi-value">{{ $totalBooking ?? 0 }}</div>
            <div class="kpi-note">Seluruh booking konsultasi Anda</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-top">
                <div class="kpi-label">Booking Aktif</div>
                <div class="kpi-icon" style="background:#22c55e;">⏳</div>
            </div>
            <div class="kpi-value">{{ $bookingAktif ?? 0 }}</div>
            <div class="kpi-note">Menunggu atau sedang diproses</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-top">
                <div class="kpi-label">Pembayaran</div>
                <div class="kpi-icon" style="background:#f97316;">💳</div>
            </div>
            <div class="kpi-value">{{ $totalPembayaran ?? 0 }}</div>
            <div class="kpi-note">Invoice pembayaran konsultasi</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-top">
                <div class="kpi-label">Rekam Medis</div>
                <div class="kpi-icon" style="background:#6366f1;">🩺</div>
            </div>
            <div class="kpi-value">{{ $totalRekamMedis ?? 0 }}</div>
            <div class="kpi-note">Riwayat pemeriksaan tersedia</div>
        </div>
    </div>

    <div class="dashboard-grid">

        <div class="panel-card">
            <div class="panel-title">Booking Terakhir</div>

            @if($bookingTerakhir)
                @php
                    $bookingStatus = $bookingTerakhir->status ?? 'menunggu';
                    $bookingClass = 'badge-' . $bookingStatus;

                    $payStatus = $bookingTerakhir->pembayaran->status ?? 'pending';
                    $payClass = 'pay-' . $payStatus;
                @endphp

                <div class="booking-box">
                    <div class="queue-number">{{ $bookingTerakhir->nomor_antrian }}</div>
                    <div class="booking-code">{{ $bookingTerakhir->kode_booking }}</div>

                    <div class="info-row">
                        <span class="info-label">Dokter</span>
                        <span class="info-value">
                            {{ $bookingTerakhir->tenagaMedis->nama ?? '-' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Spesialis</span>
                        <span class="info-value">
                            {{ $bookingTerakhir->tenagaMedis->spesialis ?? '-' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Jadwal</span>
                        <span class="info-value">
                            {{ $bookingTerakhir->tanggal_konsultasi ? \Carbon\Carbon::parse($bookingTerakhir->tanggal_konsultasi)->format('d/m/Y') : '-' }}
                            <br>
                            {{ $bookingTerakhir->jam_konsultasi ? \Carbon\Carbon::parse($bookingTerakhir->jam_konsultasi)->format('H:i') . ' WIB' : '-' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Status Booking</span>
                        <span class="info-value">
                            <span class="badge {{ $bookingClass }}">
                                {{ ucfirst($bookingStatus) }}
                            </span>
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Status Pembayaran</span>
                        <span class="info-value">
                            <span class="badge {{ $payClass }}">
                                {{ ucwords(str_replace('_', ' ', $payStatus)) }}
                            </span>
                        </span>
                    </div>

                    <a href="{{ route('pasien.jadwal-konsultasi.riwayat') }}" class="btn-action">
                        Lihat Riwayat Booking
                    </a>
                </div>
            @else
                <div class="empty-box">
                    Belum ada booking konsultasi.
                    <br>
                    <a href="{{ route('pasien.jadwal-konsultasi.index') }}" class="btn-action">
                        Booking Sekarang
                    </a>
                </div>
            @endif
        </div>

        <div class="panel-card">
            <div class="panel-title">Pembayaran Terakhir</div>

            @if($pembayaranTerakhir)
                @php
                    $payStatus = $pembayaranTerakhir->status ?? 'pending';
                    $payClass = 'pay-' . $payStatus;
                @endphp

                <div class="payment-alert">
                    <div class="payment-title">
                        {{ $pembayaranTerakhir->invoice_no }}
                    </div>

                    <div class="payment-nominal">
                        Rp {{ number_format($pembayaranTerakhir->nominal ?? 0, 0, ',', '.') }}
                    </div>

                    <div class="info-row">
                        <span class="info-label">Dokter</span>
                        <span class="info-value">
                            {{ $pembayaranTerakhir->booking->tenagaMedis->nama ?? '-' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Metode</span>
                        <span class="info-value">
                            {{ $pembayaranTerakhir->metode ?? '-' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Status</span>
                        <span class="info-value">
                            <span class="badge {{ $payClass }}">
                                {{ ucwords(str_replace('_', ' ', $payStatus)) }}
                            </span>
                        </span>
                    </div>

                    <a href="{{ route('pasien.pembayaran.index') }}" class="btn-action">
                        Lihat Pembayaran
                    </a>
                </div>
            @else
                <div class="empty-box">
                    Belum ada data pembayaran.
                </div>
            @endif
        </div>

    </div>

    <div class="panel-card" style="margin-top:24px;">
        <div class="panel-title">Menu Cepat</div>

        <div class="quick-menu">
            <a href="{{ route('pasien.jadwal-konsultasi.index') }}" class="quick-link">
                <span class="quick-icon" style="background:#0ea5e9;">📅</span>
                <span>Booking Jadwal Konsultasi</span>
            </a>

            <a href="{{ route('pasien.jadwal-konsultasi.riwayat') }}" class="quick-link">
                <span class="quick-icon" style="background:#22c55e;">📋</span>
                <span>Riwayat Booking</span>
            </a>

            <a href="{{ route('pasien.pembayaran.index') }}" class="quick-link">
                <span class="quick-icon" style="background:#f97316;">💳</span>
                <span>Pembayaran Saya</span>
            </a>

            <a href="{{ route('pasien.rekam-medis.index') }}" class="quick-link">
                <span class="quick-icon" style="background:#6366f1;">🩺</span>
                <span>Rekam Medis Saya</span>
            </a>
        </div>
    </div>

</div>
@endsection