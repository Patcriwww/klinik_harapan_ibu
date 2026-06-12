@extends('backoffice.layouts.app')

@section('breadcrumb', 'Rekam Medis')
@section('title', 'Isi Rekam Medis')

@section('content')
<style>
    .rm-wrapper {
        padding: 26px;
    }

    .rm-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 8px 22px rgba(15, 23, 42, .08);
    }

    .rm-title {
        font-size: 26px;
        font-weight: 900;
        color: #1e293b;
        margin: 0;
    }

    .rm-subtitle {
        color: #94a3b8;
        margin-top: 8px;
        font-size: 15px;
    }

    .patient-box {
        margin-top: 24px;
        margin-bottom: 24px;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 20px;
        padding: 20px;
    }

    .patient-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .info-label {
        font-size: 12px;
        font-weight: 800;
        color: #64748b;
        margin-bottom: 6px;
    }

    .info-value {
        font-size: 15px;
        font-weight: 900;
        color: #1e293b;
        line-height: 1.4;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 18px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 800;
        color: #475569;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 14px 16px;
        font-size: 14px;
        color: #334155;
        outline: none;
        resize: vertical;
        min-height: 110px;
    }

    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
    }

    .btn-row {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 24px;
    }

    .btn-back {
        padding: 12px 20px;
        border-radius: 14px;
        background: #e2e8f0;
        color: #475569;
        font-weight: 900;
        text-decoration: none;
    }

    .btn-save {
        padding: 12px 22px;
        border: none;
        border-radius: 14px;
        background: #2563eb;
        color: white;
        font-weight: 900;
        cursor: pointer;
    }

    .error-box {
        background: #fee2e2;
        color: #dc2626;
        padding: 14px 16px;
        border-radius: 16px;
        margin-top: 18px;
        font-weight: 800;
    }

    @media(max-width: 900px) {
        .patient-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="rm-wrapper">
    <div class="rm-card">

        <h1 class="rm-title">Isi Rekam Medis</h1>
        <p class="rm-subtitle">
            Lengkapi hasil pemeriksaan pasien berdasarkan konsultasi yang dilakukan.
        </p>

        @if($errors->any())
            <div class="error-box">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="patient-box">
            <div class="patient-grid">
                <div>
                    <div class="info-label">Nama Pasien</div>
                    <div class="info-value">{{ $booking->pasien->name ?? '-' }}</div>
                </div>

                <div>
                    <div class="info-label">Nomor Antrian</div>
                    <div class="info-value">{{ $booking->nomor_antrian }}</div>
                </div>

                <div>
                    <div class="info-label">Kode Booking</div>
                    <div class="info-value">{{ $booking->kode_booking }}</div>
                </div>

                <div>
                    <div class="info-label">Dokter</div>
                    <div class="info-value">{{ $booking->tenagaMedis->nama ?? '-' }}</div>
                </div>

                <div>
                    <div class="info-label">Tanggal Konsultasi</div>
                    <div class="info-value">
                        {{ \Carbon\Carbon::parse($booking->tanggal_konsultasi)->format('d/m/Y') }}
                    </div>
                </div>

                <div>
                    <div class="info-label">Jam Konsultasi</div>
                    <div class="info-value">
                        {{ \Carbon\Carbon::parse($booking->jam_konsultasi)->format('H:i') }} WIB
                    </div>
                </div>

                <div style="grid-column: 1 / -1;">
                    <div class="info-label">Keluhan Pasien</div>
                    <div class="info-value">{{ $booking->keluhan ?? '-' }}</div>
                </div>
            </div>
        </div>

        <form action="{{ route('tenaga-medis.rekam-medis.store', $booking->id) }}" method="POST">
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label>Diagnosa <span style="color:#dc2626;">*</span></label>
                    <textarea name="diagnosa"
                              class="form-control"
                              placeholder="Contoh: Infeksi saluran pernapasan atas, demam, flu..."
                              required>{{ old('diagnosa') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Tindakan</label>
                    <textarea name="tindakan"
                              class="form-control"
                              placeholder="Contoh: Pemeriksaan fisik, pemberian edukasi kesehatan, observasi suhu tubuh...">{{ old('tindakan') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Resep Obat</label>
                    <textarea name="resep_obat"
                              class="form-control"
                              placeholder="Contoh: Paracetamol 500mg 3x1, vitamin C 1x1...">{{ old('resep_obat') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Catatan Dokter</label>
                    <textarea name="catatan_dokter"
                              class="form-control"
                              placeholder="Catatan tambahan untuk pasien...">{{ old('catatan_dokter') }}</textarea>
                </div>
            </div>

            <div class="btn-row">
                <a href="{{ route('tenaga-medis.dashboard', ['tanggal' => $booking->tanggal_konsultasi]) }}"
                   class="btn-back">
                    Kembali
                </a>

                <button type="submit" class="btn-save">
                    Simpan Rekam Medis
                </button>
            </div>
        </form>

    </div>
</div>
@endsection