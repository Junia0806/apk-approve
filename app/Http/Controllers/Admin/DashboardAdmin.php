<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataBimbingan;
use App\Models\DataDosen;
use App\Models\DataJadwal;
use App\Models\DataSesi;

class DashboardAdmin extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        $dataDosen  = DataDosen::all(); // menampilkan data dosen secara kesseluruhan
        $dataHari   = array('Senin','Selasa','Rabu','Kamis',"Jumat"); // Format Hari Kerja

        // kirim data diatas ke view
        return view('admin.beranda', ['dataDosen' => $dataDosen, 'dataHari' => $dataHari]);
    }

    // Menampilkan jadwal tertentu berdasarkan ID Dosen
    public function show($id)
    {
        // Mengambil Data Sesi
        $dataSesi   = DataSesi::all();

        // Mengambil Data Jadwal Matkul Kuliah
        $jadwals = DataJadwal::with(['matkul', 'sesi'])
            ->where('id_dosen', $id)  // Filter berdasarkan dosen
            ->get()
            ->map(function ($jadwal) {
                return [
                    'hari'      => $jadwal->hari,
                    'jam_awal'  => $jadwal->sesi->jam_awal,
                    'jam_akhir' => $jadwal->sesi->jam_akhir,
                    'kegiatan'  => $jadwal->matkul->matkul,
                ];
            });

        // Mengambil Data Bimbingan
        $bimbingans = DataBimbingan::with('sesi')
            ->where('id_dosen', $id)  // Filter berdasarkan dosen
            ->get()
            ->map(function ($bimbingan) {
                return [
                    'hari'      => $bimbingan->hari,
                    'jam_awal'  => $bimbingan->sesi->jam_awal,
                    'jam_akhir' => $bimbingan->sesi->jam_akhir,
                    'kegiatan'  => 'Bimbingan', // Nama kegiatan tetap
                ];
            });

        // Gabungkan data jadwal dan bimbingan
        $jadwalLengkap = $jadwals->concat($bimbingans);

        // Urutkan berdasarkan hari dan jam
        $hariUrutan = ['Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4, 'Jumat' => 5];
        $jadwalLengkap = $jadwalLengkap->sortBy(function ($item) use ($hariUrutan) {
            return [$hariUrutan[$item['hari']], $item['jam_awal']];
        })->groupBy('hari'); // Kelompokkan berdasarkan hari

        // Bungkus jadi json dan kirim
        return response()->json([$jadwalLengkap, $dataSesi]);
    }

}
