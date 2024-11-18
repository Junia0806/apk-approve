<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataSesi;

class SesiAdmin extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        // $sesi = DataSesi::all();
        // return response()->json($sesi);
        $sesi = DataSesi::orderBy('id_sesi', 'desc')->paginate(5);
        return view('admin.sesi', compact('sesi'));
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        // $sesi = DataSesi::create([
        //     'sesi' => $request->sesi,
        //     'jam_awal' => $request->jam_awal,
        //     'jam_akhir' => $request->jam_akhir,
        // ]);
        DataSesi::create([
            'jam_awal' => $request->jam_awal,
            'jam_akhir' => $request->jam_akhir,
        ]);

        return redirect()->route('adminSesi')->with('success', 'Data jam berhasil ditambahkan.');
    }

    // Menampilkan data tertentu berdasarkan ID
    public function show($id)
    {
        $sesi = DataSesi::find($id);

        return response()->json($sesi);
    }

    // Memperbarui data tertentu berdasarkan ID
    public function update(Request $request, $id)
    {

        // $sesi = DataSesi::find($id);

        // $sesi->update([
        //     'sesi' => $request->sesi,
        //     'jam_awal' => $request->jam_awal,
        //     'jam_akhir' => $request->jam_akhir,
        // ]);

           // Perbarui data berdasarkan ID
           $sesi = DataSesi::findOrFail($id);

           $sesi->jam_awal  = $request->jam_awal;
           $sesi->jam_akhir = $request->jam_akhir;
           $sesi->save();
   
           return redirect()->route('adminSesi')->with('success', 'Data jam berhasil diperbarui.');
    }

    // Menghapus data tertentu berdasarkan ID
    public function destroy($id)
    {
        $sesi = DataSesi::find($id);

        if (!$sesi) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $sesi->delete();

        return redirect()->route('adminSesi')->with('success', 'Data jam berhasil dihapus.');
    }
}
