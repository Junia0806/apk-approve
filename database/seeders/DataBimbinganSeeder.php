<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataBimbinganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh data bimbingan dengan nama lokal
        $bimbingans = [
            ['id_prodi' => 1, 'id_dosen' => 1, 'nim' => '18040101', 'nama' => 'Rudi Santoso', 'dosen' => 'Dr. Agus Prasetyo', 'tgl_bimbigan' => Carbon::parse('2024-11-10'), 'hari' => 'Senin', 'keperluan' => 'Konsultasi mengenai tugas besar'],
            ['id_prodi' => 1, 'id_dosen' => 2, 'nim' => '18040102', 'nama' => 'Siti Nurjanah', 'dosen' => 'Dr. Budi Santoso', 'tgl_bimbigan' => Carbon::parse('2024-11-11'), 'hari' => 'Selasa', 'keperluan' => 'Pembahasan materi ujian'],
            ['id_prodi' => 2, 'id_dosen' => 3, 'nim' => '18040201', 'nama' => 'Andi Pratama', 'dosen' => 'Prof. Dian Sari', 'tgl_bimbigan' => Carbon::parse('2024-11-12'), 'hari' => 'Rabu', 'keperluan' => 'Bimbingan praktikum'],
            ['id_prodi' => 3, 'id_dosen' => 4, 'nim' => '18040301', 'nama' => 'Maya Arifin', 'dosen' => 'Prof. Zainal Arifin', 'tgl_bimbigan' => Carbon::parse('2024-11-13'), 'hari' => 'Kamis', 'keperluan' => 'Diskusi penelitian'],
            ['id_prodi' => 4, 'id_dosen' => 5, 'nim' => '18040401', 'nama' => 'Fajar Setiawan', 'dosen' => 'Dr. Hadi Purnama', 'tgl_bimbigan' => Carbon::parse('2024-11-14'), 'hari' => 'Jumat', 'keperluan' => 'Tanya jawab tugas akhir'],
            ['id_prodi' => 1, 'id_dosen' => 1, 'nim' => '18040103', 'nama' => 'Lina Maulani', 'dosen' => 'Dr. Agus Prasetyo', 'tgl_bimbigan' => Carbon::parse('2024-11-15'), 'hari' => 'Senin', 'keperluan' => 'Pembahasan proposal penelitian'],
            ['id_prodi' => 2, 'id_dosen' => 2, 'nim' => '18040202', 'nama' => 'Hendra Yudhistira', 'dosen' => 'Dr. Budi Santoso', 'tgl_bimbigan' => Carbon::parse('2024-11-16'), 'hari' => 'Selasa', 'keperluan' => 'Pengarahan tugas akhir'],
            ['id_prodi' => 3, 'id_dosen' => 3, 'nim' => '18040302', 'nama' => 'Rina Oktaviani', 'dosen' => 'Prof. Dian Sari', 'tgl_bimbigan' => Carbon::parse('2024-11-17'), 'hari' => 'Rabu', 'keperluan' => 'Diskusi skripsi'],
            ['id_prodi' => 4, 'id_dosen' => 4, 'nim' => '18040402', 'nama' => 'Agus Prabowo', 'dosen' => 'Prof. Zainal Arifin', 'tgl_bimbigan' => Carbon::parse('2024-11-18'), 'hari' => 'Kamis', 'keperluan' => 'Tanya jawab tentang praktikum'],
            ['id_prodi' => 1, 'id_dosen' => 5, 'nim' => '18040104', 'nama' => 'Erik Prasetya', 'dosen' => 'Dr. Hadi Purnama', 'tgl_bimbigan' => Carbon::parse('2024-11-19'), 'hari' => 'Jumat', 'keperluan' => 'Review hasil tugas besar'],
        ];

        // Insert data ke dalam tabel data_bimbingans
        foreach ($bimbingans as $bimbingan) {
            DB::table('data_bimbingans')->insert([
                'id_prodi' => $bimbingan['id_prodi'],
                'id_dosen' => $bimbingan['id_dosen'],
                'nim' => $bimbingan['nim'],
                'nama' => $bimbingan['nama'],
                'dosen' => $bimbingan['dosen'],
                'tgl_bimbigan' => $bimbingan['tgl_bimbigan'],
                'hari' => $bimbingan['hari'],
                'keperluan' => $bimbingan['keperluan'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
