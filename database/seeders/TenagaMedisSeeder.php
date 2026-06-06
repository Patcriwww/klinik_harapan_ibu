<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TenagaMedis;

class TenagaMedisSeeder extends Seeder
{
    public function run()
    {
        $data = [

            [
                'nama' => 'Dr. Hana Wijaya',
                'spesialis' => 'Dokter Anak',
                'email' => 'hana@klinikkharapanibu.com',
                'no_hp' => '081211111111',
                'sip' => 'SIP-001-2026',
                'is_active' => 1,
                'foto' => null,
            ],

            [
                'nama' => 'Dr. Yogi Pratama',
                'spesialis' => 'Dokter Umum',
                'email' => 'yogi@klinikkharapanibu.com',
                'no_hp' => '081222222222',
                'sip' => 'SIP-002-2026',
                'is_active' => 1,
                'foto' => null,
            ],

            [
                'nama' => 'Dr. Putri Amalia',
                'spesialis' => 'Dokter Umum',
                'email' => 'putri@klinikkharapanibu.com',
                'no_hp' => '081233333333',
                'sip' => 'SIP-003-2026',
                'is_active' => 1,
                'foto' => null,
            ],

            [
                'nama' => 'Dr. Rizky Maulana',
                'spesialis' => 'Dokter Gigi',
                'email' => 'rizky@klinikkharapanibu.com',
                'no_hp' => '081244444444',
                'sip' => 'SIP-004-2026',
                'is_active' => 1,
                'foto' => null,
            ],

            [
                'nama' => 'Dr. Amanda Lestari',
                'spesialis' => 'Dokter Kandungan',
                'email' => 'amanda@klinikkharapanibu.com',
                'no_hp' => '081255555555',
                'sip' => 'SIP-005-2026',
                'is_active' => 1,
                'foto' => null,
            ],

            [
                'nama' => 'Bidan Indah Lestari',
                'spesialis' => 'Bidan',
                'email' => 'indah@klinikkharapanibu.com',
                'no_hp' => '081266666666',
                'sip' => 'BIDAN-001-2026',
                'is_active' => 1,
                'foto' => null,
            ],

            [
                'nama' => 'Bidan Sarah Putri',
                'spesialis' => 'Bidan',
                'email' => 'sarah@klinikkharapanibu.com',
                'no_hp' => '081277777777',
                'sip' => 'BIDAN-002-2026',
                'is_active' => 1,
                'foto' => null,
            ],

            [
                'nama' => 'Perawat Dian Kusuma',
                'spesialis' => 'Perawat',
                'email' => 'dian@klinikkharapanibu.com',
                'no_hp' => '081288888888',
                'sip' => 'PRWT-001-2026',
                'is_active' => 1,
                'foto' => null,
            ],

            [
                'nama' => 'Perawat Rina Sari',
                'spesialis' => 'Perawat',
                'email' => 'rina@klinikkharapanibu.com',
                'no_hp' => '081299999999',
                'sip' => 'PRWT-002-2026',
                'is_active' => 1,
                'foto' => null,
            ],

            [
                'nama' => 'Apoteker Andi Saputra',
                'spesialis' => 'Apoteker',
                'email' => 'andi@klinikkharapanibu.com',
                'no_hp' => '081200000000',
                'sip' => 'APT-001-2026',
                'is_active' => 1,
                'foto' => null,
            ],

        ];

        foreach ($data as $item) {
            TenagaMedis::create($item);
        }
    }
}