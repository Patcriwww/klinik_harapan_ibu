@php
    $user = auth()->user();
    $role = $user?->roles?->first()?->name;

    $menus = [];

    if ($role === 'admin') {
        $menus = [
            [
                'title' => 'Dashboard',
                'url' => route('admin.backoffice.dashboard'),
                'active' => request()->is('admin/backoffice/dashboard*'),
                'icon' => 'ni ni-tv-2',
                'color' => '#0ea5e9',
            ],
            [
                'title' => 'Data Pasien',
                'url' => '#',
                'active' => request()->is('admin/backoffice/pasien*'),
                'icon' => 'ni ni-single-02',
                'color' => '#10b981',
            ],
            [
                'title' => 'Data Tenaga Medis',
                'url' => route('admin.backoffice.tenaga-medis.index'),
                'active' => request()->is('admin/backoffice/tenaga-medis*'),
                'icon' => 'ni ni-badge',
                'color' => '#6366f1',
            ],
            [
                'title' => 'Data Layanan',
                'url' => route('admin.backoffice.layanan.index'),
                'active' => request()->is('admin/backoffice/layanan*'),
                'icon' => 'ni ni-fat-add',
                'color' => '#ef4444',
            ],
            [
                'title' => 'Jadwal Praktik',
                'url' => route('admin.backoffice.jadwal-praktik.index'),
                'active' => request()->is('admin/backoffice/jadwal-praktik*'),
                'icon' => 'ni ni-calendar-grid-58',
                'color' => '#f97316',
            ],
            [
                'title' => 'Booking & Antrian',
                'url' => route('admin.backoffice.booking-antrian.index'),
                'active' => request()->is('admin/backoffice/booking-antrian*'),
                'icon' => 'ni ni-bullet-list-67',
                'color' => '#06b6d4',
            ],
           [
                'title' => 'Pembayaran',
                'url' => route('admin.backoffice.pembayaran.index'),
                'active' => request()->is('admin/backoffice/pembayaran*'),
                'icon' => 'ni ni-credit-card',
                'color' => '#22c55e',
            ],
            [
                'title' => 'Management User',
                'url' => route('admin.backoffice.users.index'),
                'active' => request()->is('admin/backoffice/users*'),
                'icon' => 'ni ni-single-02',
                'color' => '#2563eb',
            ],
            [
                'title' => 'Role Permission',
                'url' => route('admin.backoffice.roles.index'),
                'active' => request()->is('admin/backoffice/roles*') || request()->is('admin/backoffice/permissions*'),
                'icon' => 'ni ni-settings',
                'color' => '#7c3aed',
            ],
            [
                'title' => 'Pengaturan Sistem',
                'url' => '#',
                'active' => request()->is('admin/backoffice/settings*'),
                'icon' => 'ni ni-settings-gear-65',
                'color' => '#64748b',
            ],
        ];
    }

    if ($role === 'pasien') {
        $menus = [
            [
                'title' => 'Dashboard',
                'url' => route('pasien.dashboard'),
                'active' => request()->is('admin/backoffice/dashboard*'),
                'icon' => 'ni ni-tv-2',
                'color' => '#0ea5e9',
            ],
            [
                'title' => 'Jadwal Konsultasi',
                'url' => route('pasien.jadwal-konsultasi.index'),
                'active' => request()->is('pasien/jadwal-konsultasi*'),
                'icon' => 'ni ni-calendar-grid-58',
                'color' => '#4f46e5',
            ],
            [
                'title' => 'Riwayat Booking',
                'url' => route('pasien.jadwal-konsultasi.riwayat'),
                'active' => request()->is('pasien/riwayat-booking*'),
                'icon' => 'ni ni-bullet-list-67',
                'color' => '#06b6d4',
            ],
            [
                'title' => 'Rekam Medis',
                'url' => route('pasien.rekam-medis.index'),
                'active' => request()->is('pasien/rekam-medis*'),
                'icon' => 'ni ni-briefcase-24',
                'color' => '#10b981',
            ],
            [
                'title' => 'Pembayaran',
                'url' => route('pasien.pembayaran.index'),
                'active' => request()->is('pasien/pembayaran*'),
                'icon' => 'ni ni-credit-card',
                'color' => '#22c55e',
            ],
        ];
    }

    if ($role === 'tenaga_medis') {
        $menus = [
            [
                'title' => 'Dashboard',
                'url' => route('tenaga-medis.dashboard'),
                'active' => request()->is('tenaga-medis/dashboard*'),
                'icon' => 'ni ni-tv-2',
                'color' => '#0ea5e9',
            ],
            [
                'title' => 'Antrean Pasien',
                'url' => '#',
                'active' => request()->is('tenaga-medis/antrian*'),
                'icon' => 'ni ni-bullet-list-67',
                'color' => '#06b6d4',
            ],
            [
                'title' => 'Rekam Medis',
                'url' => route('tenaga-medis.rekam-medis.index'),
                'active' => request()->is('tenaga-medis/rekam-medis*'),
                'icon' => 'ni ni-briefcase-24',
                'color' => '#10b981',
            ],
        ];
    }

    if ($role === 'pimpinan') {
        $menus = [
            [
                'title' => 'Dashboard',
                'url' => route('pimpinan.dashboard'),
                'active' => request()->is('pimpinan/dashboard*'),
                'icon' => 'ni ni-tv-2',
                'color' => '#0ea5e9',
            ],
            [
                'title' => 'Laporan Klinik',
                'url' => '#',
                'active' => request()->is('pimpinan/laporan*'),
                'icon' => 'ni ni-chart-bar-32',
                'color' => '#6366f1',
            ],
        ];
    }
