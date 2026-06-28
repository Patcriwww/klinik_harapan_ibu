@extends('backoffice.layouts.app')

@section('breadcrumb', 'Role Permission')
@section('title', 'Role Permission')

@section('content')
<style>
    .rp-page {
        padding: 26px;
    }

    .rp-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 24px;
        gap: 16px;
    }

    .rp-title {
        font-size: 30px;
        font-weight: 900;
        color: #1e293b;
        margin: 0;
    }

    .rp-subtitle {
        color: #94a3b8;
        margin-top: 8px;
        font-size: 15px;
    }

    .rp-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-rp {
        border: none;
        border-radius: 14px;
        padding: 12px 18px;
        font-weight: 900;
        cursor: pointer;
        text-decoration: none;
        color: white;
    }

    .btn-blue {
        background: #0ea5e9;
    }

    .btn-green {
        background: #22c55e;
    }

    .btn-purple {
        background: #7c3aed;
    }

    .rp-stat-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 24px;
    }

    .rp-stat-card {
        background: #ffffff;
        border-radius: 22px;
        padding: 22px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
        border: 1px solid #f1f5f9;
    }

    .rp-stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .rp-stat-label {
        font-size: 13px;
        color: #64748b;
        font-weight: 900;
        text-transform: uppercase;
    }

    .rp-stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
    }

    .rp-stat-value {
        margin-top: 16px;
        color: #1e293b;
        font-size: 32px;
        font-weight: 900;
    }

    .rp-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 26px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
        border: 1px solid #f1f5f9;
    }

    .rp-card-title {
        font-size: 22px;
        font-weight: 900;
        color: #1e293b;
        margin-bottom: 18px;
    }

    .rp-role-select-box {
        background: #f8fafc;
        border-radius: 20px;
        padding: 18px;
        margin-bottom: 24px;
    }

    .rp-label {
        display: block;
        color: #475569;
        font-weight: 900;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .rp-select {
        width: 100%;
        height: 52px;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 0 16px;
        color: #475569;
        outline: none;
        font-weight: 700;
    }

    .selected-role-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 18px;
        padding: 16px 18px;
        margin-bottom: 20px;
        gap: 12px;
        flex-wrap: wrap;
    }

    .selected-role-info strong {
        color: #2563eb;
        font-size: 16px;
    }

    .permission-toolbar {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-small {
        border: none;
        border-radius: 12px;
        padding: 9px 13px;
        font-size: 12px;
        font-weight: 900;
        cursor: pointer;
    }

    .btn-select-all {
        background: #dcfce7;
        color: #16a34a;
    }

    .btn-unselect-all {
        background: #fee2e2;
        color: #dc2626;
    }

    .permission-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
        margin-bottom: 24px;
    }

    .permission-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 13px 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #334155;
        font-size: 14px;
        font-weight: 800;
        cursor: pointer;
        transition: .2s;
    }

    .permission-item:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
        color: #2563eb;
    }

    .permission-item input {
        width: 18px;
        height: 18px;
        accent-color: #2563eb;
    }

    .rp-save-box {
        display: flex;
        justify-content: flex-end;
    }

    .empty-role {
        text-align: center;
        padding: 38px;
        border: 1px dashed #cbd5e1;
        border-radius: 18px;
        color: #94a3b8;
        font-weight: 800;
        background: #f8fafc;
    }

    .alert-success {
        background: #dcfce7;
        color: #15803d;
        padding: 14px 16px;
        border-radius: 16px;
        margin-bottom: 18px;
        font-weight: 800;
    }

    .alert-error {
        background: #fee2e2;
        color: #dc2626;
        padding: 14px 16px;
        border-radius: 16px;
        margin-bottom: 18px;
        font-weight: 800;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        z-index: 9999;
        inset: 0;
        background: rgba(15, 23, 42, .55);
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-box {
        background: #ffffff;
        border-radius: 24px;
        padding: 26px;
        width: 100%;
        max-width: 520px;
        box-shadow: 0 25px 60px rgba(15, 23, 42, .25);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 20px;
    }

    .modal-title {
        font-size: 22px;
        color: #1e293b;
        font-weight: 900;
        margin: 0;
    }

    .modal-close {
        border: none;
        background: #f1f5f9;
        width: 38px;
        height: 38px;
        border-radius: 12px;
        cursor: pointer;
        font-size: 18px;
        color: #64748b;
    }

    .modal-input {
        width: 100%;
        height: 52px;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 0 16px;
        outline: none;
        font-weight: 700;
        color: #475569;
    }

    .modal-input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
    }

    .modal-footer {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .btn-cancel {
        background: #e2e8f0;
        color: #475569;
    }

    @media(max-width: 1200px) {
        .permission-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media(max-width: 900px) {
        .rp-stat-grid,
        .permission-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .rp-header {
            flex-direction: column;
        }
    }

    @media(max-width: 600px) {
        .rp-stat-grid,
        .permission-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="rp-page">

    <div class="rp-header">
        <div>
            <h1 class="rp-title">Role Permission</h1>
            <p class="rp-subtitle">
                Kelola role, permission, dan hak akses pengguna sistem Klinik Harapan Ibu.
            </p>
        </div>

        <div class="rp-actions">
            <button type="button" class="btn-rp btn-blue" onclick="openModal('roleModal')">
                + Tambah Role
            </button>

            <button type="button" class="btn-rp btn-green" onclick="openModal('permissionModal')">
                + Tambah Permission
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="rp-stat-grid">
        <div class="rp-stat-card">
            <div class="rp-stat-top">
                <div class="rp-stat-label">Total Role</div>
                <div class="rp-stat-icon" style="background:#0ea5e9;">👤</div>
            </div>
            <div class="rp-stat-value">{{ $roles->count() }}</div>
        </div>

        <div class="rp-stat-card">
            <div class="rp-stat-top">
                <div class="rp-stat-label">Total Permission</div>
                <div class="rp-stat-icon" style="background:#22c55e;">🔐</div>
            </div>
            <div class="rp-stat-value">{{ $permissions->count() }}</div>
        </div>

        <div class="rp-stat-card">
            <div class="rp-stat-top">
                <div class="rp-stat-label">Role Dipilih</div>
                <div class="rp-stat-icon" style="background:#7c3aed;">✅</div>
            </div>
            <div class="rp-stat-value">
                {{ $selectedRole ? $selectedRole->permissions->count() : 0 }}
            </div>
        </div>
    </div>

    <div class="rp-card">
        <div class="rp-card-title">Pengaturan Role Permission</div>

        <div class="rp-role-select-box">
            <form method="GET" action="{{ route('admin.backoffice.role-permission.index') }}">
                <label class="rp-label">Pilih Role</label>
                <select name="role_id" class="rp-select" onchange="this.form.submit()">
                    <option value="">-- Pilih Role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $selectedRole && $selectedRole->id == $role->id ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        @if($selectedRole)
            <form method="POST" action="{{ route('admin.backoffice.role-permission.sync') }}">
                @csrf
                <input type="hidden" name="role_id" value="{{ $selectedRole->id }}">

                <div class="selected-role-info">
                    <div>
                        Permission untuk role:
                        <strong>{{ ucfirst($selectedRole->name) }}</strong>
                    </div>

                    <div class="permission-toolbar">
                        <button type="button" class="btn-small btn-select-all" onclick="checkAllPermissions()">
                            Pilih Semua
                        </button>

                        <button type="button" class="btn-small btn-unselect-all" onclick="uncheckAllPermissions()">
                            Hapus Semua
                        </button>
                    </div>
                </div>

                <div class="permission-grid">
                    @foreach($permissions as $permission)
                        <label class="permission-item">
                            <input type="checkbox"
                                   name="permissions[]"
                                   value="{{ $permission->name }}"
                                   class="permission-checkbox"
                                   {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>

                            <span>{{ $permission->name }}</span>
                        </label>
                    @endforeach
                </div>

                <div class="rp-save-box">
                    <button type="submit" class="btn-rp btn-purple">
                        Simpan Permission
                    </button>
                </div>
            </form>
        @else
            <div class="empty-role">
                Silakan pilih role terlebih dahulu untuk menampilkan daftar permission.
            </div>
        @endif
    </div>
</div>

<div class="modal-overlay" id="roleModal">
    <div class="modal-box">
        <form method="POST" action="{{ route('admin.backoffice.role-permission.store-role') }}">
            @csrf

            <div class="modal-header">
                <h3 class="modal-title">Tambah Role</h3>
                <button type="button" class="modal-close" onclick="closeModal('roleModal')">×</button>
            </div>

            <label class="rp-label">Nama Role</label>
            <input type="text"
                   name="name"
                   class="modal-input"
                   placeholder="Contoh: admin / pasien / tenaga_medis"
                   required>

            <div class="modal-footer">
                <button type="button" class="btn-rp btn-cancel" onclick="closeModal('roleModal')">
                    Batal
                </button>
                <button type="submit" class="btn-rp btn-blue">
                    Simpan Role
                </button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="permissionModal">
    <div class="modal-box">
        <form method="POST" action="{{ route('admin.backoffice.role-permission.store-permission') }}">
            @csrf

            <div class="modal-header">
                <h3 class="modal-title">Tambah Permission</h3>
                <button type="button" class="modal-close" onclick="closeModal('permissionModal')">×</button>
            </div>

            <label class="rp-label">Nama Permission</label>
            <input type="text"
                   name="name"
                   class="modal-input"
                   placeholder="Contoh: users.view / booking.create / pembayaran.approve"
                   required>

            <div class="modal-footer">
                <button type="button" class="btn-rp btn-cancel" onclick="closeModal('permissionModal')">
                    Batal
                </button>
                <button type="submit" class="btn-rp btn-green">
                    Simpan Permission
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).classList.add('active');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('active');
    }

    function checkAllPermissions() {
        document.querySelectorAll('.permission-checkbox').forEach(function (checkbox) {
            checkbox.checked = true;
        });
    }

    function uncheckAllPermissions() {
        document.querySelectorAll('.permission-checkbox').forEach(function (checkbox) {
            checkbox.checked = false;
        });
    }

    document.querySelectorAll('.modal-overlay').forEach(function (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.classList.remove('active');
            }
        });
    });
</script>
@endsection