<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBimbingan;
use App\Models\DataDosen;
use App\Models\DataSesi;
use Carbon\Carbon;


class PengajuanGuest extends Controller
{
    // DISCLAIMER: PENGECEKAN SESI DI TIAP TANGGAL MASIH BELUM TERSEDIA
    // Pending Features: Data Sesi difilter dulu dengan data bimbingan. 
    // (aksi ini dilakukan saat user telah memasukkan tanggal bimbingan)
    // Outputnya adalah terfilter sesi yang tersedia maupun tidak.

    // MENAMPILKAN FORM DATA
    public function index()
    {
        // Kumpulkan semua data (Dosen Pembimbing dan Sesi)
        $dataDosen  = DataDosen::all();
        $dataSesi   = DataSesi::all();

        // DATA MODE: Nyalakan melihat datanya
        // return response()->json(['Data Dosen' => $dataDosen, 'Data Sesi' => $dataSesi]);

        // Kirimkan keseluruhan data ke view menggunakan compact
        return view('guest.pengajuan', compact('dataDosen', 'dataSesi'));
    }

    // MENYIMPAN KE DATA FORM KE DATABASE BIMBINGAN
    public function store(Request $request)
    {
        // DISCLAIMER: PENGETESAN DATA DUMMY! MOHON GANTI KE METHOD POST DI ROUTESNYA (web.php)

        // Ambil data dari request (jika form sudah bisa, hapus data dummynya)
        $nim        = $request->nim;
        $nama       = $request->nama;
        $kampus     = 4; // $request->kampus;
        $jurusan    = 1; //$request->jurusan;
        $prodi      = 2; // $request->prodi;
        $dosen      = $request->dosen;
        $tanggal    = $request->tanggal;
        $sesi       = $request->sesi;
        $keperluan  = $request->keperluan;

        // Cek apakah sudah ada data bimbingan dengan data tanggal, sesi, dan dosen yang sama
        $existingBimbingan = DataBimbingan::where('id_dosen', $dosen) 
            ->where('tgl_bimbigan', $tanggal)
            ->where('id_sesi', $sesi)
            ->first();

        if ($existingBimbingan) {
            // Jika data bimbingan sudah ada, tampilkan pesan error

            // DATA MODE: Nyalakan untuk melihat Hasil responsenya
            return response()->json(["error" => ['Message' => "Data Sudah ada"], ["Data" => $existingBimbingan]]);

            // Redirect ke halaman selanjutnya sambil bawa pop-up (mungkin masi error xixi)
            // return back()->withErrors(['Maaf! Data Bimbingan Sudah Terisi pada jadwal tersebut.' => ' Mohon cek Pada Halaman Bimbingan Terlebih dahulu']);
        }
        // Jika tidak ada data bimbingan pada jadwal tersebut, lanjutkan penyimpanan
        // Ambil Data Dosen terlebih dahulu
        $nama_dosen = DataDosen::where('id_dosen', $dosen)->value('nama_dosen');

        // Mengambil hari berdasarkan tanggal
        Carbon::setLocale('id'); // Set bahasa ke Indonesia
        $tgl_convert = Carbon::parse($tanggal); // Pastikan ini objek Carbon
        $hari = $tgl_convert->translatedFormat('l'); // Menggunakan translatedFormat pada objek Carbon

        // Proses menyimpan
        $dataBimbingan = new DataBimbingan();
        $dataBimbingan->id_prodi        = $prodi;
        $dataBimbingan->id_dosen        = $dosen;
        $dataBimbingan->id_sesi         = $sesi;
        $dataBimbingan->nim             = $nim;
        $dataBimbingan->nama            = $nama;
        $dataBimbingan->dosen           = $nama_dosen;
        $dataBimbingan->tgl_bimbigan   = $tanggal;
        $dataBimbingan->hari            = $hari;
        $dataBimbingan->keperluan       = $keperluan;
        
        // DATA MODE: Aktifkan untuk melihat datanya (matikan save sama redirectnya dulu yaa)
        // return response()->json($dataBimbingan);

        $dataBimbingan->save();

        // Redirect dengan pesan sukses
        return redirect()->route('bimbingan')->with('success', 'Data Bimbingan berhasil disimpan.');
    }
}
