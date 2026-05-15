@extends('backoffice.layouts.app')

@section('breadcrumb', 'Riwayat Booking')
@section('title', 'Riwayat Booking')

@section('content')
<style>
    .history-wrapper {
        padding: 26px;
    }

    .history-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 8px 22px rgba(15, 23, 42, .08);
    }

    .history-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
        margin-bottom: 28px;
    }

    .history-title {
        font-size: 26px;
        font-weight: 900;
        color: #1e293b;
        margin: 0;
    }

    .history-subtitle {
        color: #94a3b8;
        margin-top: 8px;
        font-size: 15px;
    }

    .btn-booking-new {
        background: #0ea5e9;
        color: white;
        padding: 12px 22px;
        border-radius: 14px;
        font-weight: 800;
        font-size: 14px;
        text-decoration: none;
        box-shadow: 0 8px 18px rgba(14, 165, 233, .22);
    }

    .booking-history-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
    }

    .booking-history-item {
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: 22px;
        background: #ffffff;
        box-shadow: 0 6px 16px rgba(15, 23, 42, .08);
        position: relative;
        overflow: hidden;
    }

    .booking-history-item::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        width: 6px;
        height: 100%;
        background: #0ea5e9;
    }

    .booking-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 20px;
    }

    .queue-label {
        font-size: 12px;
        color: #94a3b8;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .queue-number {
        font-size: 36px;
        line-height: 1;
        font-weight: 900;
        color: #2563eb;
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

    .history-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 18px;
    }

    .info-box {
        background: #f8fafc;
        border-radius: 16px;
        padding: 14px;
    }

    .info-label {
        font-size: 12px;
        color: #94a3b8;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .info-value {
        font-size: 14px;
        color: #334155;
        font-weight: 900;
        line-height: 1.4;
    }

    .keluhan-box {
        background: #f8fafc;
        border-radius: 16px;
        padding: 14px;
        margin-bottom: 18px;
    }

    .booking-code {
        border-top: 1px dashed #cbd5e1;
        padding-top: 15px;
        display: flex;
        justify-content: space-between;
        gap: 12px;
        align-items: center;
    }

    .code-text {
        font-size: 14px;
        font-weight: 900;
        color: #1e293b;
        word-break: break-all;
    }

    .empty-history {
        border: 1px dashed #cbd5e1;
        border-radius: 22px;
        padding: 44px;
        text-align: center;
        color: #94a3b8;
        grid-column: 1 / -1;
    }

    @media (max-width: 1000px) {
        .booking-history-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .history-header {
            flex-direction: column;
        }

        .history-info {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="history-wrapper">
    <div class="history-card">

        <div class="history-header">
            <div>
                <h1 class="history-title">Riwayat Booking Konsultasi</h1>
                <p class="history-subtitle">
                    Daftar booking konsultasi dan nomor antrian digital Anda.
                </p>
            </div>

            <a href="{{ route('pasien.jadwal-konsultasi.index') }}" class="btn-booking-new">
                + Booking Baru
            </a>
        </div>

        <div class="booking-history-grid">
            @forelse($bookings as $booking)
                @php
                    $statusClass = match($booking->status) {
                        'diproses' => 'status-diproses',
                        'selesai' => 'status-selesai',
                        'batal' => 'status-batal',
                        default => 'status-menunggu',
                    };
                @endphp

                <div class="booking-history-item">
                    <div class="booking-top">
                        <div>
                            <div class="queue-label">Nomor Antrian</div>
                            <div class="queue-number">{{ $booking->nomor_antrian }}</div>
                        </div>

                        <span class="status-badge {{ $statusClass }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>

                    <div class="history-info">
                        <div class="info-box">
                            <div class="info-label">Dokter</div>
                            <div class="info-value">
                                {{ $booking->tenagaMedis->nama ?? '-' }}
                            </div>
                        </div>

                        <div class="info-box">
                            <div class="info-label">Jadwal</div>
                            <div class="info-value">
                                {{ \Carbon\Carbon::parse($booking->tanggal_konsultasi)->format('d/m/Y') }}
                                <br>
                                {{ \Carbon\Carbon::parse($booking->jam_konsultasi)->format('H:i') }} WIB
                            </div>
                        </div>
                    </div>

                    <div class="keluhan-box">
                        <div class="info-label">Keluhan</div>
                        <div class="info-value">
                            {{ $booking->keluhan }}
                        </div>
                    </div>

                    <div class="booking-code">
                        <div>
                            <div class="info-label">Kode Booking</div>
                            <div class="code-text">{{ $booking->kode_booking }}</div>
                        </div>

                        <div style="font-size:30px;color:#2563eb;">
                            🩺
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-history">
                    Belum ada riwayat booking konsultasi.
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection