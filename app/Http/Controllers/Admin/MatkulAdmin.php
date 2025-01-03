<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataMatkul; // Asumsi menggunakan model DataMatkul

class MatkulAdmin extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        $matkuls = DataMatkul::all(); // Mengambil semua data matkul
        // return response()->json($matkuls);
        $matkuls = DataMatkul::orderBy('id_matkul', 'desc')->paginate(5);
        return view('admin.mataKuliah', compact('matkuls'));
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        return response()->json(['message' => 'Form untuk membuat data matkul baru'], 200);
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'kd_matkul' => 'required|string',
            'matkul' => 'required|string',
            'sks' => 'required|integer',
            'semester' => 'required|integer',
        ]);

        $matkul = DataMatkul::create([
            'kd_matkul' => $request->kd_matkul,
            'matkul' => $request->matkul,
            'sks' => $request->sks,
            'semester' => $request->semester,
        ]);

        return redirect()->route('admin-mataKuliah')->with('success', 'Mata Kuliah berhasil diperbarui.');
    }

    // Menampilkan data tertentu berdasarkan ID
    public function show($id)
    {
        $matkul = DataMatkul::find($id);

        if (!$matkul) {
            return response()->json(['message' => 'Matkul tidak ditemukan'], 404);
        }

        return response()->json($matkul);
    }

    // Menampilkan form untuk mengedit data tertentu
    public function edit($id)
    {
        $matkul = DataMatkul::find($id);

        if (!$matkul) {
            return response()->json(['message' => 'Matkul tidak ditemukan'], 404);
        }

        return response()->json(['message' => 'Form untuk mengedit matkul', 'data' => $matkul]);
    }

    // Memperbarui data tertentu berdasarkan ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'kd_matkul' => 'required|string',
            'matkul' => 'required|string',
            'sks' => 'required|integer',
            'semester' => 'required|integer',
        ]);

        $matkul = DataMatkul::find($id);

        if (!$matkul) {
            return response()->json(['message' => 'Matkul tidak ditemukan'], 404);
        }

        $matkul->update([
            'kd_matkul' => $request->kd_matkul,
            'matkul' => $request->matkul,
            'sks' => $request->sks,
            'semester' => $request->semester,
        ]);

        return redirect()->route('admin-mataKuliah')->with('success', 'Mata Kuliah berhasil diperbarui.');
    }

    // Menghapus data tertentu berdasarkan ID
    public function destroy($id)
    {
        $matkul = DataMatkul::find($id);

        if (!$matkul) {
            return response()->json(['message' => 'Matkul tidak ditemukan'], 404);
        }

        $matkul->delete();

        return redirect()->route('admin-mataKuliah')->with('success', 'Mata Kuliah berhasil dihapus.');
    }
}
