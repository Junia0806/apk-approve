<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataDosen; 

class DosenAdmin extends Controller
{
  
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $dosenQuery = DataDosen::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('kd_dosen', 'like', '%' . $search . '%')
                        ->orWhere('nama_dosen', 'like', '%' . $search . '%')
                        ->orWhere('NIP', 'like', '%' . $search . '%')
                        ->orWhere('no_hp', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('id_dosen', 'desc');
    
        // Logika untuk menentukan apakah menggunakan pagination atau tidak
        if ($search) {
            $dosen = $dosenQuery->get(); // Ambil semua data tanpa pagination
        } else {
            $dosen = $dosenQuery->paginate(5); // Gunakan pagination jika tidak ada search
        }
    
        return view('admin.dosen', compact('dosen'));
    }
    
    
    // Menampilkan form untuk membuat data baru
    public function create()
    {
        return response()->json(['message' => 'Form untuk membuat data dosen baru'], 200);
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'kd_dosen' => 'required|string',
            'NIP' => 'required|string|unique:data_dosens,NIP',  // Memastikan NIP tidak duplikat di tabel dosen
            'nama_dosen' => 'required|string',
            'no_hp' => 'required|string',
        ]);
    
        // Membuat dosen baru dan menyimpan data
        $dosen = DataDosen::create([
            'kd_dosen' => $request->kd_dosen,
            'NIP' => $request->NIP,
            'nama_dosen' => $request->nama_dosen,
            'no_hp' => $request->no_hp,
        ]);
    
        return redirect()->route('admin-dosen')->with('success', 'Dosen berhasil ditambahkan.');
    }
    
    // Menampilkan data tertentu berdasarkan ID
    public function show($id)
    {
        $dosen = DataDosen::find($id);

        if (!$dosen) {
            return response()->json(['message' => 'Dosen tidak ditemukan'], 404);
        }

        return response()->json($dosen);
    }

    // Menampilkan form untuk mengedit data tertentu
    public function edit($id)
    {
        $dosen = DataDosen::find($id);

        if (!$dosen) {
            return response()->json(['message' => 'Dosen tidak ditemukan'], 404);
        }

        return response()->json(['message' => 'Form untuk mengedit dosen', 'data' => $dosen]);
    }

    // Memperbarui data tertentu berdasarkan ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'kd_dosen' => 'required|string',
            'NIP' => 'required|string|unique:dosen,NIP',
            'nama_dosen' => 'required|string',
            'no_hp' => 'required|string',
        ]);

        $dosen = DataDosen::find($id);

        if (!$dosen) {
            return response()->json(['message' => 'Dosen tidak ditemukan'], 404);
        }

        $dosen->update([
            'kd_dosen' => $request->kd_dosen,
            'NIP' => $request->NIP,
            'nama_dosen' => $request->nama_dosen,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin-dosen')->with('success', 'Dosen berhasil diperbarui.');
    }

    // Menghapus data tertentu berdasarkan ID
    public function destroy($id)
    {
        $dosen = DataDosen::find($id);

        if (!$dosen) {
            return response()->json(['message' => 'Dosen tidak ditemukan'], 404);
        }

        $dosen->delete();

        return redirect()->route('admin-dosen')->with('success', 'Dosen terkait berhasil dihapus.');
    }
}
