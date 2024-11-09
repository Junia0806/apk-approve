<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataJadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh data jadwal
        $jadwals = [
            ['id_matkul' => 1, 'id_sesi' => 1, 'id_dosen' => 1, 'hari' => 'Senin'],
            ['id_matkul' => 2, 'id_sesi' => 2, 'id_dosen' => 2, 'hari' => 'Selasa'],
            ['id_matkul' => 3, 'id_sesi' => 3, 'id_dosen' => 3, 'hari' => 'Rabu'],
            ['id_matkul' => 4, 'id_sesi' => 4, 'id_dosen' => 4, 'hari' => 'Kamis'],
            ['id_matkul' => 5, 'id_sesi' => 5, 'id_dosen' => 5, 'hari' => 'Jumat'],
            ['id_matkul' => 1, 'id_sesi' => 2, 'id_dosen' => 1, 'hari' => 'Senin'],
            ['id_matkul' => 2, 'id_sesi' => 3, 'id_dosen' => 2, 'hari' => 'Selasa'],
            ['id_matkul' => 3, 'id_sesi' => 4, 'id_dosen' => 3, 'hari' => 'Rabu'],
            ['id_matkul' => 4, 'id_sesi' => 5, 'id_dosen' => 4, 'hari' => 'Kamis'],
            ['id_matkul' => 5, 'id_sesi' => 1, 'id_dosen' => 5, 'hari' => 'Jumat'],
        ];

        // Insert data ke dalam tabel data_jadwals
        foreach ($jadwals as $jadwal) {
            DB::table('data_jadwals')->insert([
                'id_matkul' => $jadwal['id_matkul'],
                'id_sesi' => $jadwal['id_sesi'],
                'id_dosen' => $jadwal['id_dosen'],
                'hari' => $jadwal['hari'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
