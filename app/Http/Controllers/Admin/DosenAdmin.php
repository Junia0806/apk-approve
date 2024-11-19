<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataDosen; 

class DosenAdmin extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        $dosen = DataDosen::orderBy('id_dosen', 'desc')->paginate(5);
        return view('admin.dosen', compact('dosen'));
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        return response()->json(['message' => 'Form untuk membuat data dosen baru'], 200);
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'kd_dosen' => 'required|string',
            'NIP' => 'required|string',
            'nama_dosen' => 'required|string',
            'no_hp' => 'required|string',
        ]);

        $dosen = DataDosen::create([
            'kd_dosen' => $request->kd_dosen,
            'NIP' => $request->NIP,
            'nama_dosen' => $request->nama_dosen,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin-dosen')->with('success', 'Dosen berhasil ditambahkan.');
    }

    // Menampilkan data tertentu berdasarkan ID
    public function show($id)
    {
        $dosen = DataDosen::find($id);

        if (!$dosen) {
            return response()->json(['message' => 'Dosen tidak ditemukan'], 404);
        }

        return response()->json($dosen);
    }

    // Menampilkan form untuk mengedit data tertentu
    public function edit($id)
    {
        $dosen = DataDosen::find($id);

        if (!$dosen) {
            return response()->json(['message' => 'Dosen tidak ditemukan'], 404);
        }

        return response()->json(['message' => 'Form untuk mengedit dosen', 'data' => $dosen]);
    }

    // Memperbarui data tertentu berdasarkan ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'kd_dosen' => 'required|string',
            'NIP' => 'required|string',
            'nama_dosen' => 'required|string',
            'no_hp' => 'required|string',
        ]);

        $dosen = DataDosen::find($id);

        if (!$dosen) {
            return response()->json(['message' => 'Dosen tidak ditemukan'], 404);
        }

        $dosen->update([
            'kd_dosen' => $request->kd_dosen,
            'NIP' => $request->NIP,
            'nama_dosen' => $request->nama_dosen,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin-dosen')->with('success', 'Dosen berhasil diperbarui.');
    }

    // Menghapus data tertentu berdasarkan ID
    public function destroy($id)
    {
        $dosen = DataDosen::find($id);

        if (!$dosen) {
            return response()->json(['message' => 'Dosen tidak ditemukan'], 404);
        }

        $dosen->delete();

        return redirect()->route('admin-dosen')->with('success', 'Dosen terkait berhasil dihapus.');
    }
}
