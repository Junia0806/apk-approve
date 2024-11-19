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
        // dd('Test Controller masuk'); 
        // Mengambil semua dosen untuk ditampilkan di dropdown
        $dosenList = DataDosen::all();
        // dd($dosenList); 
        // Mengirim data dosen ke view
        return view('admin.bimbingan', ['dosenList' => $dosenList]);
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

    // Menampilkan data dosen terpilih (/admin/bimbingan/{id})
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
                        'id_bimbingan' => $bimbingan->id_bimbingan,
                        'tanggal'   => $tanggal->format('d-m-Y'), // Format tanggal
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
}
