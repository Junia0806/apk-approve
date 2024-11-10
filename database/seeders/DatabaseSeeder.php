<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DataKampusSeeder::class,
            DataProdiSeeder::class,
            DataDosenSeeder::class,
            DataMatkulSeeder::class,
            DataPresensiSeeder::class,
            DataSesiSeeder::class,
            DataJadwalSeeder::class,
            DataBimbinganSeeder::class,
        ]);
    }
}
