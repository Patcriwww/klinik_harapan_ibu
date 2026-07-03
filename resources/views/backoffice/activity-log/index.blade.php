@extends('backoffice.layouts.app')

@section('breadcrumb', 'Activity Log')
@section('title', 'Activity Log')

@section('content')
<style>
    .log-page { padding: 26px; }
    .log-card {
        background: #fff;
        border-radius: 26px;
        padding: 30px;
        box-shadow: 0 12px 30px rgba(15,23,42,.08);
    }
    .log-title {
        font-size: 30px;
        font-weight: 900;
        color: #1e293b;
        margin: 0;
    }
    .log-subtitle {
        color: #94a3b8;
        margin-top: 8px;
        font-size: 15px;
    }
    .filter-box {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        background: #f8fafc;
        border-radius: 20px;
        padding: 18px;
        margin: 26px 0;
    }
    .filter-box input,
    .filter-box select {
        height: 46px;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        padding: 0 14px;
        color: #475569;
        font-weight: 700;
        outline: none;
    }
    .btn-filter,
    .btn-reset {
        height: 46px;
        border: none;
        border-radius: 15px;
        padding: 0 18px;
        font-weight: 900;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        cursor: pointer;
    }
    .btn-filter { background: #0ea5e9; color: white; }
    .btn-reset { background: #e2e8f0; color: #475569; }
    .table-responsive { overflow-x: auto; }
    .log-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
        min-width: 1000px;
    }
    .log-table th {
        text-align: left;
        padding: 12px 16px;
        font-size: 12px;
        color: #64748b;
        text-transform: uppercase;
        font-weight: 900;
    }
    .log-table td {
        background: #fff;
        padding: 16px;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 14px;
        vertical-align: top;
    }
    .log-table td:first-child {
        border-left: 1px solid #f1f5f9;
        border-radius: 16px 0 0 16px;
    }
    .log-table td:last-child {
        border-right: 1px solid #f1f5f9;
        border-radius: 0 16px 16px 0;
    }
    .user-name { font-weight: 900; color: #1e293b; }
    .muted { color: #94a3b8; font-size: 12px; margin-top: 4px; }
    .badge {
        display: inline-block;
        padding: 7px 13px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        background: #eff6ff;
        color: #2563eb;
    }
    .empty {
        text-align: center;
        color: #94a3b8;
        padding: 35px;
        font-weight: 800;
    }
</style>

<div class="log-page">
    <div class="log-card">
        <h1 class="log-title">Activity Log</h1>
        <p class="log-subtitle">
            Pantau aktivitas pengguna pada sistem Klinik Harapan Ibu.
        </p>

        <form method="GET" action="{{ route('admin.backoffice.activity-log.index') }}" class="filter-box">
            <select name="user_id">
                <option value="">Semua User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <input type="text"
                   name="aksi"
                   value="{{ request('aksi') }}"
                   placeholder="Cari aksi...">

            <select name="modul">
                <option value="">Semua Modul</option>
                @foreach($moduls as $modul)
                    <option value="{{ $modul }}" {{ request('modul') == $modul ? 'selected' : '' }}>
                        {{ $modul }}
                    </option>
                @endforeach
            </select>

            <input type="date" name="tanggal" value="{{ request('tanggal') }}">

            <button type="submit" class="btn-filter">Filter</button>

            <a href="{{ route('admin.backoffice.activity-log.index') }}" class="btn-reset">
                Reset
            </a>
        </form>

        <div class="table-responsive">
            <table class="log-table">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Aksi</th>
                        <th>Modul</th>
                        <th>Deskripsi</th>
                        <th>IP</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>
                                <strong>{{ $log->created_at->format('d/m/Y') }}</strong>
                                <div class="muted">{{ $log->created_at->format('H:i:s') }} WIB</div>
                            </td>

                            <td>
                                <div class="user-name">{{ $log->user->name ?? 'System' }}</div>
                                <div class="muted">{{ $log->user->email ?? '-' }}</div>
                            </td>

                            <td>
                                <span class="badge">{{ $log->role ?? '-' }}</span>
                            </td>

                            <td>{{ $log->aksi }}</td>

                            <td>
                                <span class="badge">{{ $log->modul ?? '-' }}</span>
                            </td>

                            <td>{{ $log->deskripsi ?? '-' }}</td>

                            <td>{{ $log->ip_address ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty">
                                Belum ada activity log.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection