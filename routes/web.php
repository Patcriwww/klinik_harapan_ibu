<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backoffice\DashboardController;
use App\Http\Controllers\Backoffice\UserManagementController;
use App\Http\Controllers\Backoffice\RoleController;
use App\Http\Controllers\Backoffice\PermissionController;
use App\Http\Controllers\Backoffice\ProfileController;
use App\Http\Controllers\Auth\PatientRegisterController;
use App\Http\Controllers\Backoffice\LayananController;
use App\Http\Controllers\Backoffice\TenagaMedisController;
use App\Http\Controllers\Backoffice\JadwalPraktikController;
use App\Http\Controllers\Pasien\DokterController;
use App\Http\Controllers\Pasien\JadwalKonsultasiController;
use App\Http\Controllers\Backoffice\BookingAntrianController;
use App\Http\Controllers\Pasien\PembayaranController;
use App\Http\Controllers\Backoffice\PembayaranController as BackofficePembayaranController;
use App\Http\Controllers\TenagaMedis\DashboardTenagaMedisController;
use App\Http\Controllers\Pasien\RekamMedisController as PasienRekamMedisController;
use App\Http\Controllers\TenagaMedis\RekamMedisController as TenagaMedisRekamMedisController;
use App\Http\Controllers\Pimpinan\DashboardPimpinanController;
use App\Http\Controllers\Backoffice\RolePermissionController;
use App\Http\Controllers\Pasien\CatatanPertumbuhanController;
use App\Http\Controllers\Backoffice\PengaturanSistemController;
use App\Http\Controllers\Backoffice\ActivityLogController;
use App\Http\Controllers\Pasien\DokterFavoritController;
use App\Http\Controllers\Backoffice\ExportController;
use App\Http\Controllers\Backoffice\PasienController;
use App\Http\Controllers\Pimpinan\LaporanKlinikController;
use App\Http\Controllers\TenagaMedis\ResepController;
use App\Http\Controllers\TenagaMedis\HasilLabController;
use App\Http\Controllers\TenagaMedis\ProfilController as TenagaMedisProfilController;

Auth::routes();

Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $user = auth()->user();

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.backoffice.dashboard');
    }

    if ($user->hasRole('pasien')) {
        return redirect()->route('pasien.dashboard');
    }

    if ($user->hasRole('tenaga_medis')) {
        return redirect()->route('tenaga-medis.dashboard');
    }

    if ($user->hasRole('pimpinan')) {
        return redirect()->route('pimpinan.dashboard');
    }

    return redirect()->route('login');
});

Route::get('/register-pasien', [PatientRegisterController::class, 'showRegisterForm'])
    ->name('pasien.register');

