<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalPraktik;
use App\Models\TenagaMedis;

class JadwalPraktikSeeder extends Seeder
{
    public function run()
    {
        JadwalPraktik::truncate();

        $dokters = TenagaMedis::all();

        foreach ($dokters as $dokter) {

            switch ($dokter->spesialis) {

                case 'Dokter Anak':

                    $hari = [
                        'Senin',
                        'Rabu',
                        'Jumat'
                    ];

                    foreach ($hari as $item) {
                        JadwalPraktik::create([
                            'tenaga_medis_id' => $dokter->id,
                            'hari' => $item,
                            'jam_mulai' => '08:00:00',
                            'jam_selesai' => '12:00:00',
                            'kuota' => 20,
                            'is_active' => true,
                        ]);
                    }

                    break;

                case 'Dokter Umum':

                    $hari = [
                        'Senin',
                        'Selasa',
                        'Rabu',
                        'Kamis',
                        'Jumat'
                    ];

                    foreach ($hari as $item) {
                        JadwalPraktik::create([
                            'tenaga_medis_id' => $dokter->id,
                            'hari' => $item,
                            'jam_mulai' => '08:00:00',
                            'jam_selesai' => '17:00:00',
                            'kuota' => 30,
                            'is_active' => true,
                        ]);
                    }

                    break;

                case 'Dokter Gigi':

                    $hari = [
                        'Selasa',
                        'Kamis',
                        'Sabtu'
                    ];

                    foreach ($hari as $item) {
                        JadwalPraktik::create([
                            'tenaga_medis_id' => $dokter->id,
                            'hari' => $item,
                            'jam_mulai' => '09:00:00',
                            'jam_selesai' => '15:00:00',
                            'kuota' => 15,
                            'is_active' => true,
                        ]);
                    }

                    break;

                case 'Dokter Kandungan':

                    $hari = [
                        'Senin',
                        'Rabu',
                        'Jumat'
                    ];

                    foreach ($hari as $item) {
                        JadwalPraktik::create([
                            'tenaga_medis_id' => $dokter->id,
                            'hari' => $item,
                            'jam_mulai' => '13:00:00',
                            'jam_selesai' => '17:00:00',
                            'kuota' => 10,
                            'is_active' => true,
                        ]);
                    }

                    break;

                case 'Bidan':

                    $hari = [
                        'Senin',
                        'Selasa',
                        'Rabu',
                        'Kamis',
                        'Jumat',
                        'Sabtu'
                    ];

                    foreach ($hari as $item) {
                        JadwalPraktik::create([
                            'tenaga_medis_id' => $dokter->id,
                            'hari' => $item,
                            'jam_mulai' => '08:00:00',
                            'jam_selesai' => '14:00:00',
                            'kuota' => 25,
                            'is_active' => true,
                        ]);
                    }

                    break;

                default:

                    $hari = [
                        'Senin',
                        'Selasa',
                        'Rabu',
                        'Kamis',
                        'Jumat'
                    ];

                    foreach ($hari as $item) {
                        JadwalPraktik::create([
                            'tenaga_medis_id' => $dokter->id,
                            'hari' => $item,
                            'jam_mulai' => '08:00:00',
                            'jam_selesai' => '16:00:00',
                            'kuota' => 20,
                            'is_active' => true,
                        ]);
                    }

                    break;
            }
        }
    }
}