<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataMatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert data ke dalam tabel data_matkuls
        DB::table('data_matkuls')->insert([
            [
                'kd_matkul' => 'TI101',
                'matkul' => 'Pengantar Teknologi Informasi',
                'sks' => 3,
                'semester' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kd_matkul' => 'TI102',
                'matkul' => 'Dasar Pemrograman',
                'sks' => 4,
                'semester' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kd_matkul' => 'TI103',
                'matkul' => 'Matematika Diskrit',
                'sks' => 3,
                'semester' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kd_matkul' => 'TI201',
                'matkul' => 'Struktur Data',
                'sks' => 4,
                'semester' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kd_matkul' => 'TI202',
                'matkul' => 'Sistem Operasi',
                'sks' => 3,
                'semester' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kd_matkul' => 'TI203',
                'matkul' => 'Algoritma dan Pemrograman Lanjutan',
                'sks' => 4,
                'semester' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kd_matkul' => 'TI301',
                'matkul' => 'Basis Data',
                'sks' => 3,
                'semester' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kd_matkul' => 'TI302',
                'matkul' => 'Jaringan Komputer',
                'sks' => 4,
                'semester' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kd_matkul' => 'TI303',
                'matkul' => 'Rekayasa Perangkat Lunak',
                'sks' => 3,
                'semester' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kd_matkul' => 'TI401',
                'matkul' => 'Pemrograman Web',
                'sks' => 4,
                'semester' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kd_matkul' => 'TI402',
                'matkul' => 'Keamanan Informasi',
                'sks' => 3,
                'semester' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kd_matkul' => 'TI403',
                'matkul' => 'Analisis dan Desain Sistem',
                'sks' => 3,
                'semester' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kd_matkul' => 'TI501',
                'matkul' => 'Kecerdasan Buatan',
                'sks' => 3,
                'semester' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kd_matkul' => 'TI502',
                'matkul' => 'Pemrograman Mobile',
                'sks' => 3,
                'semester' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kd_matkul' => 'TI503',
                'matkul' => 'Cloud Computing',
                'sks' => 3,
                'semester' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
