<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );

        $admin->assignRole('admin');

        $dokter = User::firstOrCreate(
            ['email' => 'hana@klinikkharapanibu.com'],
            [
                'name' => 'Dr. Hana Wijaya',
                'password' => Hash::make('password'),
            ]
        );

        $dokter->assignRole('dokter');

        $pimpinan = User::firstOrCreate(
            ['email' => 'pimpinan@klinikkharapanibu.com'],
            [
                'name' => 'Pimpinan Klinik',
                'password' => Hash::make('password'),
            ]
        );

        $pimpinan->assignRole('pimpinan');
    }
}