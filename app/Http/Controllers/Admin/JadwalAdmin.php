<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataJadwal; // Asumsi menggunakan model DataJadwal
use App\Models\DataDosen; 
use App\Models\DataMatkul;
use App\Models\DataSesi;

class JadwalAdmin extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        $dosenList  = DataDosen::all();
        $sesiList   = DataSesi::all();
        $matkulList = DataMatkul::all();
        return view('admin.jadwal', ['dosenList' => $dosenList, 'sesiList' => $sesiList,'matkulList' => $matkulList]);
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        // return response()->json($request);
        $jadwal = DataJadwal::create([
            'id_matkul'     => $request->mata_kuliah,
            'id_sesi'       => $request->sesi,
            'id_dosen'      => $request->dosen,
            'hari'          => $request->hari,
        ]);

        return redirect()->route('adminJadwal')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    // Menampilkan data tertentu berdasarkan ID
    public function show($id)
    {
        // Mengambil data jadwal yang berhubungan dengan dosen
        $jadwals = Datajadwal::with(['matkul', 'sesi', 'dosen'])
            ->where('id_dosen', $id)  // Filter berdasarkan dosen yang dipilih
            ->get()
            ->map(function ($jadwal) {
                return [
                        'id_jadwal' => $jadwal->id_jadwal,
                        'hari'      => $jadwal->hari,
                        'jam_awal'  => $jadwal->sesi->jam_awal,
                        'jam_akhir' => $jadwal->sesi->jam_akhir,
                        'matkul'    => $jadwal->matkul->matkul,
                        'dosen'     => $jadwal->dosen->nama_dosen,
                ];
            });

        // // Mengembalikan response dalam format JSON
        return response()->json($jadwals);
    }

    // Memperbarui data tertentu berdasarkan ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_matkul' => 'required|integer',
            'id_sesi' => 'required|integer',
            'id_dosen' => 'required|integer',
            'hari' => 'required|string',
        ]);

        $jadwal = DataJadwal::find($id);

        if (!$jadwal) {
            return response()->json(['message' => 'Jadwal tidak ditemukan'], 404);
        }

        $jadwal->update([
            'id_matkul' => $request->id_matkul,
            'id_sesi' => $request->id_sesi,
            'id_dosen' => $request->id_dosen,
            'hari' => $request->hari,
        ]);

        return response()->json([
            'message' => 'Jadwal berhasil diperbarui.',
            'data' => $jadwal
        ], 200);
    }

    // Menghapus data tertentu berdasarkan ID
    public function destroy($id)
    {
        $jadwal = DataJadwal::find($id);

        if (!$jadwal) {
            return response()->json(['message' => 'Jadwal tidak ditemukan'], 404);
        }

        $jadwal->delete();

        return response()->json(['message' => 'Jadwal berhasil dihapus.'], 200);
    }
}
