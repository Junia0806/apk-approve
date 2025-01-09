<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DataBimbingan;
use App\Models\DataDosen;
use Carbon\Carbon;

class BimbinganDosen extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        $id_dosen = DataDosen::where('nip', Auth::user()->nip)->first(); // Ambil data dosen berdasarkan nip

        $bimbingans = DataBimbingan::with('sesi')
            ->where('id_dosen', $id_dosen->id_dosen) // Gunakan id_dosen dari data yang ditemukan
            ->orderBy('tgl_bimbigan', 'desc') // Urutkan berdasarkan tanggal terbaru
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
    }
}
