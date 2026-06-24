@extends('backoffice.layouts.app')

@section('breadcrumb', 'Rekam Medis')
@section('title', 'Rekam Medis Saya')

@section('content')
<style>
    .rm-page {
        padding: 26px;
    }

    .rm-card {
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
        margin-bottom: 26px;
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

    .rm-badge {
        background: #dcfce7;
        color: #16a34a;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
    }

    .rm-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
    }

    .rm-item {
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 22px;
        box-shadow: 0 8px 20px rgba(15, 23, 42, .06);
        position: relative;
        overflow: hidden;
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    }

    .rm-item::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        width: 7px;
        height: 100%;
        background: #0ea5e9;
    }

    .rm-top {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 20px;
    }

    .rm-date-label {
        font-size: 12px;
        color: #94a3b8;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .rm-date {
        font-size: 24px;
        font-weight: 900;
        color: #2563eb;
    }

    .doctor-box {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #eff6ff;
        border-radius: 18px;
        padding: 14px;
        margin-bottom: 18px;
    }

    .doctor-avatar {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        background: #2563eb;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        font-size: 18px;
    }

    .doctor-name {
        color: #1e293b;
        font-size: 15px;
        font-weight: 900;
    }

    .doctor-role {
        color: #64748b;
        font-size: 12px;
        margin-top: 3px;
    }

    .rm-section {
        background: #ffffff;
        border-radius: 16px;
        padding: 15px;
        margin-bottom: 12px;
        border: 1px solid #f1f5f9;
    }

    .rm-section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #64748b;
        font-size: 12px;
        font-weight: 900;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .rm-section-text {
        color: #334155;
        font-size: 14px;
        line-height: 1.6;
        font-weight: 600;
    }

    .rm-empty {
        grid-column: 1 / -1;
        text-align: center;
        border: 1px dashed #cbd5e1;
        border-radius: 22px;
        padding: 45px;
        color: #94a3b8;
        font-weight: 700;
    }

    @media(max-width: 1000px) {
        .rm-grid {
            grid-template-columns: 1fr;
        }

        .rm-header {
            flex-direction: column;
        }
    }
</style>

<div class="rm-page">
    <div class="rm-card">

        <div class="rm-header">
            <div>
                <h1 class="rm-title">Rekam Medis Saya</h1>
                <p class="rm-subtitle">
                    Riwayat hasil pemeriksaan, diagnosa, tindakan, resep obat, dan catatan dokter.
                </p>
            </div>

            <span class="rm-badge">
                {{ $rekamMedis->count() }} Data Rekam Medis
            </span>
        </div>

        <div class="rm-grid">
            @forelse($rekamMedis as $item)
                <div class="rm-item">
                    <div class="rm-top">
                        <div>
                            <div class="rm-date-label">Tanggal Pemeriksaan</div>
                            <div class="rm-date">
                                {{ \Carbon\Carbon::parse($item->tanggal_pemeriksaan)->format('d/m/Y') }}
                            </div>
                        </div>

                        <span class="rm-badge">Selesai</span>
                    </div>

                    <div class="doctor-box">
                        <div class="doctor-avatar">
                            {{ strtoupper(substr($item->tenagaMedis->nama ?? 'D', 0, 1)) }}
                        </div>
                        <div>
                            <div class="doctor-name">{{ $item->tenagaMedis->nama ?? '-' }}</div>
                            <div class="doctor-role">{{ $item->tenagaMedis->spesialis ?? 'Tenaga Medis' }}</div>
                        </div>
                    </div>

                    <div class="rm-section">
                        <div class="rm-section-title">📝 Keluhan</div>
                        <div class="rm-section-text">{{ $item->keluhan ?? '-' }}</div>
                    </div>

                    <div class="rm-section">
                        <div class="rm-section-title">🩺 Diagnosa</div>
                        <div class="rm-section-text">{{ $item->diagnosa ?? '-' }}</div>
                    </div>

                    <div class="rm-section">
                        <div class="rm-section-title">💉 Tindakan</div>
                        <div class="rm-section-text">{{ $item->tindakan ?? '-' }}</div>
                    </div>

                    <div class="rm-section">
                        <div class="rm-section-title">💊 Resep Obat</div>
                        <div class="rm-section-text">{{ $item->resep_obat ?? '-' }}</div>
                    </div>

                    <div class="rm-section">
                        <div class="rm-section-title">📌 Catatan Dokter</div>
                        <div class="rm-section-text">{{ $item->catatan_dokter ?? '-' }}</div>
                    </div>
                </div>
            @empty
                <div class="rm-empty">
                    Belum ada data rekam medis.
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection