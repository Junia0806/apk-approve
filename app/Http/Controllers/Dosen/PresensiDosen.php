<?php

namespace App\Http\Controllers\Dosen;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPresensi;
use App\Models\DataDosen;

class PresensiDosen extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        $presensi = DataPresensi::with('dosen')
            ->get()
            ->map(function ($bimbingan) {
                $tanggal = Carbon::parse($bimbingan->tgl_presensi);

                // Pastikan data dosen tersedia
                if ($bimbingan->dosen) {
                    return [
                        'id_presensi'  => $bimbingan->id_presensi,
                        'tanggal'   => $tanggal->format('d-m-Y'),
                        'hari'      => $bimbingan->hari,
                        'id_dosen'  => $bimbingan->dosen->id_dosen,
                        'nama_dosen' => $bimbingan->dosen->nama_dosen,
                        'status'    => $bimbingan->status,
                    ];
                }
            })
            ->values(); // Mengatur ulang indeks array

        return view('dosen.presensi-dosen', compact('presensi'));
        // return response()->json($presensi);
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
    public function show()
    {
        // Logika untuk menampilkan data tertentu
    }

    // Menampilkan form untuk mengedit data tertentu
    public function edit()
    {
        // Logika untuk menampilkan form edit
    }

    // Memperbarui data tertentu berdasarkan ID

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|integer|in:0,1,2'
        ]);

        $presensi = DataPresensi::find($id);
        $presensi->status = $request->status;
        $presensi->save();

        return redirect()->back();
        // $presensi->update([
        //     'status' => $request->status,
        // ]);

    }

    // Menghapus data tertentu berdasarkan ID
    public function destroy()
    {
        // Logika untuk menghapus data
    }
}
