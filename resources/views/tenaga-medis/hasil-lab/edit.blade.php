@extends('backoffice.layouts.app')

@section('breadcrumb', 'Hasil Laboratorium')
@section('title', 'Isi Hasil Laboratorium')

@section('content')
<style>
    .page { padding: 26px; }
    .card { background: #fff; border-radius: 26px; padding: 30px; box-shadow: 0 12px 30px rgba(15,23,42,.08); }
    .title { font-size: 30px; font-weight: 900; color: #1e293b; margin: 0; }
    .subtitle { color: #94a3b8; margin-top: 8px; margin-bottom: 24px; }
    label { display: block; font-weight: 900; color: #475569; margin-bottom: 8px; }
    textarea { width: 100%; border: 1px solid #e2e8f0; border-radius: 16px; padding: 14px 16px; color: #334155; font-weight: 700; outline: none; min-height: 160px; resize: vertical; }
    .btn-row { display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px; }
    .btn { border: none; border-radius: 15px; padding: 13px 18px; font-weight: 900; text-decoration: none; cursor: pointer; }
    .btn-blue { background: #2563eb; color: white; }
    .btn-gray { background: #e2e8f0; color: #475569; }
</style>

<div class="page">
    <div class="card">
        <h1 class="title">Isi Hasil Laboratorium</h1>
        <p class="subtitle">
            Pasien: <strong>{{ $rekamMedis->pasien->name ?? '-' }}</strong>
            &middot; Tanggal Periksa: {{ \Carbon\Carbon::parse($rekamMedis->tanggal_pemeriksaan)->format('d/m/Y') }}
        </p>

        <form action="{{ route('tenaga-medis.hasil-lab.update', $rekamMedis->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Hasil Laboratorium</label>
            <textarea name="hasil_lab" placeholder="Tuliskan hasil pemeriksaan laboratorium...">{{ old('hasil_lab', $rekamMedis->hasil_lab) }}</textarea>

            <div class="btn-row">
                <a href="{{ route('tenaga-medis.hasil-lab.index') }}" class="btn btn-gray">Kembali</a>
                <button type="submit" class="btn btn-blue">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
