<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPresensi;
use App\Models\DataDosen;

class PresensiAdmin extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        $presensi = DataPresensi::all();
        // dd($dosenList); 
        // Mengirim data dosen ke view
        return view('admin.presensi');
    }

    // Menampilkan form untuk membuat data baru
    // public function create()
    // {
    //     $today = Carbon::today()->toDateString(); // Tanggal hari ini
    //     $dayName = Carbon::now()->locale('id')->dayName; // Nama hari dalam bahasa Indonesia

    //     // Ambil semua dosen dari tabel dosen
    //     $dosenList = DataDosen::all();

    //     foreach ($dosenList as $dosen) {
    //         // Cek apakah data presensi sudah ada untuk dosen dan tanggal ini
    //         $existingPresensi = DataPresensi::where('id_dosen', $dosen->id)
    //             ->where('tgl_presensi', $today)
    //             ->first();

    //         // Jika belum ada, buat data presensi baru
    //         if (!$existingPresensi) {
    //             DataPresensi::create([
    //                 'id_dosen' => $dosen->id,
    //                 'tgl_presensi' => $today,
    //                 'hari' => $dayName,
    //                 'status' => NULL,
    //             ]);
    //         }
    //     }

    //     return redirect()->back()->with('success', 'Presensi semua dosen berhasil digenerate untuk hari ini.');
    // }

    // Menampilkan data tertentu berdasarkan ID
    public function show($tanggal)
    {
        $presensi = DataPresensi::with('dosen') // Memuat relasi dosen
            ->whereDate('tgl_presensi', $tanggal)
            ->get()
            ->map(function ($bimbingan) {
                    $tanggal = Carbon::parse($bimbingan->tgl_presensi); // Pastikan nama kolom benar

                    // Pastikan data dosen tersedia
                    if ($bimbingan->dosen) {
                        return [
                            'id_presensi' => $bimbingan->id_presensi,
                            'tanggal'   => $tanggal->format('d-m-Y'),
                            'hari'      => $bimbingan->hari,
                            'id_dosen'  => $bimbingan->dosen->id_dosen,
                            'nama_dosen' => $bimbingan->dosen->nama_dosen, 
                            'status'    => $bimbingan->status,
                        ];
                    }
                })
            ->values(); // Mengatur ulang indeks array

        // Mengembalikan response dalam format JSON
        return response()->json($presensi);
    }
 
    // Memperbarui data tertentu berdasarkan ID
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|integer',
        ]);

        // Cari data berdasarkan ID
        $presensi = DataPresensi::find($id);

        // Cek jika data tidak ditemukan
        if (!$presensi) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // Update status jika data ditemukan
        $presensi->update([
            'status' => $request->status,
        ]);

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Presensi dosen berhasil diupdate untuk hari ini.');
}


//    public function update(Request $request, $id)
// {
//     $request->validate([
//         'status' => 'required|integer',
//     ]);

//     $presensi = DataPresensi::find($id);
//     if (!$presensi) {
//         return response()->json(['message' => 'Data tidak ditemukan'], 404);
//     }

//     $presensi->status = 1;
//     $presensi->save();

//     return redirect()->back()->with('success', 'Presensi semua dosen berhasil diupdate untuk hari ini.');
// }


    public function addAbsen()
    {
        // Tanggal dan hari hari ini
        $tanggal = Carbon::now()->format('Y-m-d');
        $hari    = Carbon::now()->locale('id')->isoFormat('dddd'); // Hari dalam bahasa Indonesia

        // Cek apakah sudah ada presensi untuk tanggal ini
        $presensiAda = DataPresensi::where('tgl_presensi', $tanggal)->exists();

        if ($presensiAda) {
            // Jika presensi sudah ada, berikan pesan error
            return redirect()->back()->withErrors(['message' => 'Presensi sudah ada untuk tanggal ini.']);
        }

        // Ambil semua dosen dari database
        $dosenList = DataDosen::all();

        // Iterasi setiap dosen dan tambahkan presensi
        foreach ($dosenList as $dosen) {
            DataPresensi::create([
                'id_dosen' => $dosen->id_dosen,
                'tgl_presensi' => $tanggal,
                'hari' => ucfirst($hari), // Kapitalisasi huruf pertama
                'status' => 0, // Set status awal ke 0
            ]);
        }

        // Redirect atau berikan respons sukses
        return redirect()->back()->with('success', 'Presensi berhasil ditambahkan untuk semua dosen.');
    }
}
