<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backoffice\DashboardController;
use App\Http\Controllers\Backoffice\UserManagementController;
use App\Http\Controllers\Backoffice\RoleController;
use App\Http\Controllers\Backoffice\PermissionController;
use App\Http\Controllers\Backoffice\ProfileController;
use App\Http\Controllers\Auth\PatientRegisterController;



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
    });