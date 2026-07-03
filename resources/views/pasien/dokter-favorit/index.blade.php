@extends('backoffice.layouts.app')

@section('breadcrumb', 'Dokter Favorit')
@section('title', 'Dokter Favorit')

@section('content')
<style>
    .fav-page {
        padding: 26px;
    }

    .fav-card {
        background: #ffffff;
        border-radius: 26px;
        padding: 30px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, .08);
    }

    .fav-title {
        font-size: 30px;
        font-weight: 900;
        color: #1e293b;
        margin: 0;
    }

    .fav-subtitle {
        color: #94a3b8;
        margin-top: 8px;
        font-size: 15px;
    }

    .fav-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
        margin-top: 26px;
    }

    .doctor-card {
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 22px;
        background: #ffffff;
        box-shadow: 0 8px 20px rgba(15, 23, 42, .06);
        position: relative;
    }

    .doctor-header {
        display: flex;
        gap: 14px;
        align-items: center;
        margin-bottom: 18px;
    }

    .doctor-photo {
        width: 64px;
        height: 64px;
        border-radius: 18px;
        object-fit: cover;
        background: #eff6ff;
    }

    .doctor-avatar {
        width: 64px;
        height: 64px;
        border-radius: 18px;
        background: #2563eb;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 24px;
        font-weight: 900;
    }

    .doctor-info {
        flex: 1;
        min-width: 0;
    }

    .doctor-name {
        font-size: 17px;
        font-weight: 900;
        color: #1e293b;
    }

    .doctor-specialist {
        font-size: 13px;
        color: #64748b;
        font-weight: 700;
        margin-top: 4px;
    }

    .fav-heart-form {
        margin: 0;
    }

    .fav-heart-btn {
        width: 44px;
        height: 44px;
        border: none;
        border-radius: 50%;
        background: #fee2e2;
        color: #dc2626;
        cursor: pointer;
        font-size: 21px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 6px 14px rgba(220, 38, 38, .12);
    }

    .schedule-box {
        background: #f8fafc;
        border-radius: 18px;
        padding: 15px;
        margin-bottom: 18px;
    }

    .schedule-title {
        font-size: 12px;
        color: #64748b;
        font-weight: 900;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .schedule-item {
        font-size: 13px;
        color: #334155;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .btn-row {
        display: flex;
        gap: 10px;
    }

    .btn-booking,
    .btn-remove {
        flex: 1;
        text-align: center;
        border: none;
        border-radius: 14px;
        padding: 11px 14px;
        font-weight: 900;
        text-decoration: none;
        cursor: pointer;
        font-size: 13px;
    }

    .btn-booking {
        background: #2563eb;
        color: white;
    }

    .btn-remove {
        background: #fee2e2;
        color: #dc2626;
    }

    .empty-box {
        grid-column: 1 / -1;
        text-align: center;
        padding: 46px;
        border: 1px dashed #cbd5e1;
        border-radius: 24px;
        color: #94a3b8;
        font-weight: 800;
        background: #f8fafc;
    }

    .alert-success {
        background: #dcfce7;
        color: #15803d;
        padding: 14px 16px;
        border-radius: 16px;
        margin-top: 18px;
        font-weight: 800;
    }

    @media(max-width: 1100px) {
        .fav-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media(max-width: 700px) {
        .fav-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="fav-page">
    <div class="fav-card">
        <h1 class="fav-title">Dokter Favorit</h1>
        <p class="fav-subtitle">
            Daftar tenaga medis yang Anda tandai sebagai favorit untuk memudahkan proses booking konsultasi.
        </p>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="fav-grid">
            @forelse($favorits as $favorit)
                @php
                    $dokter = $favorit->tenagaMedis;
                @endphp

                @if($dokter)
                    <div class="doctor-card">
                        <div class="doctor-header">
                            @if($dokter->foto)
                                <img src="{{ asset('storage/' . $dokter->foto) }}" class="doctor-photo">
                            @else
                                <div class="doctor-avatar">
                                    {{ strtoupper(substr($dokter->nama ?? 'D', 0, 1)) }}
                                </div>
                            @endif

                            <div class="doctor-info">
                                <div class="doctor-name">{{ $dokter->nama ?? '-' }}</div>
                                <div class="doctor-specialist">{{ $dokter->spesialis ?? '-' }}</div>
                            </div>

                            <form action="{{ route('pasien.dokter-favorit.toggle', $dokter->id) }}"
                                  method="POST"
                                  class="fav-heart-form"
                                  onsubmit="return confirm('Hapus dokter ini dari favorit?')">
                                @csrf
                                <button type="submit" class="fav-heart-btn" title="Hapus dari favorit">
                                    ❤️
                                </button>
                            </form>
                        </div>

                        <div class="schedule-box">
                            <div class="schedule-title">Jadwal Praktik</div>

                            @forelse($dokter->jadwalPraktik ?? [] as $jadwal)
                                <div class="schedule-item">
                                    {{ $jadwal->hari }},
                                    {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}
                                    -
                                    {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                </div>
                            @empty
                                <div class="schedule-item">Belum ada jadwal praktik.</div>
                            @endforelse
                        </div>

                        <div class="btn-row">
                            <a href="{{ route('pasien.jadwal-konsultasi.index') }}" class="btn-booking">
                                Booking
                            </a>

                            <form action="{{ route('pasien.dokter-favorit.toggle', $dokter->id) }}"
                                  method="POST"
                                  style="flex:1;"
                                  onsubmit="return confirm('Hapus dokter ini dari favorit?')">
                                @csrf
                                <button type="submit" class="btn-remove">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @empty
                <div class="empty-box">
                    Belum ada dokter favorit. Tambahkan dokter favorit melalui halaman Jadwal Konsultasi.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection