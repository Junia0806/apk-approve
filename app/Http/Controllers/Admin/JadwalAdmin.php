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
        // Ambil data jadwal bersama relasi matkul, sesi, dan dosen
        $jadwals = Datajadwal::with(['matkul', 'sesi', 'dosen'])
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
    
        // Definisikan urutan hari dalam seminggu
        $hariUrutan = [
            'Senin'    => 1,
            'Selasa'   => 2,
            'Rabu'     => 3,
            'Kamis'    => 4,
            'Jumat'    => 5,
        ];
    
        // Urutkan data berdasarkan 'hari' dan 'jam_awal'
        $jadwals = collect($jadwals)->sortBy(function ($jadwal) use ($hariUrutan) {
            return [$hariUrutan[$jadwal['hari']], $jadwal['jam_awal']];
        })->values()->all();
    
        // Ambil data dosen, sesi, dan matkul
        $dosenList  = DataDosen::all();
        $sesiList   = DataSesi::all();
        $matkulList = DataMatkul::all();
    
        // Kirim data ke view
        return view('admin.jadwal', compact('dosenList', 'sesiList', 'matkulList', 'jadwals'));
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
    public function show($id = null)
    {
        // Mengambil data jadwal, jika $id null maka ambil semua data
        $jadwals = Datajadwal::with(['matkul', 'sesi', 'dosen'])
            ->when($id, function ($query) use ($id) {
                $query->where('id_dosen', $id);
            })
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
    
        // Mengembalikan response dalam format JSON
        return response()->json($jadwals);
   
    }
    
    // Memperbarui data tertentu berdasarkan ID
    public function update(Request $request, $id_jadwal)
    {
        $jadwal = DataJadwal::findOrFail($id_jadwal);
    
        // Validasi data jika diperlukan
        $validated = $request->validate([
            'hari' => 'required|string',
            'sesi' => 'required|integer',
            'matkul' => 'required|integer',
            'dosen' => 'required|integer',
        ]);
    
        // Update jadwal
        $jadwal->update([
            'hari' => $request->input('hari'),
            'id_sesi' => $request->input('sesi'),
            'id_matkul' => $request->input('matkul'),
            'id_dosen' => $request->input('dosen'),
        ]);
    
        return redirect()->route('adminJadwal')->with('success', 'Jadwal berhasil diperbarui');
    }
    

    // Menghapus data tertentu berdasarkan ID
    public function destroy($id)
    {
        $jadwal = DataJadwal::find($id);

        if (!$jadwal) {
            return response()->json(['message' => 'Jadwal tidak ditemukan'], 404);
        }

        $jadwal->delete();
        return redirect()->route('adminJadwal')->with('success', 'Jadwal terkait berhasil dihapus.');
        // return response()->json(['message' => 'Jadwal berhasil dihapus.'], 200);
    }

}
