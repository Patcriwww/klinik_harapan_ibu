@extends('backoffice.layouts.app')

@section('breadcrumb', 'Detail Pembayaran')
@section('title', 'Detail Pembayaran')

@section('content')
<style>
    .payment-detail-wrapper {
        padding: 26px;
    }

    .payment-detail-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 380px;
        gap: 24px;
    }

    .detail-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 8px 22px rgba(15, 23, 42, .08);
    }

    .detail-title {
        font-size: 26px;
        font-weight: 900;
        color: #1e293b;
        margin: 0;
    }

    .detail-subtitle {
        color: #94a3b8;
        margin-top: 8px;
        font-size: 15px;
    }

    .invoice-box {
        background: #eff6ff;
        border-radius: 20px;
        padding: 24px;
        margin-top: 24px;
        margin-bottom: 24px;
    }

    .invoice-label {
        color: #64748b;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .invoice-number {
        font-size: 22px;
        color: #1e293b;
        font-weight: 900;
        word-break: break-all;
    }

    .invoice-nominal {
        font-size: 38px;
        color: #2563eb;
        font-weight: 900;
        margin-top: 18px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .info-box {
        background: #f8fafc;
        border-radius: 16px;
        padding: 16px;
    }

    .info-label {
        color: #94a3b8;
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .info-value {
        color: #1e293b;
        font-size: 14px;
        font-weight: 900;
        line-height: 1.4;
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

    .upload-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 24px;
        box-shadow: 0 8px 22px rgba(15, 23, 42, .08);
    }

    .upload-title {
        font-size: 20px;
        color: #1e293b;
        font-weight: 900;
        margin-bottom: 8px;
    }

    .upload-note {
        color: #94a3b8;
        font-size: 14px;
        margin-bottom: 18px;
    }

    .file-input {
        width: 100%;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 12px;
        margin-bottom: 16px;
    }

    .btn-upload {
        width: 100%;
        border: none;
        border-radius: 14px;
        padding: 13px 16px;
        background: #2563eb;
        color: #ffffff;
        font-weight: 900;
        cursor: pointer;
    }

    .btn-back {
        margin-top: 14px;
        display: block;
        text-align: center;
        padding: 12px 16px;
        background: #e2e8f0;
        color: #475569;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 900;
        text-decoration: none;
    }

    .proof-img {
        width: 100%;
        max-height: 320px;
        object-fit: cover;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        margin-top: 14px;
    }

    .bank-box {
        background: #f8fafc;
        border-radius: 18px;
        padding: 18px;
        margin-bottom: 18px;
    }

    .bank-row {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .bank-row:last-child {
        margin-bottom: 0;
    }

    .bank-row span:first-child {
        color: #94a3b8;
        font-weight: 700;
    }

    .bank-row span:last-child {
        color: #1e293b;
        font-weight: 900;
        text-align: right;
    }

    @media(max-width: 1000px) {
        .payment-detail-layout {
            grid-template-columns: 1fr;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="payment-detail-wrapper">
    <div class="payment-detail-layout">

        <div class="detail-card">
            <h1 class="detail-title">Detail Pembayaran</h1>
            <p class="detail-subtitle">
                Silakan lakukan pembayaran sesuai nominal invoice berikut.
            </p>

            @php
                $payStatus = $pembayaran->status ?? 'pending';
                $payClass = 'pay-' . $payStatus;
            @endphp

            <div class="invoice-box">
                <div class="invoice-label">Nomor Invoice</div>
                <div class="invoice-number">{{ $pembayaran->invoice_no }}</div>

                <div class="invoice-nominal">
                    Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}
                </div>
            </div>

            <div class="info-grid">
                <div class="info-box">
                    <div class="info-label">Dokter</div>
                    <div class="info-value">
                        {{ $pembayaran->booking->tenagaMedis->nama ?? '-' }}
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-label">Spesialis</div>
                    <div class="info-value">
                        {{ $pembayaran->booking->tenagaMedis->spesialis ?? '-' }}
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-label">Tanggal Konsultasi</div>
                    <div class="info-value">
                        {{ \Carbon\Carbon::parse($pembayaran->booking->tanggal_konsultasi)->format('d/m/Y') }}
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-label">Jam Konsultasi</div>
                    <div class="info-value">
                        {{ \Carbon\Carbon::parse($pembayaran->booking->jam_konsultasi)->format('H:i') }} WIB
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-label">Metode Pembayaran</div>
                    <div class="info-value">
                        {{ $pembayaran->metode }}
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-label">Status Pembayaran</div>
                    <div class="info-value">
                        <span class="status-badge {{ $payClass }}">
                            {{ ucwords(str_replace('_', ' ', $payStatus)) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="upload-card">
            <h2 class="upload-title">Upload Bukti Pembayaran</h2>
            <p class="upload-note">
                Transfer sesuai nominal invoice, lalu upload bukti pembayaran.
            </p>

            <div class="bank-box">
                <div class="bank-row">
                    <span>Bank</span>
                    <span>BCA</span>
                </div>
                <div class="bank-row">
                    <span>No. Rekening</span>
                    <span>1234567890</span>
                </div>
                <div class="bank-row">
                    <span>Atas Nama</span>
                    <span>Klinik Harapan Ibu</span>
                </div>
            </div>

            @if(session('success'))
                <div style="background:#dcfce7;color:#15803d;padding:12px 14px;border-radius:14px;margin-bottom:16px;font-weight:800;font-size:14px;">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div style="background:#fee2e2;color:#dc2626;padding:12px 14px;border-radius:14px;margin-bottom:16px;font-weight:800;font-size:14px;">
                    {{ $errors->first() }}
                </div>
            @endif

            @if(in_array($pembayaran->status, ['pending', 'ditolak']))
                <form action="{{ route('pasien.pembayaran.upload', $pembayaran->id) }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <input type="file"
                           name="bukti_bayar"
                           accept="image/*"
                           class="file-input"
                           required>

                    <button type="submit" class="btn-upload">
                        Upload Bukti Bayar
                    </button>
                </form>
            @else
                <div style="background:#f8fafc;color:#64748b;padding:14px;border-radius:14px;font-size:14px;font-weight:800;">
                    Bukti pembayaran sudah dikirim dan sedang diproses.
                </div>
            @endif

            @if($pembayaran->bukti_bayar)
                <img src="{{ asset('storage/' . $pembayaran->bukti_bayar) }}"
                     class="proof-img"
                     alt="Bukti Pembayaran">
            @endif

            <a href="{{ route('pasien.pembayaran.index') }}" class="btn-back">
                Kembali
            </a>
        </div>

    </div>
</div>
@endsection