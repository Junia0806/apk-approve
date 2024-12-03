<?php

namespace App\Http\Controllers\Admin;

use App\Models\DataProdi;
use App\Models\DataKampus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdiAdmin extends Controller
{

    // public function index($id_kampus)
    // {
    //     // Ambil data program studi berdasarkan id_kampus
    //     $prodis = DataProdi::where('id_kampus', $id_kampus)->get();

    //     // Ambil nama kampus berdasarkan id_kampus
    //     $kampus = DataKampus::find($id_kampus);

    //     return view('admin.prodi', compact('prodis', 'id_kampus', 'kampus'));
    // }
    public function index(Request $request, $id_kampus)
    {
        // Ambil input pencarian dari user
        $search = $request->input('search');

        // Ambil data program studi berdasarkan id_kampus dan kondisi pencarian
        $prodis = DataProdi::where('id_kampus', $id_kampus)
            ->when($search, function ($query) use ($search) {
                $query->where('prodi', 'like', '%' . $search . '%')
                    ->orWhere('jurusan', 'like', '%' . $search . '%')
                    ->orWhere('kampus', 'like', '%' . $search . '%')
                    ->orWhere('kd_prodi', 'like', '%' . $search . '%');
            })
            ->get(); // Ambil semua data tanpa pagination (bisa ditambahkan pagination jika diperlukan)

        // Ambil nama kampus berdasarkan id_kampus
        $kampus = DataKampus::find($id_kampus);

        // Kirim data ke view
        return view('admin.prodi', compact('prodis', 'id_kampus', 'kampus'));
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
