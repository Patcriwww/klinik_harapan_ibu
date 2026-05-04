<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // Dashboard
            'dashboard.view',

            // Jadwal Konsultasi
            'jadwal.view',
            'jadwal.create',
            'jadwal.edit',
            'jadwal.delete',

            // Booking
            'booking.view',
            'booking.create',
            'booking.confirm',
            'booking.cancel',

            // Antrian
            'antrian.view',
            'antrian.update',

            // Rekam Medis
            'rekam-medis.view',
            'rekam-medis.create',
            'rekam-medis.edit',
            'rekam-medis.download',

            // Resep Obat
            'resep.view',
            'resep.create',
            'resep.edit',

            // Pembayaran
            'pembayaran.view',
            'pembayaran.create',
            'pembayaran.verify',

            // Data Pasien
            'pasien.view',
            'pasien.create',
            'pasien.edit',
            'pasien.delete',

            // Data Dokter
            'dokter.view',
            'dokter.create',
            'dokter.edit',
            'dokter.delete',

            // Layanan Klinik
            'layanan.view',
            'layanan.create',
            'layanan.edit',
            'layanan.delete',

            // Laporan Pimpinan
            'laporan.view',
            'statistik.view',

            // User Management
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',

            // Role Permission
            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',

            // Pengaturan
            'settings.view',
            'settings.edit',

            
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $pasien = Role::firstOrCreate([
            'name' => 'pasien',
            'guard_name' => 'web',
        ]);

        $dokter = Role::firstOrCreate([
            'name' => 'dokter',
            'guard_name' => 'web',
        ]);

        $pimpinan = Role::firstOrCreate([
            'name' => 'pimpinan',
            'guard_name' => 'web',
        ]);

        // Admin dapat semua akses
        $admin->syncPermissions(Permission::all());

        // Pasien
        $pasien->syncPermissions([
            'dashboard.view',
            'jadwal.view',
            'booking.view',
            'booking.create',
            'booking.cancel',
            'rekam-medis.view',
            'rekam-medis.download',
            'resep.view',
            'pembayaran.view',
            'pembayaran.create',
        ]);

        // Dokter
        $dokter->syncPermissions([
            'dashboard.view',
            'jadwal.view',
            'jadwal.create',
            'antrian.view',
            'antrian.update',
            'rekam-medis.view',
            'rekam-medis.create',
            'rekam-medis.edit',
            'resep.view',
            'resep.create',
            'resep.edit',
        ]);

        // Pimpinan
        $pimpinan->syncPermissions([
            'dashboard.view',
            'laporan.view',
            'statistik.view',
            'pasien.view',
            'dokter.view',
            'pembayaran.view',
        ]);

        // Buat user admin awal
        $user = User::firstOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
            ]
        );

        $user->assignRole('admin');
    }
}