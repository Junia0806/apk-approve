<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSesiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array sesi waktu dari jam 08:00 hingga jam 17:00
        $sesiWaktu = [
            ['jam_awal' => '08:00', 'jam_akhir' => '09:00'],
            ['jam_awal' => '09:00', 'jam_akhir' => '10:00'],
            ['jam_awal' => '10:00', 'jam_akhir' => '11:00'],
            ['jam_awal' => '11:00', 'jam_akhir' => '12:00'],
            ['jam_awal' => '12:00', 'jam_akhir' => '13:00'],
            ['jam_awal' => '13:00', 'jam_akhir' => '14:00'],
            ['jam_awal' => '14:00', 'jam_akhir' => '15:00'],
            ['jam_awal' => '15:00', 'jam_akhir' => '16:00'],
            ['jam_awal' => '16:00', 'jam_akhir' => '17:00'],
        ];

        // Insert data ke dalam tabel data_sesis
        foreach ($sesiWaktu as $sesi) {
            DB::table('data_sesis')->insert([
                'jam_awal' => $sesi['jam_awal'],
                'jam_akhir' => $sesi['jam_akhir'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
