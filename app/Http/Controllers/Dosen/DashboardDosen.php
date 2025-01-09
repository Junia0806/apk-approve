<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DataDosen;
use App\Models\DataSesi;
use App\Models\DataJadwal;
use App\Models\DataBimbingan;

class DashboardDosen extends Controller
{
    public function index()
    {
        // Ambil data dosen berdasarkan nip
        $id = DataDosen::where('nip', Auth::user()->nip)->first();

        if (!$id) {
            return response()->json(['error' => 'Data dosen tidak ditemukan'], 404);
        }

        // Mengambil Data Sesi
        $dataSesi = DataSesi::all();

        // Ambil Data Hari
        $dataHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        // Mengambil Data Jadwal Matkul Kuliah
        $jadwals = DataJadwal::with(['matkul', 'sesi'])
            ->where('id_dosen', $id->id_dosen)
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
            ->where('id_dosen', $id->id_dosen)
            ->get()
            ->map(function ($bimbingan) {
                return [
                    'hari'      => $bimbingan->hari,
                    'jam_awal'  => $bimbingan->sesi->jam_awal,
                    'jam_akhir' => $bimbingan->sesi->jam_akhir,
                    'kegiatan'  => 'Bimbingan',
                ];
            });

        // Gabungkan data jadwal dan bimbingan
        $jadwalLengkap = $jadwals->concat($bimbingans);

        // Urutkan berdasarkan hari dan jam
        $hariUrutan = ['Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4, 'Jumat' => 5];
        $jadwalLengkap = $jadwalLengkap->sortBy(function ($item) use ($hariUrutan) {
            return [$hariUrutan[$item['hari']], $item['jam_awal']];
        })->groupBy('hari');

        return response()->json($dataHari);

        // return view('dosen.beranda', compact('dataHari','jadwalLengkap','dataSesi'));
    }
}
