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

    // Menyimpan data baru
    public function store(Request $request)
    {
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

        return response()->json($sesi);
    }

    // Memperbarui data tertentu berdasarkan ID
    public function update(Request $request, $id)
    {

        $sesi = DataSesi::find($id);

        $sesi->update([
            'jam_awal' => $request->jam_awal,
            'jam_akhir' => $request->jam_akhir,
        ]);
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
