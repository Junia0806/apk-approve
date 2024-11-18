<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdiAdmin extends Controller
{
    // Menampilkan daftar prodi berdasarkan id_kampus
    public function index($id_kampus)
    {
        $prodis = DataProdi::where('id_kampus', $id_kampus)->get();
        return view('admin.prodi.index', compact('prodis', 'id_kampus'));
    }

    // Menambahkan data baru ke tabel data_prodis
    public function store(Request $request, $id_kampus)
    {
        // Membuat instance baru dari DataProdi
        $prodi = new DataProdi();

        // Mengisi properti model
        $prodi->id_kampus = $id_kampus;
        $prodi->kd_prodi = $request->kd_prodi;
        $prodi->prodi = $request->prodi;
        $prodi->jurusan = $request->jurusan;
        $prodi->kampus = $request->kampus;

        // Menyimpan data ke database
        $prodi->save();

        return redirect()->route('admin-prodi', $id_kampus)->with('success', 'Data Prodi berhasil ditambahkan.');
    }

    // Menghapus data prodi berdasarkan id_prodi dan id_kampus
    public function destroy($id_kampus, $id_prodi)
    {
        $prodi = DataProdi::where('id_kampus', $id_kampus)->where('id_prodi', $id_prodi)->first();
        if ($prodi) {
            $prodi->delete();
            return redirect()->route('admin-prodi', $id_kampus)->with('success', 'Data Prodi berhasil dihapus.');
        }

        return redirect()->route('admin-prodi', $id_kampus)->with('error', 'Data Prodi tidak ditemukan.');
    }

    // Memperbarui data prodi berdasarkan id_prodi dan id_kampus
    public function update(Request $request, $id_kampus, $id_prodi)
    {
        $prodi = DataProdi::where('id_kampus', $id_kampus)->where('id_prodi', $id_prodi)->first();

        if ($prodi) {
            // Mengisi properti secara manual
            $prodi->kd_prodi = $request->kd_prodi;
            $prodi->prodi = $request->prodi;
            $prodi->jurusan = $request->jurusan;
            $prodi->kampus = $request->kampus;

            // Menyimpan perubahan dengan save()
            $prodi->save();

            return redirect()->route('admin-prodi', $id_kampus)->with('success', 'Data Prodi berhasil diperbarui.');
        }

        return redirect()->route('admin-prodi', $id_kampus)->with('error', 'Data Prodi tidak ditemukan.');
    }
}
