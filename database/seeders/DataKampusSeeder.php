<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataKampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert empat data ke dalam tabel data_kampuses
        DB::table('data_kampuses')->insert([
            [
                'kd_kampus' => 'KMP001',
                'nama_kampus' => 'Universitas ABC',
                'alamat' => 'Jl. Pendidikan No. 123, Kota ABC',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kd_kampus' => 'KMP002',
                'nama_kampus' => 'Institut Teknologi XYZ',
                'alamat' => 'Jl. Sains No. 45, Kota XYZ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kd_kampus' => 'KMP003',
                'nama_kampus' => 'Politeknik DEF',
                'alamat' => 'Jl. Politeknik No. 67, Kota DEF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kd_kampus' => 'KMP004',
                'nama_kampus' => 'Akademi GHI',
                'alamat' => 'Jl. Akademi No. 89, Kota GHI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
