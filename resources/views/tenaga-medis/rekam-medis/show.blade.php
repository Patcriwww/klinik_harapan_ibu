@extends('backoffice.layouts.app')

@section('breadcrumb', 'Detail Rekam Medis')
@section('title', 'Detail Rekam Medis')

@section('content')
<div style="padding:26px;">
    <div style="background:white;border-radius:24px;padding:30px;box-shadow:0 10px 24px rgba(15,23,42,.08);">
        <h1 style="font-size:30px;font-weight:900;color:#1e293b;margin:0;">
            Detail Rekam Medis
        </h1>

        <p style="color:#94a3b8;margin-top:8px;">
            Informasi hasil pemeriksaan pasien.
        </p>

        @if(session('success'))
            <div style="background:#dcfce7;color:#15803d;padding:14px 16px;border-radius:16px;margin:18px 0;font-weight:800;">
                {{ session('success') }}
            </div>
        @endif

        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:24px 0;">
            <div style="background:#f8fafc;border-radius:18px;padding:16px;">
                <div style="font-size:12px;color:#64748b;font-weight:900;">Pasien</div>
                <div style="font-weight:900;color:#1e293b;margin-top:6px;">
                    {{ $rekamMedis->pasien->name ?? '-' }}
                </div>
            </div>

            <div style="background:#f8fafc;border-radius:18px;padding:16px;">
                <div style="font-size:12px;color:#64748b;font-weight:900;">Dokter</div>
                <div style="font-weight:900;color:#1e293b;margin-top:6px;">
                    {{ $rekamMedis->tenagaMedis->nama ?? '-' }}
                </div>
            </div>

            <div style="background:#f8fafc;border-radius:18px;padding:16px;">
                <div style="font-size:12px;color:#64748b;font-weight:900;">Tanggal Pemeriksaan</div>
                <div style="font-weight:900;color:#1e293b;margin-top:6px;">
                    {{ \Carbon\Carbon::parse($rekamMedis->tanggal_pemeriksaan)->format('d/m/Y') }}
                </div>
            </div>

            <div style="background:#f8fafc;border-radius:18px;padding:16px;">
                <div style="font-size:12px;color:#64748b;font-weight:900;">Nomor Antrian</div>
                <div style="font-weight:900;color:#2563eb;margin-top:6px;">
                    {{ $rekamMedis->booking->nomor_antrian ?? '-' }}
                </div>
            </div>

            <div style="background:#f8fafc;border-radius:18px;padding:16px;">
                <div style="font-size:12px;color:#64748b;font-weight:900;">Kode Booking</div>
                <div style="font-weight:900;color:#1e293b;margin-top:6px;">
                    {{ $rekamMedis->booking->kode_booking ?? '-' }}
                </div>
            </div>

            <div style="background:#f8fafc;border-radius:18px;padding:16px;">
                <div style="font-size:12px;color:#64748b;font-weight:900;">Suhu / Tekanan Darah</div>
                <div style="font-weight:900;color:#1e293b;margin-top:6px;">
                    {{ $rekamMedis->suhu ?? '-' }} °C / {{ $rekamMedis->tekanan_darah ?? '-' }}
                </div>
            </div>
        </div>

        @foreach([
            'Keluhan' => $rekamMedis->keluhan,
            'Diagnosa' => $rekamMedis->diagnosa,
            'Tindakan' => $rekamMedis->tindakan,
            'Resep Obat' => $rekamMedis->resep_obat,
            'Catatan Dokter' => $rekamMedis->catatan_dokter,
        ] as $label => $value)
            <div style="border:1px solid #f1f5f9;border-radius:18px;padding:18px;margin-bottom:14px;">
                <div style="font-size:13px;text-transform:uppercase;color:#64748b;font-weight:900;margin-bottom:8px;">
                    {{ $label }}
                </div>
                <div style="color:#334155;line-height:1.6;font-weight:600;">
                    {{ $value ?? '-' }}
                </div>
            </div>
        @endforeach

        <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:22px;">
            <a href="{{ route('tenaga-medis.rekam-medis.index') }}"
               style="background:#e2e8f0;color:#475569;padding:12px 18px;border-radius:14px;font-weight:900;text-decoration:none;">
                Kembali
            </a>

            <a href="{{ route('tenaga-medis.rekam-medis.edit', $rekamMedis->id) }}"
               style="background:#f97316;color:white;padding:12px 18px;border-radius:14px;font-weight:900;text-decoration:none;">
                Edit
            </a>
        </div>
    </div>
</div>
@endsection