<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataSesi;

class SesiAdmin extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $sesiQuery =  DataSesi::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('jam_awal', 'like', '%' . $search . '%')
                    ->orWhere('id_sesi', 'like', '%' . $search . '%')
                        ->orWhere('jam_akhir', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('id_sesi', 'desc');
    
        // Logika untuk menentukan apakah menggunakan pagination atau tidak
        if ($search) {
            $sesi = $sesiQuery->get(); // Ambil semua data tanpa pagination
        } else {
            $sesi = $sesiQuery->paginate(5); // Gunakan pagination jika tidak ada search
        }
    
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
