@extends('backoffice.layouts.app')

@section('breadcrumb', 'Data Pasien')
@section('title', 'Data Pasien')

@section('content')
<style>
    .page{padding:26px}.card{background:#fff;border-radius:26px;padding:30px;box-shadow:0 12px 30px rgba(15,23,42,.08)}
    .header{display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:22px}
    .title{font-size:30px;font-weight:900;color:#1e293b;margin:0}.subtitle{color:#94a3b8;margin-top:8px}
    .actions{display:flex;gap:10px;flex-wrap:wrap}.btn{border:none;border-radius:15px;padding:13px 18px;font-weight:900;text-decoration:none;cursor:pointer}
    .btn-blue{background:#2563eb;color:white}.btn-green{background:#16a34a;color:white}.btn-red{background:#fee2e2;color:#dc2626}.btn-gray{background:#e2e8f0;color:#475569}
    .filter{display:flex;gap:12px;background:#f8fafc;border-radius:20px;padding:16px;margin-bottom:22px}
    .filter input{height:48px;border:1px solid #e2e8f0;border-radius:15px;padding:0 14px;flex:1}
    table{width:100%;border-collapse:separate;border-spacing:0 12px;min-width:900px}th{text-align:left;color:#64748b;font-size:12px;text-transform:uppercase;padding:12px 16px}
    td{background:#fff;padding:16px;border-top:1px solid #f1f5f9;border-bottom:1px solid #f1f5f9;color:#334155}
    td:first-child{border-left:1px solid #f1f5f9;border-radius:16px 0 0 16px}td:last-child{border-right:1px solid #f1f5f9;border-radius:0 16px 16px 0}
    .name{font-weight:900;color:#1e293b}.muted{font-size:12px;color:#94a3b8;margin-top:4px}.table-responsive{overflow-x:auto}
    .alert{background:#dcfce7;color:#15803d;padding:14px 16px;border-radius:16px;margin-bottom:18px;font-weight:800}
</style>

<div class="page">
    <div class="card">
        <div class="header">
            <div>
                <h1 class="title">Data Pasien</h1>
                <p class="subtitle">Kelola data pasien Klinik Harapan Ibu.</p>
            </div>

            <div class="actions">
                <a href="{{ route('admin.backoffice.export.pasien') }}" class="btn btn-green">Export Excel</a>
                <a href="{{ route('admin.backoffice.pasien.create') }}" class="btn btn-blue">+ Tambah Pasien</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <form method="GET" action="{{ route('admin.backoffice.pasien.index') }}" class="filter">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email pasien...">
            <button type="submit" class="btn btn-blue">Filter</button>
            <a href="{{ route('admin.backoffice.pasien.index') }}" class="btn btn-gray">Reset</a>
        </form>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Pasien</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pasiens as $pasien)
                        <tr>
                            <td>
                                <div class="name">{{ $pasien->name }}</div>
                            <td>{{ $pasien->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.backoffice.pasien.edit', $pasien->id) }}" class="btn btn-gray">Edit</a>
                                    <form action="{{ route('admin.backoffice.pasien.destroy', $pasien->id) }}" method="POST" onsubmit="return confirm('Hapus pasien ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-red">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center;color:#94a3b8;padding:35px;">Belum ada data pasien.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;">
            {{ $pasiens->links() }}
        </div>
    </div>
</div>
@endsection