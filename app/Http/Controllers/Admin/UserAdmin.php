<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Menggunakan model User
use Illuminate\Support\Facades\Hash; // Untuk hashing password

class UserAdmin extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        // $users = User::all(); 
        $users = User::orderBy('id_user', 'desc')->paginate(5);
        $totalDosen     = User::where('role', 'dosen')->count();
        $totalTeknisi   = User::where('role', 'teknisi')->count();

        // return response()->json($users);
        return view('admin.pengguna', compact('users','totalTeknisi','totalDosen'));
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        return response()->json(['message' => 'Form untuk membuat data user baru']);
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        // Membuat user baru dan menyimpan data
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password), // Mengenkripsi password
        ]);

        return redirect()->route('adminPengguna')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    // Menampilkan data tertentu berdasarkan ID
    public function show($id)
    {
        $user = User::find($id); // Mencari user berdasarkan ID

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        return response()->json($user);
    }

    // Menampilkan form untuk mengedit data tertentu
    public function edit($id)
    {
        $user = User::find($id); // Mencari user berdasarkan ID

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        return response()->json(['message' => 'Form untuk mengedit data user', 'data' => $user]);
    }

    // Menghapus data tertentu berdasarkan ID
    public function destroy($id)
    {
        $user = User::find($id); // Mencari user berdasarkan ID

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        $user->delete(); // Menghapus data user

        return redirect()->route('adminPengguna')->with('success', 'Pengguna berhasil ditambahkan.');
    }
}
