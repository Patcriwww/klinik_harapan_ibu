@extends('backoffice.layouts.app')

@section('breadcrumb', 'Pembayaran')
@section('title', 'Pembayaran Saya')

@section('content')
<style>
    .payment-wrapper {
        padding: 26px;
    }

    .payment-card {
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
        margin-bottom: 28px;
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

    .payment-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
    }

    .payment-item {
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: 22px;
        background: #ffffff;
        box-shadow: 0 6px 16px rgba(15, 23, 42, .08);
        position: relative;
        overflow: hidden;
    }

    .payment-item::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        width: 6px;
        height: 100%;
        background: #0ea5e9;
    }

    .invoice-no {
        font-size: 13px;
        color: #64748b;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .nominal {
        font-size: 30px;
        font-weight: 900;
        color: #2563eb;
        margin-bottom: 16px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px dashed #e2e8f0;
        font-size: 14px;
    }

    .info-row span:first-child {
        color: #94a3b8;
        font-weight: 700;
    }

    .info-row span:last-child {
        color: #1e293b;
        font-weight: 900;
        text-align: right;
    }

    .status-badge {
        display: inline-block;
        padding: 7px 13px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
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

    .btn-detail {
        margin-top: 18px;
        display: block;
        text-align: center;
        padding: 12px 16px;
        background: #2563eb;
        color: #ffffff;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 900;
        text-decoration: none;
    }

    .empty-payment {
        border: 1px dashed #cbd5e1;
        border-radius: 22px;
        padding: 44px;
        text-align: center;
        color: #94a3b8;
        grid-column: 1 / -1;
    }

    @media(max-width: 900px) {
        .payment-grid {
            grid-template-columns: 1fr;
        }

        .payment-header {
            flex-direction: column;
        }
    }
</style>

<div class="payment-wrapper">
    <div class="payment-card">

        <div class="payment-header">
            <div>
                <h1 class="payment-title">Pembayaran Saya</h1>
                <p class="payment-subtitle">
                    Daftar invoice pembayaran konsultasi Anda.
                </p>
            </div>
        </div>

        @if(session('success'))
            <div style="background:#dcfce7;color:#15803d;padding:14px 16px;border-radius:16px;margin-bottom:18px;font-weight:800;">
                {{ session('success') }}
            </div>
        @endif

        <div class="payment-grid">
            @forelse($pembayarans as $pembayaran)
                @php
                    $payStatus = $pembayaran->status ?? 'pending';
                    $payClass = 'pay-' . $payStatus;
                @endphp

                <div class="payment-item">
                    <div class="invoice-no">{{ $pembayaran->invoice_no }}</div>

                    <div class="nominal">
                        Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}
                    </div>

                    <div class="info-row">
                        <span>Dokter</span>
                        <span>{{ $pembayaran->booking->tenagaMedis->nama ?? '-' }}</span>
                    </div>

                    <div class="info-row">
                        <span>Tanggal</span>
                        <span>
                            {{ \Carbon\Carbon::parse($pembayaran->booking->tanggal_konsultasi)->format('d/m/Y') }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span>Jam</span>
                        <span>
                            {{ \Carbon\Carbon::parse($pembayaran->booking->jam_konsultasi)->format('H:i') }} WIB
                        </span>
                    </div>

                    <div class="info-row">
                        <span>Metode</span>
                        <span>{{ $pembayaran->metode }}</span>
                    </div>

                    <div class="info-row">
                        <span>Status</span>
                        <span>
                            <span class="status-badge {{ $payClass }}">
                                {{ ucwords(str_replace('_', ' ', $payStatus)) }}
                            </span>
                        </span>
                    </div>

                    <a href="{{ route('pasien.pembayaran.show', $pembayaran->id) }}" class="btn-detail">
                        Detail Pembayaran
                    </a>
                </div>
            @empty
                <div class="empty-payment">
                    Belum ada invoice pembayaran.
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection