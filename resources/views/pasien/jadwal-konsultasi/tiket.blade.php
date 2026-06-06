@extends('backoffice.layouts.app')

@section('breadcrumb', 'Tiket Digital')
@section('title', 'Tiket Digital')

@section('content')
<style>
    .ticket-wrapper {
        padding: 26px;
    }

    .ticket-card {
        max-width: 760px;
        margin: 0 auto;
        background: #ffffff;
        border-radius: 28px;
        padding: 32px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, .12);
    }

    .ticket-header {
        text-align: center;
        margin-bottom: 28px;
    }

    .ticket-title {
        font-size: 28px;
        font-weight: 900;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .ticket-subtitle {
        color: #94a3b8;
        font-size: 15px;
    }

    .queue-box {
        background: linear-gradient(135deg, #0ea5e9, #2563eb);
        color: #ffffff;
        border-radius: 24px;
        padding: 28px;
        text-align: center;
        margin-bottom: 26px;
    }

    .queue-label {
        font-size: 14px;
        font-weight: 700;
        opacity: .9;
    }

    .queue-number {
        font-size: 54px;
        font-weight: 900;
        margin-top: 8px;
    }

    .ticket-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .ticket-info {
        background: #f8fafc;
        border-radius: 18px;
        padding: 16px;
    }

    .ticket-label {
        color: #94a3b8;
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .ticket-value {
        color: #1e293b;
        font-size: 15px;
        font-weight: 900;
        line-height: 1.4;
    }

    .ticket-code {
        background: #eff6ff;
        border: 1px dashed #2563eb;
        border-radius: 20px;
        padding: 20px;
        text-align: center;
        margin-bottom: 24px;
    }

    .ticket-code strong {
        display: block;
        color: #2563eb;
        font-size: 22px;
        margin-top: 6px;
        letter-spacing: 1px;
    }

    .ticket-note {
        background: #fefce8;
        border-radius: 16px;
        padding: 16px;
        color: #854d0e;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 24px;
    }

    .ticket-actions {
        display: flex;
        justify-content: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-ticket {
        padding: 12px 20px;
        border-radius: 14px;
        font-weight: 900;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .btn-primary-ticket {
        background: #2563eb;
        color: white;
    }

    .btn-secondary-ticket {
        background: #e2e8f0;
        color: #475569;
    }

    @media print {
        .clinic-sidebar,
        .navbar,
        .ticket-actions {
            display: none !important;
        }

        .ticket-card {
            box-shadow: none;
            margin: 0;
        }
    }

    @media(max-width: 700px) {
        .ticket-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="ticket-wrapper">
    <div class="ticket-card">

        <div class="ticket-header">
            <h1 class="ticket-title">Tiket Digital Konsultasi</h1>
            <p class="ticket-subtitle">
                Tunjukkan tiket ini kepada petugas klinik saat datang.
            </p>
        </div>

        <div class="queue-box">
            <div class="queue-label">Nomor Antrian</div>
            <div class="queue-number">{{ $booking->nomor_antrian }}</div>
        </div>

        <div class="ticket-grid">
            <div class="ticket-info">
                <div class="ticket-label">Nama Pasien</div>
                <div class="ticket-value">{{ $booking->pasien->name ?? '-' }}</div>
            </div>

            <div class="ticket-info">
                <div class="ticket-label">Dokter</div>
                <div class="ticket-value">{{ $booking->tenagaMedis->nama ?? '-' }}</div>
            </div>

            <div class="ticket-info">
                <div class="ticket-label">Spesialis</div>
                <div class="ticket-value">{{ $booking->tenagaMedis->spesialis ?? '-' }}</div>
            </div>

            <div class="ticket-info">
                <div class="ticket-label">Jadwal Konsultasi</div>
                <div class="ticket-value">
                    {{ \Carbon\Carbon::parse($booking->tanggal_konsultasi)->format('d/m/Y') }}
                    <br>
                    {{ \Carbon\Carbon::parse($booking->jam_konsultasi)->format('H:i') }} WIB
                </div>
            </div>

            <div class="ticket-info">
                <div class="ticket-label">Status Booking</div>
                <div class="ticket-value">{{ ucfirst($booking->status) }}</div>
            </div>

            <div class="ticket-info">
                <div class="ticket-label">Status Pembayaran</div>
                <div class="ticket-value">Dibayar</div>
            </div>
        </div>

        <div class="ticket-code">
            Kode Booking
            <strong>{{ $booking->kode_booking }}</strong>
        </div>

        <div class="ticket-note">
            Harap datang minimal 15 menit sebelum jadwal konsultasi. Jika terlambat, nomor antrian dapat dilewati sesuai kebijakan klinik.
        </div>

        <div class="ticket-actions">
            <a href="{{ route('pasien.jadwal-konsultasi.riwayat') }}" class="btn-ticket btn-secondary-ticket">
                Kembali
            </a>

            <button onclick="window.print()" class="btn-ticket btn-primary-ticket">
                Cetak Tiket
            </button>
        </div>

    </div>
</div>
@endsection