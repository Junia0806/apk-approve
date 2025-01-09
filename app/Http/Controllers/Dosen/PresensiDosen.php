<?php

namespace App\Http\Controllers\Dosen;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DataPresensi;
use App\Models\DataDosen;

class PresensiDosen extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        // Ambil data dosen berdasarkan nip
        $id_dosen = DataDosen::where('nip', Auth::user()->nip)->first();

        $presensi = DataPresensi::with('dosen')
            ->where('id_dosen', $id_dosen->id_dosen) // Gunakan id_dosen
            ->orderBy('tgl_presensi', 'desc') // Urutkan berdasarkan tanggal terbaru
            ->get()
            ->map(function ($absen) {
                // Pastikan data dosen tersedia
                if (!$absen->dosen) {
                    return null; // Abaikan data jika dosen tidak tersedia
                }

                $tanggal = Carbon::parse($absen->tgl_presensi);

                return [
                    'id_presensi'  => $absen->id_presensi,
                    'tanggal'      => $tanggal->format('d-m-Y'),
                    'hari'         => $absen->hari,
                    'id_dosen'     => $absen->dosen->id_dosen,
                    'nama_dosen'   => $absen->dosen->nama_dosen,
                    'status'       => $absen->status,
                ];
            })
            ->filter() // Hapus entri null dari koleksi
            ->values(); // Mengatur ulang indeks array

        return view('dosen.presensi-dosen', compact('presensi'));
        // return response()->json($presensi);
    }
}
