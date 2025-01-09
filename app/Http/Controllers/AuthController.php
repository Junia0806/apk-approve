<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->only('email', 'password');

        // dd($credentials);

        // Coba autentikasi
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Arahkan ke halaman sesuai role
            if ($user->role === 'Admin') {
                return redirect()->route('adminDashboard')->with('success', 'Login berhasil!');
            } elseif ($user->role === 'Dosen') {
                return redirect()->route('beranda-dosen')->with('success', 'Login berhasil!');
            } else {
                // Jika role tidak valid, logout
                Auth::logout();
                return back()->withErrors([
                    'role' => 'role pengguna tidak valid.',
                ])->onlyInput('email');
            }
        }

        // Login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');

        // // Format Lama
        // $username = $request->input('username');
        // $password = $request->input('password');

        // if ($username === 'admin' && $password === '123') {
        //     return redirect()->route('adminDashboard');
        // } elseif ($username === 'dosen' && $password === '123') {
        //     return redirect()->route('beranda-dosen');
        // } else {
        //     return redirect()->back()->withErrors(['login' => 'Username atau password salah.']);
        // }
    }
}
