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
        // Data bimbingan yang disesuaikan dengan data dosen
        $bimbingans = [
            ['id_prodi' => 1, 'id_dosen' => 1, 'id_sesi' => 1, 'nim' => '18040101', 'nama' => 'Rudi Santoso', 'dosen' => 'Dr. Ahmad Fadli, M.T.', 'tgl_bimbigan' => Carbon::parse('2024-11-10'), 'hari' => 'Senin', 'keperluan' => 'Konsultasi mengenai tugas besar'],
            ['id_prodi' => 1, 'id_dosen' => 2, 'id_sesi' => 2, 'nim' => '18040102', 'nama' => 'Siti Nurjanah', 'dosen' => 'Prof. Bambang Sutrisno, M.Si.', 'tgl_bimbigan' => Carbon::parse('2024-11-11'), 'hari' => 'Selasa', 'keperluan' => 'Pembahasan materi ujian'],
            ['id_prodi' => 2, 'id_dosen' => 3, 'id_sesi' => 3, 'nim' => '18040201', 'nama' => 'Andi Pratama', 'dosen' => 'Dr. Citra Lestari, M.Pd.', 'tgl_bimbigan' => Carbon::parse('2024-11-12'), 'hari' => 'Rabu', 'keperluan' => 'Bimbingan praktikum'],
            ['id_prodi' => 3, 'id_dosen' => 4, 'id_sesi' => 4, 'nim' => '18040301', 'nama' => 'Maya Arifin', 'dosen' => 'Dr. Diana Putri, M.Si.', 'tgl_bimbigan' => Carbon::parse('2024-11-13'), 'hari' => 'Kamis', 'keperluan' => 'Diskusi penelitian'],
            ['id_prodi' => 4, 'id_dosen' => 5, 'id_sesi' => 5, 'nim' => '18040401', 'nama' => 'Fajar Setiawan', 'dosen' => 'Drs. Eko Prasetyo, M.Pd.', 'tgl_bimbigan' => Carbon::parse('2024-11-14'), 'hari' => 'Jumat', 'keperluan' => 'Tanya jawab tugas akhir'],
            ['id_prodi' => 1, 'id_dosen' => 1, 'id_sesi' => 6, 'nim' => '18040103', 'nama' => 'Lina Maulani', 'dosen' => 'Dr. Ahmad Fadli, M.T.', 'tgl_bimbigan' => Carbon::parse('2024-11-15'), 'hari' => 'Senin', 'keperluan' => 'Pembahasan proposal penelitian'],
            ['id_prodi' => 2, 'id_dosen' => 2, 'id_sesi' => 7, 'nim' => '18040202', 'nama' => 'Hendra Yudhistira', 'dosen' => 'Prof. Bambang Sutrisno, M.Si.', 'tgl_bimbigan' => Carbon::parse('2024-11-16'), 'hari' => 'Selasa', 'keperluan' => 'Pengarahan tugas akhir'],
            ['id_prodi' => 3, 'id_dosen' => 3, 'id_sesi' => 8, 'nim' => '18040302', 'nama' => 'Rina Oktaviani', 'dosen' => 'Dr. Citra Lestari, M.Pd.', 'tgl_bimbigan' => Carbon::parse('2024-11-17'), 'hari' => 'Rabu', 'keperluan' => 'Diskusi skripsi'],
            ['id_prodi' => 4, 'id_dosen' => 4, 'id_sesi' => 9, 'nim' => '18040402', 'nama' => 'Agus Prabowo', 'dosen' => 'Dr. Diana Putri, M.Si.', 'tgl_bimbigan' => Carbon::parse('2024-11-18'), 'hari' => 'Kamis', 'keperluan' => 'Tanya jawab tentang praktikum'],
            ['id_prodi' => 1, 'id_dosen' => 5, 'id_sesi' => 10, 'nim' => '18040104', 'nama' => 'Erik Prasetya', 'dosen' => 'Drs. Eko Prasetyo, M.Pd.', 'tgl_bimbigan' => Carbon::parse('2024-11-19'), 'hari' => 'Jumat', 'keperluan' => 'Review hasil tugas besar'],
        ];

        // Insert data ke dalam tabel data_bimbingans
        foreach ($bimbingans as $bimbingan) {
            DB::table('data_bimbingans')->insert([
                'id_prodi' => $bimbingan['id_prodi'],
                'id_dosen' => $bimbingan['id_dosen'],
                'id_sesi' => $bimbingan['id_sesi'], 
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
