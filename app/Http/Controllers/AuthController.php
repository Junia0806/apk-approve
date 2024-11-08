<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if ($username === 'admin' && $password === '123') {
            return redirect()->route('admin-beranda');
        } elseif ($username === 'dosen' && $password === '123') {
            return redirect()->route('beranda-dosen');
        } else {
            return redirect()->back()->withErrors(['login' => 'Username atau password salah.']);
        }
    }
}
