@extends('backoffice.layouts.app')

@section('breadcrumb', 'Pengaturan Sistem')
@section('title', 'Pengaturan Sistem')

@section('content')
<style>
    .setting-page {
        padding: 26px;
    }

    .setting-card {
        background: #ffffff;
        border-radius: 26px;
        padding: 30px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, .08);
    }

    .setting-title {
        font-size: 30px;
        font-weight: 900;
        color: #1e293b;
        margin: 0;
    }

    .setting-subtitle {
        color: #94a3b8;
        margin-top: 8px;
        font-size: 15px;
    }

    .setting-grid {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 26px;
        margin-top: 26px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-label {
        display: block;
        font-weight: 900;
        color: #475569;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 14px 16px;
        color: #334155;
        outline: none;
        font-weight: 700;
    }

    .form-input {
        height: 50px;
    }

    .form-textarea {
        min-height: 110px;
        resize: vertical;
    }

    .form-input:focus,
    .form-textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
    }

    .preview-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: 22px;
        height: fit-content;
    }

    .preview-logo {
        width: 86px;
        height: 86px;
        border-radius: 20px;
        object-fit: contain;
        background: white;
        border: 1px solid #e2e8f0;
        padding: 10px;
        margin-bottom: 16px;
    }

    .preview-title {
        font-size: 20px;
        font-weight: 900;
        color: #1e293b;
        margin-bottom: 4px;
    }

    .preview-subtitle {
        color: #64748b;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .preview-info {
        color: #64748b;
        font-size: 13px;
        line-height: 1.6;
        font-weight: 700;
    }

    .btn-row {
        display: flex;
        justify-content: flex-end;
        margin-top: 24px;
    }

    .btn-save {
        border: none;
        background: #2563eb;
        color: white;
        border-radius: 16px;
        padding: 14px 22px;
        font-weight: 900;
        cursor: pointer;
    }

    .alert-success {
        background: #dcfce7;
        color: #15803d;
        padding: 14px 16px;
        border-radius: 16px;
        margin-top: 18px;
        font-weight: 800;
    }

    .alert-error {
        background: #fee2e2;
        color: #dc2626;
        padding: 14px 16px;
        border-radius: 16px;
        margin-top: 18px;
        font-weight: 800;
    }

    @media(max-width: 1000px) {
        .setting-grid,
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="setting-page">
    <div class="setting-card">
        <h1 class="setting-title">Pengaturan Sistem</h1>
        <p class="setting-subtitle">
            Kelola identitas klinik, alamat, kontak, jam operasional, logo, dan footer aplikasi.
        </p>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert-error">{{ $errors->first() }}</div>
        @endif

        <div class="setting-grid">
            <form action="{{ route('admin.backoffice.pengaturan-sistem.update') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Nama Klinik</label>
                        <input type="text"
                               name="nama_klinik"
                               class="form-input"
                               value="{{ old('nama_klinik', $setting->nama_klinik) }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Subtitle Klinik</label>
                        <input type="text"
                               name="subtitle_klinik"
                               class="form-input"
                               value="{{ old('subtitle_klinik', $setting->subtitle_klinik) }}"
                               placeholder="Contoh: Ibu dan Anak">
                    </div>

                    <div class="form-group full">
                        <label class="form-label">Alamat Klinik</label>
                        <textarea name="alamat"
                                  class="form-textarea">{{ old('alamat', $setting->alamat) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text"
                               name="telepon"
                               class="form-input"
                               value="{{ old('telepon', $setting->telepon) }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Klinik</label>
                        <input type="email"
                               name="email"
                               class="form-input"
                               value="{{ old('email', $setting->email) }}">
                    </div>

                    <div class="form-group full">
                        <label class="form-label">Jam Operasional</label>
                        <input type="text"
                               name="jam_operasional"
                               class="form-input"
                               value="{{ old('jam_operasional', $setting->jam_operasional) }}"
                               placeholder="Senin - Sabtu, 08.00 - 17.00 WIB">
                    </div>

                    <div class="form-group full">
                        <label class="form-label">Footer Website</label>
                        <textarea name="footer"
                                  class="form-textarea">{{ old('footer', $setting->footer) }}</textarea>
                    </div>

                    <div class="form-group full">
                        <label class="form-label">Logo Klinik</label>
                        <input type="file"
                               name="logo"
                               class="form-input"
                               accept="image/*">
                    </div>
                </div>

                <div class="btn-row">
                    <button type="submit" class="btn-save">
                        Simpan Pengaturan
                    </button>
                </div>
            </form>

            <div class="preview-card">
                @if($setting->logo)
                    <img src="{{ asset('storage/' . $setting->logo) }}" class="preview-logo">
                @else
                    <img src="{{ asset('admin/assets/img/logo.png') }}" class="preview-logo">
                @endif

                <div class="preview-title">
                    {{ $setting->nama_klinik ?? 'Klinik Harapan Ibu' }}
                </div>

                <div class="preview-subtitle">
                    {{ $setting->subtitle_klinik ?? 'Ibu dan Anak' }}
                </div>

                <div class="preview-info">
                    {{ $setting->alamat ?? '-' }} <br>
                    {{ $setting->telepon ?? '-' }} <br>
                    {{ $setting->email ?? '-' }} <br>
                    {{ $setting->jam_operasional ?? '-' }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection