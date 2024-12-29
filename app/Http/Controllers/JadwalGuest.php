<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataBimbingan;
use App\Models\DataDosen;
use Carbon\Carbon;

class JadwalGuest extends Controller
{
    // Menampilkan daftar data
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $bimbingans = DataBimbingan::with('sesi')
            ->whereHas('sesi') // Filter data yang memiliki relasi sesi langsung di query
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%')
                        ->orWhere('tgl_bimbigan', 'like', '%' . $search . '%') // Gunakan tgl_bimbigan dari database
                        ->orWhere('hari', 'like', '%' . $search . '%')
                        ->orWhereHas('sesi', function ($q) use ($search) {
                            $q->where('jam_awal', 'like', '%' . $search . '%')
                                ->orWhere('jam_akhir', 'like', '%' . $search . '%');
                        })
                        ->orWhere('dosen', 'like', '%' . $search . '%')
                        ->orWhere('keperluan', 'like', '%' . $search . '%');
                });
            })
            ->get()
            ->map(function ($bimbingan) {
                $tanggal = Carbon::parse($bimbingan->tgl_bimbigan);
    
                return [
                    'id_bimbingan' => $bimbingan->id_bimbingan,
                    'tanggal'      => $tanggal->format('d-m-Y'), // Format tanggal
                    'hari'         => $bimbingan->hari,
                    'jam_awal'     => $bimbingan->sesi->jam_awal,
                    'jam_akhir'    => $bimbingan->sesi->jam_akhir,
                    'nama'         => $bimbingan->nama,
                    'dosen'        => $bimbingan->dosen,
                    'keperluan'    => $bimbingan->keperluan,
                    'status'       => $bimbingan->status,
                ];
            });
    
        return view('guest.jadwal-bimbingan', compact('bimbingans'));
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
        // Mengambil data bimbingan yang berhubungan dengan dosen
        $bimbingans = DataBimbingan::with('sesi')
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

    // Menampilkan form untuk mengedit data tertentu
    public function edit($id)
    {
        // Logika untuk menampilkan form edit
    }

    // Memperbarui data tertentu berdasarkan ID
    public function update(Request $request, $id)
    {
        // Logika untuk memperbarui data
    }

    // Menghapus data tertentu berdasarkan ID
    public function destroy($id)
    {
        // Logika untuk menghapus data
    }
}
