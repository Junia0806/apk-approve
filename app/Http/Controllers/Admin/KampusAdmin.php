<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataKampus;

class KampusAdmin extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        $kampus = DataKampus::orderBy('id_kampus', 'desc')->paginate(5);
        return view('admin.kampus', compact('kampus'));
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        return response()->json(['message' => 'Form untuk membuat data kampus baru'], 200);
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'kd_kampus' => 'required|string',
            'nama_kampus' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $kampus = DataKampus::create([
            'kd_kampus' => $request->kd_kampus,
            'nama_kampus' => $request->nama_kampus,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin-kampus')->with('success', 'Kampus berhasil ditambahkan.');
    }

    // Menampilkan data tertentu berdasarkan ID
    public function show($id)
    {
        $kampus = DataKampus::find($id);

        if (!$kampus) {
            // return response()->json(['message' => 'Data kampus tidak ditemukan'], 404);
            return redirect()->route('kampus.index')->with('error', 'Toko tidak ditemukan.');
        }

        // return response()->json($kampus);
        return view('kampus.show', compact('kampus'));
    }

    // Menampilkan form untuk mengedit data tertentu
    public function edit($id)
    {
        $kampus = DataKampus::find($id);

        if (!$kampus) {
            return response()->json(['message' => 'Data kampus tidak ditemukan'], 404);
        }

        return response()->json(['message' => 'Form untuk mengedit kampus', 'data' => $kampus]);
    }

    // Memperbarui data tertentu berdasarkan ID
    public function update(Request $request, $id_kampus)
    {
        $request->validate([
            'kd_kampus' => 'required|string',
            'nama_kampus' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $kampus = DataKampus::find($id_kampus);

        // if (!$kampus) {
        //     return response()->json(['message' => 'Data kampus tidak ditemukan'], 404);
        // }

        $kampus->update([
            'kd_kampus' => $request->kd_kampus,
            'nama_kampus' => $request->nama_kampus,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin-kampus')->with('success', 'Kampus berhasil diperbarui.');
    }

    // Menghapus data tertentu berdasarkan ID
    public function destroy($id)
    {
        $kampus = DataKampus::find($id);

        if (!$kampus) {
            return response()->json(['message' => 'Data kampus tidak ditemukan'], 404);
        }

        $kampus->delete();
        return redirect()->route('admin-kampus')->with('success', 'Kampus terkait berhasil dihapus.');
        // return response()->json(['message' => 'Kampus berhasil dihapus.'], 200);
    }
}
