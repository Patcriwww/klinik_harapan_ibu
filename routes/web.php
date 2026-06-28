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
            Route::get('/rekam-medis/{rekamMedis}', [RekamMedisController::class, 'show'])
                    ->name('rekam-medis.show');

                Route::get('/rekam-medis/{rekamMedis}/edit', [RekamMedisController::class, 'edit'])
                    ->name('rekam-medis.edit');

                Route::put('/rekam-medis/{rekamMedis}', [RekamMedisController::class, 'update'])
                    ->name('rekam-medis.update');
    
            });

    Route::middleware(['auth'])
    ->prefix('pimpinan')
    ->name('pimpinan.')
    ->group(function () {
        Route::get('/dashboard', [DashboardPimpinanController::class, 'index'])
            ->name('dashboard');
    });