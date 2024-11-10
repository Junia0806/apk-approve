<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataPresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh data presensi dengan status hadir atau tidak hadir
        $presensis = [
            ['id_dosen' => 1, 'tgl_presensi' => Carbon::parse('2024-11-10'), 'hari' => 'Senin', 'status' => true],
            ['id_dosen' => 2, 'tgl_presensi' => Carbon::parse('2024-11-10'), 'hari' => 'Senin', 'status' => false],
            ['id_dosen' => 3, 'tgl_presensi' => Carbon::parse('2024-11-11'), 'hari' => 'Selasa', 'status' => true],
            ['id_dosen' => 4, 'tgl_presensi' => Carbon::parse('2024-11-12'), 'hari' => 'Rabu', 'status' => true],
            ['id_dosen' => 5, 'tgl_presensi' => Carbon::parse('2024-11-13'), 'hari' => 'Kamis', 'status' => false],
            ['id_dosen' => 1, 'tgl_presensi' => Carbon::parse('2024-11-14'), 'hari' => 'Jumat', 'status' => true],
            ['id_dosen' => 2, 'tgl_presensi' => Carbon::parse('2024-11-14'), 'hari' => 'Jumat', 'status' => true],
            ['id_dosen' => 3, 'tgl_presensi' => Carbon::parse('2024-11-15'), 'hari' => 'Sabtu', 'status' => true],
            ['id_dosen' => 4, 'tgl_presensi' => Carbon::parse('2024-11-16'), 'hari' => 'Minggu', 'status' => false],
            ['id_dosen' => 5, 'tgl_presensi' => Carbon::parse('2024-11-16'), 'hari' => 'Minggu', 'status' => true],
        ];

        // Insert data ke dalam tabel data_presensis
        foreach ($presensis as $presensi) {
            DB::table('data_presensis')->insert([
                'id_dosen' => $presensi['id_dosen'],
                'tgl_presensi' => $presensi['tgl_presensi'],
                'hari' => $presensi['hari'],
                'status' => $presensi['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
