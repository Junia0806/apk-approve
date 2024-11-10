<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert data ke dalam tabel data_prodis
        DB::table('data_prodis')->insert([
            // Program studi untuk Kampus 1
            [
                'id_prodi' => 1,
                'id_kampus' => 1,
                'kd_prodi' => 'PROD001',
                'prodi' => 'Teknik Informatika',
                'jurusan' => 'Teknik',
                'kampus' => 'Universitas ABC',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_prodi' => 2,
                'id_kampus' => 1,
                'kd_prodi' => 'PROD002',
                'prodi' => 'Sistem Informasi',
                'jurusan' => 'Teknik',
                'kampus' => 'Universitas ABC',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_prodi' => 3,
                'id_kampus' => 1,
                'kd_prodi' => 'PROD003',
                'prodi' => 'Teknik Sipil',
                'jurusan' => 'Teknik',
                'kampus' => 'Universitas ABC',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Program studi untuk Kampus 2
            [
                'id_prodi' => 4,
                'id_kampus' => 2,
                'kd_prodi' => 'PROD004',
                'prodi' => 'Teknik Elektro',
                'jurusan' => 'Teknik',
                'kampus' => 'Institut Teknologi XYZ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_prodi' => 5,
                'id_kampus' => 2,
                'kd_prodi' => 'PROD005',
                'prodi' => 'Arsitektur',
                'jurusan' => 'Teknik',
                'kampus' => 'Institut Teknologi XYZ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_prodi' => 6,
                'id_kampus' => 2,
                'kd_prodi' => 'PROD006',
                'prodi' => 'Perencanaan Wilayah dan Kota',
                'jurusan' => 'Teknik',
                'kampus' => 'Institut Teknologi XYZ',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Program studi untuk Kampus 3
            [
                'id_prodi' => 7,
                'id_kampus' => 3,
                'kd_prodi' => 'PROD007',
                'prodi' => 'Manajemen Bisnis',
                'jurusan' => 'Ekonomi',
                'kampus' => 'Politeknik DEF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_prodi' => 8,
                'id_kampus' => 3,
                'kd_prodi' => 'PROD008',
                'prodi' => 'Akuntansi',
                'jurusan' => 'Ekonomi',
                'kampus' => 'Politeknik DEF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_prodi' => 9,
                'id_kampus' => 3,
                'kd_prodi' => 'PROD009',
                'prodi' => 'Pariwisata',
                'jurusan' => 'Pariwisata',
                'kampus' => 'Politeknik DEF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
