@extends('backoffice.layouts.app')

@section('breadcrumb', 'Hasil Laboratorium')
@section('title', 'Hasil Laboratorium')

@section('content')
<style>
    .rm-page { padding: 26px; }
    .rm-main-card { background: #ffffff; border-radius: 26px; padding: 30px; box-shadow: 0 12px 30px rgba(15, 23, 42, .08); }
    .rm-header { display: flex; justify-content: space-between; align-items: flex-start; gap: 18px; margin-bottom: 24px; }
    .rm-title { font-size: 30px; font-weight: 900; color: #1e293b; margin: 0; }
    .rm-subtitle { color: #94a3b8; margin-top: 8px; font-size: 15px; }

    .rm-filter { display: flex; flex-wrap: wrap; gap: 12px; background: #f8fafc; border-radius: 20px; padding: 18px; margin-bottom: 26px; }
    .rm-filter input { height: 46px; border: 1px solid #e2e8f0; border-radius: 15px; padding: 0 14px; color: #475569; outline: none; font-weight: 700; min-width: 260px; flex: 1; }

    .btn-filter, .btn-reset { height: 46px; border: none; border-radius: 15px; padding: 0 18px; font-weight: 900; text-decoration: none; display: inline-flex; align-items: center; cursor: pointer; }
    .btn-filter { background: #0ea5e9; color: white; }
    .btn-reset { background: #e2e8f0; color: #475569; }

    .rm-list { display: grid; grid-template-columns: 1fr; gap: 18px; }
    .rm-item { border: 1px solid #e2e8f0; border-radius: 22px; background: #ffffff; padding: 20px; box-shadow: 0 8px 20px rgba(15, 23, 42, .06); display: grid; grid-template-columns: 170px 1fr 160px; gap: 20px; align-items: center; }

    .rm-date-box { background: linear-gradient(135deg, #14b8a6, #0ea5e9); color: white; border-radius: 20px; padding: 18px; text-align: center; }
    .rm-date-day { font-size: 30px; font-weight: 900; }
    .rm-date-month { font-size: 13px; font-weight: 800; opacity: .9; margin-top: 4px; }

    .rm-patient-name { font-size: 18px; color: #1e293b; font-weight: 900; margin-bottom: 4px; }
    .rm-patient-email { color: #94a3b8; font-size: 13px; font-weight: 700; margin-bottom: 14px; }

    .rm-info { background: #f8fafc; border-radius: 16px; padding: 12px 14px; }
    .rm-info-label { font-size: 11px; color: #94a3b8; font-weight: 900; text-transform: uppercase; margin-bottom: 5px; }
    .rm-info-value { font-size: 13px; color: #334155; font-weight: 800; line-height: 1.5; white-space: pre-line; }

    .btn-edit { text-align: center; border-radius: 14px; padding: 11px 14px; font-size: 13px; font-weight: 900; text-decoration: none; color: white; background: #f97316; }

    .empty-box { text-align: center; padding: 40px; border: 1px dashed #cbd5e1; border-radius: 22px; color: #94a3b8; background: #f8fafc; font-weight: 800; }

    .alert-success { background: #dcfce7; color: #15803d; padding: 14px 16px; border-radius: 16px; margin-bottom: 18px; font-weight: 800; }

    @media(max-width: 700px) {
        .rm-item { grid-template-columns: 1fr; }
        .rm-header { flex-direction: column; }
    }
</style>

<div class="rm-page">
    <div class="rm-main-card">
        <div class="rm-header">
            <div>
                <h1 class="rm-title">Hasil Laboratorium</h1>
                <p class="rm-subtitle">Kelola catatan hasil pemeriksaan laboratorium pasien.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" action="{{ route('tenaga-medis.hasil-lab.index') }}" class="rm-filter">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pasien...">
            <button type="submit" class="btn-filter">Cari</button>
            <a href="{{ route('tenaga-medis.hasil-lab.index') }}" class="btn-reset">Reset</a>
        </form>

        <div class="rm-list">
            @forelse($rekamMedis as $item)
                @php
                    $tanggal = \Carbon\Carbon::parse($item->tanggal_pemeriksaan);
                @endphp
                <div class="rm-item">
                    <div class="rm-date-box">
                        <div class="rm-date-day">{{ $tanggal->format('d') }}</div>
                        <div class="rm-date-month">{{ $tanggal->translatedFormat('F Y') }}</div>
                    </div>

                    <div>
                        <div class="rm-patient-name">{{ $item->pasien->name ?? '-' }}</div>
                        <div class="rm-patient-email">{{ $item->pasien->email ?? '-' }}</div>

                        <div class="rm-info">
                            <div class="rm-info-label">Hasil Lab</div>
                            <div class="rm-info-value">{{ $item->hasil_lab ?? 'Belum diisi' }}</div>
                        </div>
                    </div>

                    <a href="{{ route('tenaga-medis.hasil-lab.edit', $item->id) }}" class="btn-edit">
                        {{ $item->hasil_lab ? 'Edit Hasil' : 'Isi Hasil' }}
                    </a>
                </div>
            @empty
                <div class="empty-box">Belum ada data rekam medis pasien.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
