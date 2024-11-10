<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPresensi; // Asumsi menggunakan model Presensi

class PresensiAdmin extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        $presensi = DataPresensi::all(); // Mengambil semua data presensi
        return response()->json($presensi);
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        return response()->json(['message' => 'Form untuk membuat data presensi baru'], 200);
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'id_dosen' => 'required|integer',
            'tanggal' => 'required|date',
            'status' => 'required|string',
        ]);

        $presensi = DataPresensi::create([
            'id_dosen' => $request->id_dosen,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Data presensi berhasil ditambahkan.',
            'data' => $presensi
        ], 201);
    }

    // Menampilkan data tertentu berdasarkan ID
    public function show($id)
    {
        $presensi = DataPresensi::find($id);

        if (!$presensi) {
            return response()->json(['message' => 'Presensi tidak ditemukan'], 404);
        }

        return response()->json($presensi);
    }

    // Menampilkan form untuk mengedit data tertentu
    public function edit($id)
    {
        $presensi = DataPresensi::find($id);

        if (!$presensi) {
            return response()->json(['message' => 'Presensi tidak ditemukan'], 404);
        }

        return response()->json(['message' => 'Form untuk mengedit presensi', 'data' => $presensi]);
    }

    // Memperbarui data tertentu berdasarkan ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_dosen' => 'required|integer',
            'tanggal' => 'required|date',
            'status' => 'required|string',
        ]);

        $presensi = DataPresensi::find($id);

        if (!$presensi) {
            return response()->json(['message' => 'Presensi tidak ditemukan'], 404);
        }

        $presensi->update([
            'id_dosen' => $request->id_dosen,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Data presensi berhasil diperbarui.',
            'data' => $presensi
        ], 200);
    }

    // Menghapus data tertentu berdasarkan ID
    public function destroy($id)
    {
        $presensi = DataPresensi::find($id);

        if (!$presensi) {
            return response()->json(['message' => 'Presensi tidak ditemukan'], 404);
        }

        $presensi->delete();

        return response()->json(['message' => 'Presensi berhasil dihapus.'], 200);
    }
}
