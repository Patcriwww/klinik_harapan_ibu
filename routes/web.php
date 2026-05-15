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



Auth::routes();

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('admin.backoffice.dashboard')
        : redirect()->route('login');
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
            ->name('dashboard')
            ->middleware('permission:dashboard.view');

        Route::resource('users', UserManagementController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        
        Route::post('roles/{role}/permissions', [RoleController::class, 'syncPermissions'])
            ->name('roles.sync-permissions');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');


        Route::resource('layanan', LayananController::class);
        Route::resource('tenaga-medis', TenagaMedisController::class);
        Route::resource('jadwal-praktik', JadwalPraktikController::class);
        Route::get('booking-antrian', [BookingAntrianController::class, 'index'])
            ->name('booking-antrian.index');

        Route::patch('booking-antrian/{booking}/status', [BookingAntrianController::class, 'updateStatus'])
            ->name('booking-antrian.update-status');
    });

    Route::middleware(['auth'])
    ->prefix('pasien')
    ->name('pasien.')
    ->group(function () {
        Route::get('/jadwal-konsultasi', [JadwalKonsultasiController::class, 'index'])
            ->name('jadwal-konsultasi.index');

        Route::post('/jadwal-konsultasi/booking', [JadwalKonsultasiController::class, 'store'])
            ->name('jadwal-konsultasi.store');

        Route::get('/riwayat-booking', [JadwalKonsultasiController::class, 'riwayat'])
            ->name('jadwal-konsultasi.riwayat');
    });