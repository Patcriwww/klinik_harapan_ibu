@extends('backoffice.layouts.app')

@section('breadcrumb', 'Permission')
@section('title', 'Daftar Permission')

@section('content')
<style>
    .perm-page { padding: 26px; }

    .perm-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 24px;
        gap: 16px;
    }

    .perm-title { font-size: 30px; font-weight: 900; color: #1e293b; margin: 0; }
    .perm-subtitle { color: #94a3b8; margin-top: 8px; font-size: 15px; }

    .btn-rp {
        border: none;
        border-radius: 14px;
        padding: 12px 18px;
        font-weight: 900;
        cursor: pointer;
        text-decoration: none;
        color: white;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-purple { background: #7c3aed; }
    .btn-back   { background: #64748b; }

    .alert-success {
        background: #dcfce7;
        color: #15803d;
        padding: 14px 16px;
        border-radius: 16px;
        margin-bottom: 18px;
        font-weight: 800;
    }

    .perm-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 26px;
        box-shadow: 0 10px 24px rgba(15,23,42,.08);
        border: 1px solid #f1f5f9;
    }

    .perm-table { width: 100%; border-collapse: collapse; font-size: 14px; }
    .perm-table thead tr { background: #f8fafc; }
    .perm-table th {
        padding: 12px 16px;
        text-align: left;
        color: #64748b;
        font-weight: 900;
        font-size: 12px;
        text-transform: uppercase;
    }
    .perm-table th.center, .perm-table td.center { text-align: center; }
    .perm-table tbody tr { border-bottom: 1px solid #f1f5f9; }
    .perm-table tbody tr:hover { background: #f8fafc; }
    .perm-table td { padding: 14px 16px; color: #334155; }

    .perm-badge {
        background: #ede9fe;
        color: #7c3aed;
        border-radius: 10px;
        padding: 4px 12px;
        font-size: 13px;
        font-weight: 800;
        display: inline-block;
    }

    .perm-del-form { display: inline; }
    .btn-del {
        border: none;
        background: #fee2e2;
        color: #dc2626;
        border-radius: 10px;
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 800;
        cursor: pointer;
    }
    .btn-del:hover { background: #fecaca; }

    .perm-empty {
        text-align: center;
        padding: 38px;
        color: #94a3b8;
        font-weight: 800;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        z-index: 9999;
        inset: 0;
        background: rgba(15,23,42,.55);
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .modal-overlay.active { display: flex; }
    .modal-box {
        background: #fff;
        border-radius: 24px;
        padding: 26px;
        width: 100%;
        max-width: 480px;
        box-shadow: 0 25px 60px rgba(15,23,42,.25);
    }
    .modal-header { display: flex; justify-content: space-between; margin-bottom: 20px; gap: 12px; }
    .modal-title  { font-size: 20px; font-weight: 900; color: #1e293b; margin: 0; }
    .modal-close  {
        border: none; background: #f1f5f9; width: 36px; height: 36px;
        border-radius: 12px; cursor: pointer; font-size: 18px; color: #64748b;
    }
    .rp-label { display: block; color: #475569; font-weight: 900; font-size: 14px; margin-bottom: 8px; }
    .modal-input {
        width: 100%; height: 52px; border: 1px solid #e2e8f0;
        border-radius: 16px; padding: 0 16px; outline: none; font-weight: 700; color: #475569;
        box-sizing: border-box;
    }
    .modal-input:focus { border-color: #7c3aed; box-shadow: 0 0 0 3px rgba(124,58,237,.12); }
    .modal-footer { margin-top: 20px; display: flex; justify-content: flex-end; gap: 12px; }
    .btn-cancel { background: #e2e8f0; color: #475569; }
</style>

<div class="perm-page">

    <div class="perm-header">
        <div>
            <h1 class="perm-title">Daftar Permission</h1>
            <p class="perm-subtitle">Kelola semua permission yang tersedia dalam sistem.</p>
        </div>

        <div style="display:flex; gap:12px; flex-wrap:wrap;">
            <a href="{{ route('admin.backoffice.role-permission.index') }}" class="btn-rp btn-back">
                ← Role Permission
            </a>
            <button type="button" class="btn-rp btn-purple" onclick="document.getElementById('addModal').classList.add('active')">
                + Tambah Permission
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="perm-card">
        <table class="perm-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Permission</th>
                    <th>Guard</th>
                    <th class="center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($permissions as $permission)
                    <tr>
                        <td>{{ $permissions->firstItem() + $loop->index }}</td>
                        <td><span class="perm-badge">{{ $permission->name }}</span></td>
                        <td>{{ $permission->guard_name }}</td>
                        <td class="center">
                            <form class="perm-del-form"
                                  action="{{ route('admin.backoffice.permissions.destroy', $permission->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus permission {{ $permission->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-del">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="perm-empty">Belum ada permission.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:20px;">
            {{ $permissions->links() }}
        </div>
    </div>
</div>

<div class="modal-overlay" id="addModal">
    <div class="modal-box">
        <form method="POST" action="{{ route('admin.backoffice.permissions.store') }}">
            @csrf
            <div class="modal-header">
                <h3 class="modal-title">Tambah Permission</h3>
                <button type="button" class="modal-close" onclick="document.getElementById('addModal').classList.remove('active')">×</button>
            </div>

            <label class="rp-label">Nama Permission</label>
            <input type="text"
                   name="name"
                   class="modal-input"
                   placeholder="Contoh: users.view / booking.create"
                   required>

            <div class="modal-footer">
                <button type="button" class="btn-rp btn-cancel" onclick="document.getElementById('addModal').classList.remove('active')">
                    Batal
                </button>
                <button type="submit" class="btn-rp btn-purple">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('addModal').addEventListener('click', function(e) {
        if (e.target === this) this.classList.remove('active');
    });
</script>
@endsection
