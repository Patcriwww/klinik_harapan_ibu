@extends('backoffice.layouts.app')

@section('breadcrumb', 'Rekam Medis')
@section('title', 'Manajemen Rekam Medis')

@section('content')
<style>
    .rm-page {
        padding: 26px;
    }

    .rm-main-card {
        background: #ffffff;
        border-radius: 26px;
        padding: 30px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, .08);
    }

    .rm-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
        margin-bottom: 24px;
    }

    .rm-title {
        font-size: 30px;
        font-weight: 900;
        color: #1e293b;
        margin: 0;
    }

    .rm-subtitle {
        color: #94a3b8;
        margin-top: 8px;
        font-size: 15px;
    }

    .rm-stat-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 24px;
    }

    .rm-stat-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: 20px;
    }

    .rm-stat-label {
        font-size: 13px;
        color: #64748b;
        font-weight: 900;
        text-transform: uppercase;
    }

    .rm-stat-value {
        margin-top: 12px;
        font-size: 28px;
        color: #2563eb;
        font-weight: 900;
    }

    .rm-filter {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        background: #f8fafc;
        border-radius: 20px;
        padding: 18px;
        margin-bottom: 26px;
    }

    .rm-filter input,
    .rm-filter select {
        height: 46px;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        padding: 0 14px;
        color: #475569;
        outline: none;
        font-weight: 700;
    }

    .rm-filter input[type="text"] {
        min-width: 260px;
        flex: 1;
    }

    .btn-filter,
    .btn-reset {
        height: 46px;
        border: none;
        border-radius: 15px;
        padding: 0 18px;
        font-weight: 900;
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

    .rm-list {
        display: grid;
        grid-template-columns: 1fr;
        gap: 18px;
    }

    .rm-item {
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        background: #ffffff;
        padding: 20px;
        box-shadow: 0 8px 20px rgba(15, 23, 42, .06);
        display: grid;
        grid-template-columns: 170px 1fr 230px;
        gap: 20px;
        align-items: center;
    }

    .rm-date-box {
        background: linear-gradient(135deg, #0ea5e9, #2563eb);
        color: white;
        border-radius: 20px;
        padding: 18px;
        text-align: center;
    }

    .rm-date-day {
        font-size: 30px;
        font-weight: 900;
    }

    .rm-date-month {
        font-size: 13px;
        font-weight: 800;
        opacity: .9;
        margin-top: 4px;
    }

    .rm-patient-name {
        font-size: 18px;
        color: #1e293b;
        font-weight: 900;
        margin-bottom: 4px;
    }

    .rm-patient-email {
        color: #94a3b8;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .rm-info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .rm-info {
        background: #f8fafc;
        border-radius: 16px;
        padding: 12px 14px;
    }

    .rm-info-label {
        font-size: 11px;
        color: #94a3b8;
        font-weight: 900;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .rm-info-value {
        font-size: 13px;
        color: #334155;
        font-weight: 800;
        line-height: 1.5;
        max-height: 42px;
        overflow: hidden;
    }

    .rm-action-box {
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: stretch;
    }

    .badge {
        text-align: center;
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
    }

    .badge-done {
        background: #dcfce7;
        color: #16a34a;
    }

    .badge-waiting {
        background: #fef3c7;
        color: #d97706;
    }

    .btn-detail,
    .btn-edit,
    .btn-create {
        text-align: center;
        border-radius: 14px;
        padding: 11px 14px;
        font-size: 13px;
        font-weight: 900;
        text-decoration: none;
        color: white;
    }

    .btn-detail {
        background: #0ea5e9;
    }

    .btn-edit {
        background: #f97316;
    }

    .btn-create {
        background: #22c55e;
    }

    .empty-box {
        text-align: center;
        padding: 40px;
        border: 1px dashed #cbd5e1;
        border-radius: 22px;
        color: #94a3b8;
        background: #f8fafc;
        font-weight: 800;
    }

    .alert-success {
        background: #dcfce7;
        color: #15803d;
        padding: 14px 16px;
        border-radius: 16px;
        margin-bottom: 18px;
        font-weight: 800;
    }

    @media(max-width: 1200px) {
        .rm-stat-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .rm-item {
            grid-template-columns: 1fr;
        }

        .rm-date-box {
            text-align: left;
        }
    }

    @media(max-width: 700px) {
        .rm-stat-grid,
        .rm-info-grid {
            grid-template-columns: 1fr;
        }

        .rm-header {
            flex-direction: column;
        }
    }
</style>

<div class="rm-page">
    <div class="rm-main-card">

        <div class="rm-header">
            <div>
                <h1 class="rm-title">Manajemen Rekam Medis</h1>
                <p class="rm-subtitle">
                    Kelola daftar pasien, hasil pemeriksaan, diagnosa, tindakan, resep obat, dan catatan dokter.
                </p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="rm-stat-grid">
            <div class="rm-stat-card">
                <div class="rm-stat-label">Total Data</div>
                <div class="rm-stat-value">{{ $bookings->count() }}</div>
            </div>

            <div class="rm-stat-card">
                <div class="rm-stat-label">Sudah Rekam Medis</div>
                <div class="rm-stat-value">{{ $bookings->filter(fn($item) => $item->rekamMedis)->count() }}</div>
            </div>

            <div class="rm-stat-card">
                <div class="rm-stat-label">Belum Rekam Medis</div>
                <div class="rm-stat-value">{{ $bookings->filter(fn($item) => !$item->rekamMedis)->count() }}</div>
            </div>

            <div class="rm-stat-card">
                <div class="rm-stat-label">Pasien Selesai</div>
                <div class="rm-stat-value">{{ $bookings->where('status', 'selesai')->count() }}</div>
            </div>
        </div>

        <form method="GET" action="{{ route('tenaga-medis.rekam-medis.index') }}" class="rm-filter">
            <input type="date" name="tanggal" value="{{ request('tanggal') }}">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari nama pasien atau email...">

            <select name="status">
                <option value="">Semua Status</option>
                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Batal</option>
            </select>

            <button type="submit" class="btn-filter">Filter</button>

            <a href="{{ route('tenaga-medis.rekam-medis.index') }}" class="btn-reset">
                Reset
            </a>
        </form>

        <div class="rm-list">
            @forelse($bookings as $booking)
                @php
                    $tanggal = \Carbon\Carbon::parse($booking->tanggal_konsultasi);
                @endphp

                <div class="rm-item">
                    <div class="rm-date-box">
                        <div class="rm-date-day">{{ $tanggal->format('d') }}</div>
                        <div class="rm-date-month">{{ $tanggal->translatedFormat('F Y') }}</div>
                        <div style="font-size:13px;font-weight:800;margin-top:10px;">
                            {{ $booking->nomor_antrian }}
                        </div>
                    </div>

                    <div>
                        <div class="rm-patient-name">
                            {{ $booking->pasien->name ?? '-' }}
                        </div>

                        <div class="rm-patient-email">
                            {{ $booking->pasien->email ?? '-' }}
                        </div>

                        <div class="rm-info-grid">
                            <div class="rm-info">
                                <div class="rm-info-label">Keluhan</div>
                                <div class="rm-info-value">{{ $booking->keluhan ?? '-' }}</div>
                            </div>

                            <div class="rm-info">
                                <div class="rm-info-label">Jadwal</div>
                                <div class="rm-info-value">
                                    {{ \Carbon\Carbon::parse($booking->jam_konsultasi)->format('H:i') }} WIB
                                </div>
                            </div>

                            <div class="rm-info">
                                <div class="rm-info-label">Diagnosa</div>
                                <div class="rm-info-value">
                                    {{ $booking->rekamMedis->diagnosa ?? 'Belum diisi' }}
                                </div>
                            </div>

                            <div class="rm-info">
                                <div class="rm-info-label">Tindakan</div>
                                <div class="rm-info-value">
                                    {{ $booking->rekamMedis->tindakan ?? 'Belum diisi' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rm-action-box">
                        @if($booking->rekamMedis)
                            <div class="badge badge-done">Sudah Dibuat</div>

                            <a href="{{ route('tenaga-medis.rekam-medis.show', $booking->rekamMedis->id) }}"
                               class="btn-detail">
                                Detail Rekam Medis
                            </a>

                            <a href="{{ route('tenaga-medis.rekam-medis.edit', $booking->rekamMedis->id) }}"
                               class="btn-edit">
                                Edit Rekam Medis
                            </a>
                        @else
                            <div class="badge badge-waiting">Belum Dibuat</div>

                            <a href="{{ route('tenaga-medis.rekam-medis.create', $booking->id) }}"
                               class="btn-create">
                                Isi Rekam Medis
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-box">
                    Belum ada data booking pasien.
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection