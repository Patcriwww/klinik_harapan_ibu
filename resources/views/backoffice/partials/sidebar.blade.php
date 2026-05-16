@php
    $user = auth()->user();

    $role = null;

    if ($user) {
        if ($user->hasRole('admin')) {
            $role = 'admin';
        } elseif ($user->hasRole('pasien')) {
            $role = 'pasien';
        } elseif ($user->hasRole('dokter')) {
            $role = 'dokter';
        } elseif ($user->hasRole('pimpinan')) {
            $role = 'pimpinan';
        }
    }

    $menusByRole = [
        'admin' => [
            [
                'title' => 'Dashboard',
                'url' => url('/admin/backoffice/dashboard'),
                'active' => request()->is('admin/backoffice/dashboard'),
                'icon' => 'ni ni-tv-2',
                'color' => '#0093ff',
                'permission' => 'dashboard.view',
            ],
            [
                'title' => 'Data Pasien',
                'url' => url('/admin/backoffice/pasien'),
                'active' => request()->is('admin/backoffice/pasien*'),
                'icon' => 'ni ni-single-02',
                'color' => '#10b981',
                'permission' => 'pasien.view',
            ],
            [
                'title' => 'Data Tenaga Medis',
                'url' => route('admin.backoffice.tenaga-medis.index'),
                'active' => request()->is('admin/backoffice/tenaga-medis*'),
                'icon' => 'ni ni-badge',
                'color' => '#4f46e5',
                'permission' => 'dokter.view',
            ],
            [
                'title' => 'Data Layanan',
                'url' => route('admin.backoffice.layanan.index'),
                'active' => request()->is('admin/backoffice/layanan*'),
                'icon' => 'ni ni-fat-add',
                'color' => '#ef4444',
                'permission' => 'layanan.view',
            ],
            
            [
                'title' => 'Jadwal Praktik',
                'url' => route('admin.backoffice.jadwal-praktik.index'),
                'active' => request()->is('admin/backoffice/jadwal-praktik*'),
                'icon' => 'ni ni-calendar-grid-58',
                'color' => '#f97316',
                'permission' => 'jadwal.view',
            ],
            [
                'title' => 'Booking & Antrian',
                'url' => route('admin.backoffice.booking-antrian.index'),
                'active' => request()->is('admin/backoffice/booking-antrian*'),
                'icon' => 'ni ni-bullet-list-67',
                'color' => '#06b6d4',
                'permission' => 'booking.view',
            ],
            [
                'title' => 'Pembayaran',
                'url' => url('/admin/backoffice/pembayaran'),
                'active' => request()->is('admin/backoffice/pembayaran*'),
                'icon' => 'ni ni-credit-card',
                'color' => '#22c55e',
                'permission' => 'pembayaran.view',
            ],
            [
                'title' => 'Management User',
                'url' => route('admin.backoffice.users.index'),
                'active' => request()->is('admin/backoffice/users*'),
                'icon' => 'ni ni-single-02',
                'color' => '#2563eb',
                'permission' => 'users.view',
            ],
            [
                'title' => 'Role Permission',
                'url' => route('admin.backoffice.roles.index'),
                'active' => request()->is('admin/backoffice/roles*') || request()->is('admin/backoffice/permissions*'),
                'icon' => 'ni ni-badge',
                'color' => '#7c3aed',
                'permission' => 'roles.view',
            ],
            [
                'title' => 'Permission',
                'url' => route('admin.backoffice.permissions.index'),
                'active' => request()->is('admin/backoffice/permissions*'),
                'icon' => 'ni ni-lock-circle-open',
                'color' => '#dc2626',
                'permission' => 'roles.view',
            ],
            [
                'title' => 'Pengaturan Sistem',
                'url' => url('/admin/backoffice/pengaturan'),
                'active' => request()->is('admin/backoffice/pengaturan*'),
                'icon' => 'ni ni-settings-gear-65',
                'color' => '#64748b',
                'permission' => 'settings.view',
            ],
        ],

        'pasien' => [
            [
                'title' => 'Dashboard',
                'url' => url('/pasien/dashboard'),
                'active' => request()->is('pasien/dashboard'),
                'icon' => 'ni ni-tv-2',
                'color' => '#0093ff',
                'permission' => 'dashboard.view',
            ],
            [
                'title' => 'Jadwal Konsultasi',
                'url' => route('pasien.jadwal-konsultasi.index'),
                'active' => request()->is('pasien/jadwal-konsultasi*'),
                'icon' => 'ni ni-calendar-grid-58',
                'color' => '#4f46e5',
                'permission' => 'jadwal.view',
            ],
            [
                'title' => 'Rekam Medis',
                'url' => url('/pasien/rekam-medis'),
                'active' => request()->is('pasien/rekam-medis*'),
                'icon' => 'ni ni-briefcase-24',
                'color' => '#10b981',
                'permission' => 'rekam-medis.view',
            ],
            [
                'title' => 'Catatan Pertumbuhan',
                'url' => url('/pasien/catatan-pertumbuhan'),
                'active' => request()->is('pasien/catatan-pertumbuhan*'),
                'icon' => 'ni ni-chart-bar-32',
                'color' => '#f97316',
                'permission' => 'rekam-medis.view',
            ],
            [
                'title' => 'Layanan Klinik',
                'url' => url('/pasien/layanan'),
                'active' => request()->is('pasien/layanan*'),
                'icon' => 'ni ni-fat-add',
                'color' => '#ef4444',
                'permission' => 'layanan.view',
            ],
            [
                'title' => 'Pembayaran',
                'url' => url('/pasien/pembayaran'),
                'active' => request()->is('pasien/pembayaran*'),
                'icon' => 'ni ni-credit-card',
                'color' => '#22c55e',
                'permission' => 'pembayaran.view',
            ],
            [
                'title' => 'Pengaturan Akun',
                'url' => url('/pasien/pengaturan'),
                'active' => request()->is('pasien/pengaturan*'),
                'icon' => 'ni ni-settings-gear-65',
                'color' => '#64748b',
                'permission' => 'settings.view',
            ],
        ],

        'dokter' => [
            [
                'title' => 'Dashboard',
                'url' => url('/tenaga-medis/dashboard'),
                'active' => request()->is('tenaga-medis/dashboard'),
                'icon' => 'ni ni-tv-2',
                'color' => '#0093ff',
                'permission' => 'dashboard.view',
            ],
            [
                'title' => 'Antrian Pasien',
                'url' => url('/tenaga-medis/antrian'),
                'active' => request()->is('tenaga-medis/antrian*'),
                'icon' => 'ni ni-bullet-list-67',
                'color' => '#06b6d4',
                'permission' => 'antrian.view',
            ],
            [
                'title' => 'Jadwal Praktik',
                'url' => url('/tenaga-medis/jadwal'),
                'active' => request()->is('tenaga-medis/jadwal*'),
                'icon' => 'ni ni-calendar-grid-58',
                'color' => '#f97316',
                'permission' => 'jadwal.view',
            ],
            [
                'title' => 'Rekam Medis',
                'url' => url('/tenaga-medis/rekam-medis'),
                'active' => request()->is('tenaga-medis/rekam-medis*'),
                'icon' => 'ni ni-briefcase-24',
                'color' => '#10b981',
                'permission' => 'rekam-medis.view',
            ],
            [
                'title' => 'Resep Obat',
                'url' => url('/tenaga-medis/resep'),
                'active' => request()->is('tenaga-medis/resep*'),
                'icon' => 'ni ni-collection',
                'color' => '#8b5cf6',
                'permission' => 'resep.view',
            ],
            [
                'title' => 'Hasil Laboratorium',
                'url' => url('/tenaga-medis/hasil-lab'),
                'active' => request()->is('tenaga-medis/hasil-lab*'),
                'icon' => 'ni ni-atom',
                'color' => '#14b8a6',
                'permission' => 'rekam-medis.view',
            ],
            [
                'title' => 'Profil Tenaga Medis',
                'url' => url('/tenaga-medis/profil'),
                'active' => request()->is('tenaga-medis/profil*'),
                'icon' => 'ni ni-badge',
                'color' => '#64748b',
                'permission' => 'dashboard.view',
            ],
        ],

        'pimpinan' => [
            [
                'title' => 'Dashboard',
                'url' => url('/pimpinan/dashboard'),
                'active' => request()->is('pimpinan/dashboard'),
                'icon' => 'ni ni-tv-2',
                'color' => '#0093ff',
                'permission' => 'dashboard.view',
            ],
            [
                'title' => 'Laporan Tahunan',
                'url' => url('/pimpinan/laporan-tahunan'),
                'active' => request()->is('pimpinan/laporan-tahunan*'),
                'icon' => 'ni ni-chart-pie-35',
                'color' => '#4f46e5',
                'permission' => 'laporan.view',
            ],
            [
                'title' => 'Statistik Operasional',
                'url' => url('/pimpinan/statistik'),
                'active' => request()->is('pimpinan/statistik*'),
                'icon' => 'ni ni-chart-bar-32',
                'color' => '#f97316',
                'permission' => 'statistik.view',
            ],
            [
                'title' => 'Data Pasien',
                'url' => url('/pimpinan/pasien'),
                'active' => request()->is('pimpinan/pasien*'),
                'icon' => 'ni ni-single-02',
                'color' => '#10b981',
                'permission' => 'pasien.view',
            ],
            [
                'title' => 'Data Tenaga Medis',
                'url' => url('/pimpinan/tenaga-medis'),
                'active' => request()->is('pimpinan/tenaga-medis*'),
                'icon' => 'ni ni-badge',
                'color' => '#06b6d4',
                'permission' => 'dokter.view',
            ],
            [
                'title' => 'Laporan Keuangan',
                'url' => url('/pimpinan/laporan-keuangan'),
                'active' => request()->is('pimpinan/laporan-keuangan*'),
                'icon' => 'ni ni-money-coins',
                'color' => '#22c55e',
                'permission' => 'pembayaran.view',
            ],
            [
                'title' => 'Profil Pimpinan',
                'url' => url('/pimpinan/profil'),
                'active' => request()->is('pimpinan/profil*'),
                'icon' => 'ni ni-circle-08',
                'color' => '#64748b',
                'permission' => 'dashboard.view',
            ],
        ],
    ];

    $menus = $menusByRole[$role] ?? [];
@endphp

<style>
    .clinic-sidebar-menu {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        padding: 12px 14px !important;
        border-radius: 14px !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        color: #64748b !important;
        transition: all .2s ease-in-out !important;
        margin-bottom: 8px !important;
    }

    .clinic-sidebar-menu:hover {
        background: #eff6ff !important;
        color: #0093ff !important;
    }

    .clinic-sidebar-menu.active {
        background: #0093ff !important;
        color: #ffffff !important;
        box-shadow: 0 8px 18px rgba(37, 99, 235, .25) !important;
    }

    .clinic-sidebar-icon {
        width: 34px !important;
        height: 34px !important;
        min-width: 34px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 10px !important;
        background: #ffffff !important;
        box-shadow: 0 4px 10px rgba(15, 23, 42, .10) !important;
    }

    .clinic-sidebar-menu.active .clinic-sidebar-icon {
        background: rgba(255,255,255,.22) !important;
        color: #ffffff !important;
        box-shadow: none !important;
    }

    .clinic-sidebar-title {
        display: block !important;
        color: inherit !important;
        line-height: 1.25 !important;
        white-space: normal !important;
    }

    /* Wrapper header sidebar */
    .clinic-sidebar-header {
        padding: 20px 16px 16px 16px; /* kasih napas atas */
        margin-bottom: 10px;
    }

    /* Container logo + text */
    .clinic-sidebar-brand {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Logo */
    .clinic-sidebar-logo {
        width: 40px;
        height: 40px;
        object-fit: contain;
    }

    /* Text */
    .clinic-sidebar-title {
        font-weight: 700;
        font-size: 15px;
        color: #2d3748;
        line-height: 1.2;
    }

    .clinic-sidebar-subtitle {
        font-size: 12px;
        color: #6b7280;
    }
</style>

<aside class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 bg-white border-0 shadow-xl max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0" aria-expanded="false">

  <div class="clinic-sidebar-header">
    <div class="clinic-sidebar-brand">
        <img src="{{ asset('admin/assets/img/logo.png') }}" class="clinic-sidebar-logo">

        <div>
            <div class="clinic-sidebar-title">Klinik Harapan</div>
            <div class="clinic-sidebar-subtitle">Ibu dan Anak</div>
        </div>
    </div>
</div>
</a>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/20 to-transparent" />

    <div class="items-center block w-auto overflow-y-auto" style="max-height: calc(100vh - 120px);">
        <ul class="flex flex-col px-4 mt-4 mb-0">

            @foreach ($menus as $menu)
                @can($menu['permission'])
                    <li class="w-full">
                        <a href="{{ $menu['url'] }}"
                           class="clinic-sidebar-menu {{ $menu['active'] ? 'active' : '' }}">

                            <div class="clinic-sidebar-icon"
                                 style="{{ !$menu['active'] ? 'color: '.$menu['color'].';' : '' }}">
                                <i class="{{ $menu['icon'] }} text-sm"></i>
                            </div>

                            <span class="clinic-sidebar-title">
                                {{ $menu['title'] }}
                            </span>
                        </a>
                    </li>
                @endcan
            @endforeach

            <li class="w-full mt-4">
                <a href="#"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="clinic-sidebar-menu hover:text-red-500">
                    <div class="clinic-sidebar-icon" style="color:#ef4444;">
                        <i class="ni ni-user-run text-sm"></i>
                    </div>
                    <span class="clinic-sidebar-title">Logout</span>
                </a>
            </li>

        </ul>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</aside>
