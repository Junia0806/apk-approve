<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataSesi;

class SesiAdmin extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        $sesis = DataSesi::all();
        return response()->json($sesis);
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        return response()->json(['message' => 'Form untuk membuat data sesi baru'], 200);
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'jam_awal' => 'required|string',
            'jam_akhir' => 'required|string',
        ]);

        $sesi = DataSesi::create([
            'jam_awal' => $request->jam_awal,
            'jam_akhir' => $request->jam_akhir,
        ]);

        return response()->json([
            'message' => 'Sesi berhasil ditambahkan.',
            'data' => $sesi
        ], 201);
    }

    // Menampilkan data tertentu berdasarkan ID
    public function show($id)
    {
        $sesi = DataSesi::find($id);

        if (!$sesi) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($sesi);
    }

    // Menampilkan form untuk mengedit data tertentu
    public function edit($id)
    {
        $sesi = DataSesi::find($id);

        if (!$sesi) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['message' => 'Form untuk mengedit sesi', 'data' => $sesi]);
    }

    // Memperbarui data tertentu berdasarkan ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'jam_awal' => 'required|string',
            'jam_akhir' => 'required|string',
        ]);

        $sesi = DataSesi::find($id);

        if (!$sesi) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $sesi->update([
            'jam_awal' => $request->jam_awal,
            'jam_akhir' => $request->jam_akhir,
        ]);

        return response()->json([
            'message' => 'Sesi berhasil diperbarui.',
            'data' => $sesi
        ], 200);
    }

    // Menghapus data tertentu berdasarkan ID
    public function destroy($id)
    {
        $sesi = DataSesi::find($id);

        if (!$sesi) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $sesi->delete();

        return response()->json(['message' => 'Sesi berhasil dihapus.'], 200);
    }
}
