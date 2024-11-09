<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataDosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert data ke dalam tabel data_dosens
        DB::table('data_dosens')->insert([
            [
                'id_dosen' => 1,
                'kd_dosen' => 'DOS001',
                'NIP' => '197901012005011001',
                'nama_dosen' => 'Dr. Ahmad Fadli, M.T.',
                'no_hp' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_dosen' => 2,
                'kd_dosen' => 'DOS002',
                'NIP' => '198005012006021002',
                'nama_dosen' => 'Prof. Bambang Sutrisno, M.Si.',
                'no_hp' => '082234567891',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_dosen' => 3,
                'kd_dosen' => 'DOS003',
                'NIP' => '198110032007031003',
                'nama_dosen' => 'Dr. Citra Lestari, M.Pd.',
                'no_hp' => '083234567892',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_dosen' => 4,
                'kd_dosen' => 'DOS004',
                'NIP' => '197912142008041004',
                'nama_dosen' => 'Dr. Diana Putri, M.Si.',
                'no_hp' => '084234567893',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_dosen' => 5,
                'kd_dosen' => 'DOS005',
                'NIP' => '198212152009051005',
                'nama_dosen' => 'Drs. Eko Prasetyo, M.Pd.',
                'no_hp' => '085234567894',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_dosen' => 6,
                'kd_dosen' => 'DOS006',
                'NIP' => '198303162010061006',
                'nama_dosen' => 'Dr. Fajar Santoso, M.Kom.',
                'no_hp' => '086234567895',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_dosen' => 7,
                'kd_dosen' => 'DOS007',
                'NIP' => '198404172011071007',
                'nama_dosen' => 'Prof. Gita Permata, M.Sc.',
                'no_hp' => '087234567896',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_dosen' => 8,
                'kd_dosen' => 'DOS008',
                'NIP' => '198505182012081008',
                'nama_dosen' => 'Dr. Herman Wijaya, M.E.',
                'no_hp' => '088234567897',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_dosen' => 9,
                'kd_dosen' => 'DOS009',
                'NIP' => '198606192013091009',
                'nama_dosen' => 'Dr. Irma Wati, M.Psi.',
                'no_hp' => '089234567898',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_dosen' => 10,
                'kd_dosen' => 'DOS010',
                'NIP' => '198707202014101010',
                'nama_dosen' => 'Dr. Joko Supriyono, M.T.',
                'no_hp' => '081234567899',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
