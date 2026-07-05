@extends('backoffice.layouts.app')

@section('breadcrumb', 'Profil')
@section('title', 'Profil Tenaga Medis')

@section('content')
<style>
    .page { padding: 26px; }
    .card { background: #fff; border-radius: 26px; padding: 30px; box-shadow: 0 12px 30px rgba(15,23,42,.08); max-width: 720px; }
    .title { font-size: 30px; font-weight: 900; color: #1e293b; margin: 0; }
    .subtitle { color: #94a3b8; margin-top: 8px; margin-bottom: 24px; }
    .avatar-row { display: flex; align-items: center; gap: 18px; margin-bottom: 26px; }
    .avatar { width: 84px; height: 84px; border-radius: 20px; object-fit: cover; background: linear-gradient(135deg, #dbeafe, #bfdbfe); display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 900; color: #1d4ed8; }
    .grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px; }
    .group.full { grid-column: 1 / -1; }
    label { display: block; font-weight: 900; color: #475569; margin-bottom: 8px; }
    input { width: 100%; height: 50px; border: 1px solid #e2e8f0; border-radius: 16px; padding: 0 16px; color: #334155; font-weight: 700; outline: none; }
    input:disabled { background: #f1f5f9; color: #94a3b8; }
    .btn-row { display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px; }
    .btn { border: none; border-radius: 15px; padding: 13px 18px; font-weight: 900; text-decoration: none; cursor: pointer; }
    .btn-blue { background: #2563eb; color: white; }
    .alert-success { background: #dcfce7; color: #15803d; padding: 14px 16px; border-radius: 16px; margin-bottom: 18px; font-weight: 800; }
    .error { background: #fee2e2; color: #dc2626; padding: 14px 16px; border-radius: 16px; margin-bottom: 18px; font-weight: 800; }

    @media(max-width: 700px) {
        .grid { grid-template-columns: 1fr; }
    }
</style>

<div class="page">
    <div class="card">
        <h1 class="title">Profil Tenaga Medis</h1>
        <p class="subtitle">Kelola informasi profil Anda.</p>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <div class="avatar-row">
            @if($tenagaMedis->foto)
                <img src="{{ asset('storage/' . $tenagaMedis->foto) }}" alt="{{ $tenagaMedis->nama }}" class="avatar">
            @else
                <div class="avatar">{{ strtoupper(substr($tenagaMedis->nama, 0, 1)) }}</div>
            @endif
        </div>

        <form action="{{ route('tenaga-medis.profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid">
                <div class="group">
                    <label>Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $tenagaMedis->nama) }}" required>
                </div>

                <div class="group">
                    <label>Email</label>
                    <input type="email" value="{{ $tenagaMedis->email }}" disabled>
                </div>

                <div class="group">
                    <label>No HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $tenagaMedis->no_hp) }}">
                </div>

                <div class="group">
                    <label>Spesialis</label>
                    <input type="text" name="spesialis" value="{{ old('spesialis', $tenagaMedis->spesialis) }}">
                </div>

                <div class="group full">
                    <label>Foto Profil</label>
                    <input type="file" name="foto" accept="image/*">
                </div>
            </div>

            <div class="btn-row">
                <button type="submit" class="btn btn-blue">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
