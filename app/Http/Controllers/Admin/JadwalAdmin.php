<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataJadwal; // Asumsi menggunakan model DataJadwal

class JadwalAdmin extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        $jadwal = DataJadwal::all(); // Mengambil semua data jadwal
        return response()->json($jadwal);
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        return response()->json(['message' => 'Form untuk membuat data jadwal baru'], 200);
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'id_matkul' => 'required|integer',
            'id_sesi' => 'required|integer',
            'id_dosen' => 'required|integer',
            'hari' => 'required|string',
        ]);

        $jadwal = DataJadwal::create([
            'id_matkul' => $request->id_matkul,
            'id_sesi' => $request->id_sesi,
            'id_dosen' => $request->id_dosen,
            'hari' => $request->hari,
        ]);

        return response()->json([
            'message' => 'Jadwal berhasil ditambahkan.',
            'data' => $jadwal
        ], 201);
    }

    // Menampilkan data tertentu berdasarkan ID
    public function show($id)
    {
        $jadwal = DataJadwal::find($id);

        if (!$jadwal) {
            return response()->json(['message' => 'Jadwal tidak ditemukan'], 404);
        }

        return response()->json($jadwal);
    }

    // Menampilkan form untuk mengedit data tertentu
    public function edit($id)
    {
        $jadwal = DataJadwal::find($id);

        if (!$jadwal) {
            return response()->json(['message' => 'Jadwal tidak ditemukan'], 404);
        }

        return response()->json(['message' => 'Form untuk mengedit jadwal', 'data' => $jadwal]);
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
