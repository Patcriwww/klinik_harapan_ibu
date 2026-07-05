<style>
    .page{padding:26px}.card{background:#fff;border-radius:26px;padding:30px;box-shadow:0 12px 30px rgba(15,23,42,.08)}
    .title{font-size:30px;font-weight:900;color:#1e293b;margin:0}.subtitle{color:#94a3b8;margin-top:8px;margin-bottom:24px}
    .grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px}.group.full{grid-column:1/-1}
    label{display:block;font-weight:900;color:#475569;margin-bottom:8px}
    input,select,textarea{width:100%;border:1px solid #e2e8f0;border-radius:16px;padding:14px 16px;color:#334155;font-weight:700;outline:none}
    input,select{height:50px}textarea{min-height:110px;resize:vertical}
    .btn-row{display:flex;justify-content:flex-end;gap:12px;margin-top:24px}
    .btn{border:none;border-radius:15px;padding:13px 18px;font-weight:900;text-decoration:none;cursor:pointer}
    .btn-blue{background:#2563eb;color:white}.btn-gray{background:#e2e8f0;color:#475569}
    .error{background:#fee2e2;color:#dc2626;padding:14px 16px;border-radius:16px;margin-bottom:18px;font-weight:800}
    @media(max-width:800px){.grid{grid-template-columns:1fr}}
</style>

<div class="page">
    <div class="card">
        <h1 class="title">{{ $title }}</h1>
        <p class="subtitle">Lengkapi data pasien.</p>

        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form action="{{ $action }}" method="POST">
            @csrf
            @if($method === 'PUT')
                @method('PUT')
            @endif

            <div class="grid">
                <div class="group">
                    <label>Nama Pasien</label>
                    <input type="text" name="name" value="{{ old('name', $pasien->name ?? '') }}" required>
                </div>

                <div class="group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $pasien->email ?? '') }}" required>
                </div>

                <div class="group">
                    <label>Password {{ $method === 'PUT' ? '(Kosongkan jika tidak diubah)' : '' }}</label>
                    <input type="password" name="password" {{ $method === 'POST' ? 'required' : '' }}>
                </div>

                <div class="group">
                    <label>No HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $pasien->no_hp ?? '') }}">
                </div>

                <div class="group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin">
                        <option value="">Pilih</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin', $pasien->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $pasien->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pasien->tanggal_lahir ?? '') }}">
                </div>

                <div class="group full">
                    <label>Alamat</label>
                    <textarea name="alamat">{{ old('alamat', $pasien->alamat ?? '') }}</textarea>
                </div>
            </div>

            <div class="btn-row">
                <a href="{{ route('admin.backoffice.pasien.index') }}" class="btn btn-gray">Kembali</a>
                <button type="submit" class="btn btn-blue">Simpan</button>
            </div>
        </form>
    </div>
</div>