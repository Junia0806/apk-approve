<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataBimbingan;
use App\Models\DataDosen;
use Carbon\Carbon;

class BimbinganDosen extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        $bimbingans = DataBimbingan::with('sesi')
        ->get()
        ->map(function ($bimbingan) {
            if (!$bimbingan->sesi) {
                return null; // Abaikan data jika sesi tidak ada
            }

            $tanggal = Carbon::parse($bimbingan->tgl_bimbigan);

            return [
                'id_bimbingan' => $bimbingan->id_bimbingan,
                'tanggal'   => $tanggal->format('d-m-Y'),
                'hari'      => $bimbingan->hari,
                'jam_awal'  => $bimbingan->sesi->jam_awal,
                'jam_akhir' => $bimbingan->sesi->jam_akhir,
                'nama'      => $bimbingan->nama,
                'keperluan' => $bimbingan->keperluan,
                'status'    => $bimbingan->status,
            ];
        })
        ->filter(); // Hapus entri null dari koleksi
            return view('dosen.approval-dosen', compact('bimbingans'));
        // return response()->json($bimbingans);
    }


    // Menampilkan form untuk membuat data baru
    public function create()
    {
        // Logika untuk menampilkan form pembuatan data
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        // Logika untuk menyimpan data ke database
    }

    // Menampilkan data tertentu berdasarkan ID
    public function show($id)
    {
        // Logika untuk menampilkan data tertentu
    }

    // Menampilkan form untuk mengedit data tertentu
    public function edit($id)
    {
        // Logika untuk menampilkan form edit
    }

    // Memperbarui data tertentu berdasarkan ID
    public function update(Request $request, $id)
    {
        // dd($request,$id);
        $request->validate([
            'status' => 'required|integer|in:0,1,2'
        ]);

        $bimbingan = DataBimbingan::find($id);
        $bimbingan->status = $request->status;
        $bimbingan->save();

        return redirect()->back();
    }
    // Menghapus data tertentu berdasarkan ID
    public function destroy($id)
    {
        // Logika untuk menghapus data
    }
}
