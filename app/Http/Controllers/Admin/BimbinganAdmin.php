<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataBimbingan;
use App\Models\DataDosen;
use Carbon\Carbon;

class BimbinganAdmin extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        // Mengambil semua dosen untuk ditampilkan di dropdown
        $dosenList = DataDosen::all();

        // Mengirim data dosen ke view
        return view('admin.bimbingan', ['dosenList' => $dosenList]);
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        return response()->json(['message' => 'Form untuk membuat data bimbingan baru'], 200);
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $bimbingan = DataBimbingan::create([
            'id_prodi' => $request->id_prodi,
            'id_dosen' => $request->id_dosen,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'dosen' => $request->dosen,
            'tgl_bimbigan' => $request->tgl_bimbigan,
            'hari' => $request->hari,
            'keperluan' => $request->keperluan,
        ]);

        return response()->json([
            'message' => 'Bimbingan berhasil ditambahkan.',
            'data' => $bimbingan
        ], 201);
    }

    // Menampilkan data dosen terpilih
    public function show($id)
    {
        // Mengambil data bimbingan yang berhubungan dengan dosen
        $bimbingans = DataBimbingan::with('sesi')
            ->where('id_dosen', $id)  // Filter berdasarkan dosen yang dipilih
            ->get()
            ->map(function ($bimbingan) {
                // Menyesuaikan format data yang akan dikembalikan
                $tanggal = Carbon::parse($bimbingan->tgl_bimbigan);

                if ($bimbingan->sesi) {
                    return [
                        'tanggal'   => $tanggal->format('Y-m-d'), // Format tanggal
                        'hari'      => $bimbingan->hari,
                        'jam_awal'  => $bimbingan->sesi->jam_awal,
                        'jam_akhir' => $bimbingan->sesi->jam_akhir,
                        'nama'      => $bimbingan->nama,
                        'keperluan' => $bimbingan->keperluan,
                        'status'    => $bimbingan->status, // Menambahkan status jika diperlukan
                    ];
                }
            });

        // Mengembalikan response dalam format JSON
        return response()->json($bimbingans);
    }

    // Menampilkan form untuk mengedit data tertentu
    public function edit($id)
    {
        $bimbingan = DataBimbingan::find($id);

        if (!$bimbingan) {
            return response()->json(['message' => 'Data bimbingan tidak ditemukan'], 404);
        }

        return response()->json(['message' => 'Form untuk mengedit bimbingan', 'data' => $bimbingan]);
    }

    // Memperbarui data tertentu berdasarkan ID
    public function update(Request $request, $id)
    {

        $bimbingan = DataBimbingan::find($id);

        if (!$bimbingan) {
            return response()->json(['message' => 'Data bimbingan tidak ditemukan'], 404);
        }

        $bimbingan->update([
            'id_prodi' => $request->id_prodi,
            'id_dosen' => $request->id_dosen,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'dosen' => $request->dosen,
            'tgl_bimbigan' => $request->tgl_bimbigan,
            'hari' => $request->hari,
            'keperluan' => $request->keperluan,
        ]);

        return response()->json([
            'message' => 'Bimbingan berhasil diperbarui.',
            'data' => $bimbingan
        ], 200);
    }

    // Menghapus data tertentu berdasarkan ID
    public function destroy($id)
    {
        $bimbingan = DataBimbingan::find($id);

        if (!$bimbingan) {
            return response()->json(['message' => 'Data bimbingan tidak ditemukan'], 404);
        }

        $bimbingan->delete();

        return response()->json(['message' => 'Bimbingan berhasil dihapus.'], 200);
    }
}
