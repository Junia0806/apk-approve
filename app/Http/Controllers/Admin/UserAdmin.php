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
        $users = User::all(); // Mengambil semua data user
        return response()->json($users);
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

        return response()->json([
            'message' => 'User berhasil ditambahkan.',
            'data' => $user
        ], 201);
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

    // Memperbarui data tertentu berdasarkan ID
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string',
            'password' => 'nullable|string|min:6', // Password opsional untuk update
        ]);

        $user = User::find($id); // Mencari user berdasarkan ID

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        // Memperbarui data user
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password ? Hash::make($request->password) : $user->password, // Update password jika diberikan
        ]);

        return response()->json([
            'message' => 'User berhasil diperbarui.',
            'data' => $user
        ], 200);
    }

    // Menghapus data tertentu berdasarkan ID
    public function destroy($id)
    {
        $user = User::find($id); // Mencari user berdasarkan ID

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        $user->delete(); // Menghapus data user

        return response()->json(['message' => 'User berhasil dihapus.'], 200);
    }
}