@endphp

<aside class="clinic-sidebar">
    <div class="clinic-sidebar-brand">
        <div class="clinic-logo-box">
            <img src="{{ asset('admin/assets/img/logo.png') }}" alt="Logo" class="clinic-logo-img">
        </div>
        <div>
            <h6>Klinik Harapan</h6>
            <p>Ibu dan Anak</p>
        </div>
    </div>

    <div class="clinic-sidebar-menu">
        @foreach ($menus as $menu)
            <a href="{{ $menu['url'] }}"
               class="clinic-menu-item {{ $menu['active'] ? 'active' : '' }}">
                <span class="clinic-menu-icon" style="color: {{ $menu['color'] }}">
                    <i class="{{ $menu['icon'] }}"></i>
                </span>
                <span>{{ $menu['title'] }}</span>
            </a>
        @endforeach
    </div>

    <div class="clinic-sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="clinic-menu-item logout-btn">
                <span class="clinic-menu-icon" style="color:#ef4444;">
                    <i class="ni ni-user-run"></i>
                </span>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>

<style>
    .clinic-sidebar {
        position: fixed;
        top: 24px;
        left: 24px;
        bottom: 24px;
        width: 265px;
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
        z-index: 50;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .clinic-sidebar-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 26px 28px 20px;
    }

    .clinic-logo-box {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .clinic-logo-img {
        width: 36px;
        height: 36px;
        object-fit: contain;
    }

    .clinic-sidebar-brand h6 {
        margin: 0;
        font-size: 17px;
        font-weight: 800;
        color: #475569;
        line-height: 1.2;
    }

    .clinic-sidebar-brand p {
        margin: 2px 0 0;
        font-size: 13px;
        color: #64748b;
    }

    .clinic-sidebar-menu {
        padding: 38px 16px 16px;
        flex: 1;
        overflow-y: auto;
    }

    .clinic-menu-item {
        display: flex;
        align-items: center;
        gap: 14px;
        width: 100%;
        padding: 13px 14px;
        margin-bottom: 12px;
        border-radius: 14px;
        text-decoration: none;
        border: none;
        background: transparent;
        color: #64748b;
        font-size: 15px;
        font-weight: 800;
        transition: all .2s ease;
        cursor: pointer;
    }

    .clinic-menu-item:hover {
        background: #f1f5f9;
        color: #1e293b;
    }

    .clinic-menu-item.active {
        background: #0d99ff;
        color: #ffffff;
        box-shadow: 0 12px 24px rgba(13, 153, 255, 0.3);
    }

    .clinic-menu-icon {
        width: 36px;
        height: 36px;
        min-width: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        border-radius: 11px;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.08);
        font-size: 15px;
    }

    .clinic-menu-item.active .clinic-menu-icon {
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.18);
        box-shadow: none;
    }

    .clinic-sidebar-footer {
        padding: 16px;
    }

    .logout-btn {
        font-family: inherit;
    }

    @media (max-width: 1199px) {
        .clinic-sidebar {
            position: relative;
            top: auto;
            left: auto;
            bottom: auto;
            width: auto;
            margin: 16px;
        }
    }
</style>