Route::post('/register-pasien', [PatientRegisterController::class, 'register'])
    ->name('pasien.register.store');

    Route::middleware(['auth'])
        ->prefix('admin/backoffice')
        ->name('admin.backoffice.')
        ->group(function () {

             Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

            Route::get('pasien', [UserManagementController::class, 'pasienIndex'])
                ->name('pasien.index');

            Route::resource('users', UserManagementController::class);
            Route::resource('roles', RoleController::class);
            Route::resource('permissions', PermissionController::class);
            
            Route::post('roles/{role}/permissions', [RoleController::class, 'syncPermissions'])
                ->name('roles.sync-permissions');

            Route::get('/role-permission', [RolePermissionController::class, 'index'])
                ->name('role-permission.index');

            Route::post('/role-permission/role', [RolePermissionController::class, 'storeRole'])
                ->name('role-permission.store-role');

            Route::post('/role-permission/permission', [RolePermissionController::class, 'storePermission'])
                ->name('role-permission.store-permission');

            Route::post('/role-permission/sync', [RolePermissionController::class, 'syncPermission'])
                ->name('role-permission.sync');

            Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

            Route::resource('/pasien', PasienController::class);

            Route::resource('layanan', LayananController::class);
            Route::resource('tenaga-medis', TenagaMedisController::class);
            Route::resource('jadwal-praktik', JadwalPraktikController::class);
            Route::get('booking-antrian', [BookingAntrianController::class, 'index'])
                ->name('booking-antrian.index');

            Route::patch('booking-antrian/{booking}/status', [BookingAntrianController::class, 'updateStatus'])
                ->name('booking-antrian.update-status');
        
            Route::get('pembayaran', [BackofficePembayaranController::class, 'index'])
                ->name('pembayaran.index');

            Route::post('pembayaran/{pembayaran}/approve', [BackofficePembayaranController::class, 'approve'])
                ->name('pembayaran.approve');

            Route::post('pembayaran/{pembayaran}/reject', [BackofficePembayaranController::class, 'reject'])
                ->name('pembayaran.reject');

            Route::get('/pengaturan-sistem', [PengaturanSistemController::class, 'index'])
                ->name('pengaturan-sistem.index');

            Route::put('/pengaturan-sistem', [PengaturanSistemController::class, 'update'])
                ->name('pengaturan-sistem.update');

            Route::get('/activity-log', [ActivityLogController::class, 'index'])
               ->name('activity-log.index');


            Route::prefix('export')->name('export.')->group(function () {
            Route::get('/pasien', [ExportController::class, 'pasien'])->name('pasien');
            Route::get('/booking', [ExportController::class, 'booking'])->name('booking');
            Route::get('/pembayaran', [ExportController::class, 'pembayaran'])->name('pembayaran');
            Route::get('/rekam-medis', [ExportController::class, 'rekamMedis'])->name('rekam-medis');
});

    });

    Route::middleware(['auth'])
        ->prefix('pasien')
        ->name('pasien.')
        ->group(function () {
            Route::get('/dashboard', [\App\Http\Controllers\Pasien\DashboardPasienController::class, 'index'])
            ->name('dashboard');
            Route::get('/jadwal-konsultasi', [JadwalKonsultasiController::class, 'index'])
                ->name('jadwal-konsultasi.index');

            Route::post('/jadwal-konsultasi/booking', [JadwalKonsultasiController::class, 'store'])
                ->name('jadwal-konsultasi.store');

            Route::get('/riwayat-booking', [JadwalKonsultasiController::class, 'riwayat'])
                ->name('jadwal-konsultasi.riwayat');

            Route::get(
                '/pembayaran',
                [PembayaranController::class, 'index']
            )->name('pembayaran.index');

            Route::get(
                '/pembayaran/{id}',
                [PembayaranController::class, 'show']
            )->name('pembayaran.show');

            Route::post(
                '/pembayaran/{id}/upload',
                [PembayaranController::class, 'uploadBukti']
            )->name('pembayaran.upload');

            Route::get('/tiket-digital/{booking}', [JadwalKonsultasiController::class, 'tiket'])->name('tiket-digital.show');

            Route::get('/rekam-medis', [PasienRekamMedisController::class, 'index'])->name('rekam-medis.index');

            Route::get('/catatan-pertumbuhan', [CatatanPertumbuhanController::class, 'index']) ->name('catatan-pertumbuhan.index');

            Route::get('/dokter-favorit', [DokterFavoritController::class, 'index'])
                ->name('dokter-favorit.index');

            Route::post('/dokter-favorit/{tenagaMedis}/toggle', [DokterFavoritController::class, 'toggle'])
                ->name('dokter-favorit.toggle');

    });

    Route::middleware(['auth'])
        ->prefix('tenaga-medis')
        ->name('tenaga-medis.')
        ->group(function () {
            Route::get('/dashboard', [DashboardTenagaMedisController::class, 'index'])
                ->name('dashboard');

            Route::patch('/booking/{booking}/status', [DashboardTenagaMedisController::class, 'updateStatus'])
                ->name('booking.update-status');

            Route::get('/rekam-medis/{booking}/create', [DashboardTenagaMedisController::class, 'createRekamMedis'])
                ->name('rekam-medis.create');

            Route::post('/rekam-medis/{booking}', [DashboardTenagaMedisController::class, 'storeRekamMedis'])
                ->name('rekam-medis.store');
            Route::get('/rekam-medis', [TenagaMedisRekamMedisController::class, 'index'])->name('rekam-medis.index');
            Route::get('/rekam-medis/{rekamMedis}', [TenagaMedisRekamMedisController::class, 'show'])
                    ->name('rekam-medis.show');

            Route::get('/rekam-medis/{rekamMedis}/edit', [TenagaMedisRekamMedisController::class, 'edit'])
                ->name('rekam-medis.edit');

            Route::put('/rekam-medis/{rekamMedis}', [TenagaMedisRekamMedisController::class, 'update'])
                ->name('rekam-medis.update');
            Route::get('/rekam-medis/{rekamMedis}/pdf', [TenagaMedisRekamMedisController::class, 'downloadPdf'])
                ->name('rekam-medis.pdf');

            Route::get('/resep', [ResepController::class, 'index'])->name('resep.index');

            Route::get('/hasil-lab', [HasilLabController::class, 'index'])->name('hasil-lab.index');
            Route::get('/hasil-lab/{rekamMedis}/edit', [HasilLabController::class, 'edit'])->name('hasil-lab.edit');
            Route::put('/hasil-lab/{rekamMedis}', [HasilLabController::class, 'update'])->name('hasil-lab.update');

            Route::get('/profil', [TenagaMedisProfilController::class, 'index'])->name('profil.index');
            Route::put('/profil', [TenagaMedisProfilController::class, 'update'])->name('profil.update');
    });

    Route::middleware(['auth'])
    ->prefix('pimpinan')
    ->name('pimpinan.')
    ->group(function () {
        Route::get('/dashboard', [DashboardPimpinanController::class, 'index'])
            ->name('dashboard');
        Route::get('/laporan-klinik', [LaporanKlinikController::class, 'index'])
            ->name('laporan-klinik.index');
    });
