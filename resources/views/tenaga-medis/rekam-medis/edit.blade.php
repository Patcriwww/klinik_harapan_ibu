@extends('backoffice.layouts.app')

@section('breadcrumb', 'Edit Rekam Medis')
@section('title', 'Edit Rekam Medis')

@section('content')
<div style="padding:26px;">
    <div style="background:white;border-radius:24px;padding:30px;box-shadow:0 10px 24px rgba(15,23,42,.08);">
        <h1 style="font-size:30px;font-weight:900;color:#1e293b;margin:0;">
            Edit Rekam Medis
        </h1>

        <p style="color:#94a3b8;margin-top:8px;">
            Perbarui hasil pemeriksaan pasien.
        </p>

        <form action="{{ route('tenaga-medis.rekam-medis.update', $rekamMedis->id) }}" method="POST" style="margin-top:24px;">
            @csrf
            @method('PUT')

            <div style="margin-bottom:18px;">
                <label style="font-weight:900;color:#475569;">Diagnosa</label>
                <textarea name="diagnosa" required style="width:100%;min-height:110px;border:1px solid #e2e8f0;border-radius:16px;padding:14px;margin-top:8px;">{{ old('diagnosa', $rekamMedis->diagnosa) }}</textarea>
            </div>

            <div style="margin-bottom:18px;">
                <label style="font-weight:900;color:#475569;">Tindakan</label>
                <textarea name="tindakan" style="width:100%;min-height:110px;border:1px solid #e2e8f0;border-radius:16px;padding:14px;margin-top:8px;">{{ old('tindakan', $rekamMedis->tindakan) }}</textarea>
            </div>

            <div style="margin-bottom:18px;">
                <label style="font-weight:900;color:#475569;">Resep Obat</label>
                <textarea name="resep_obat" style="width:100%;min-height:110px;border:1px solid #e2e8f0;border-radius:16px;padding:14px;margin-top:8px;">{{ old('resep_obat', $rekamMedis->resep_obat) }}</textarea>
            </div>

            <div style="margin-bottom:18px;">
                <label style="font-weight:900;color:#475569;">Catatan Dokter</label>
                <textarea name="catatan_dokter" style="width:100%;min-height:110px;border:1px solid #e2e8f0;border-radius:16px;padding:14px;margin-top:8px;">{{ old('catatan_dokter', $rekamMedis->catatan_dokter) }}</textarea>
            </div>

            <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:16px;">
                <input type="number" step="0.01" name="berat_badan" placeholder="Berat Badan"
                       value="{{ old('berat_badan', $rekamMedis->berat_badan) }}"
                       style="height:48px;border:1px solid #e2e8f0;border-radius:16px;padding:0 14px;">

                <input type="number" step="0.01" name="tinggi_badan" placeholder="Tinggi Badan"
                       value="{{ old('tinggi_badan', $rekamMedis->tinggi_badan) }}"
                       style="height:48px;border:1px solid #e2e8f0;border-radius:16px;padding:0 14px;">

                <input type="number" step="0.01" name="lingkar_kepala" placeholder="Lingkar Kepala"
                       value="{{ old('lingkar_kepala', $rekamMedis->lingkar_kepala) }}"
                       style="height:48px;border:1px solid #e2e8f0;border-radius:16px;padding:0 14px;">

                <input type="number" step="0.1" name="suhu" placeholder="Suhu"
                       value="{{ old('suhu', $rekamMedis->suhu) }}"
                       style="height:48px;border:1px solid #e2e8f0;border-radius:16px;padding:0 14px;">

                <input type="text" name="tekanan_darah" placeholder="Tekanan Darah"
                       value="{{ old('tekanan_darah', $rekamMedis->tekanan_darah) }}"
                       style="height:48px;border:1px solid #e2e8f0;border-radius:16px;padding:0 14px;">
            </div>

            <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;">
                <a href="{{ route('tenaga-medis.rekam-medis.show', $rekamMedis->id) }}"
                   style="background:#e2e8f0;color:#475569;padding:12px 18px;border-radius:14px;font-weight:900;text-decoration:none;">
                    Batal
                </a>

                <button type="submit"
                        style="background:#2563eb;color:white;padding:12px 18px;border:none;border-radius:14px;font-weight:900;">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection