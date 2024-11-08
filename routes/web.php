<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('login'); // Gantilah 'login' dengan nama view form login Anda
})->name('login-form');

Route::post('/dashboard', [AuthController::class, 'login'])->name('login');
Route::get('/admin-beranda', function () {
    return view('admin-beranda'); // Halaman untuk admin
})->name('admin-beranda');
Route::get('/beranda-dosen', function () {
    return view('beranda-dosen'); // Halaman untuk dosen
})->name('beranda-dosen');

//GUEST (MAHASISWA)
Route::get('/beranda', function () {
    return view('guest.beranda');
})->name('beranda');
Route::get('/dashboard', function () {
    return view('guest.kehadiran-dosen');
})->name('dashboard');
Route::get('/bimbingan', function () {
    return view('guest.jadwal-bimbingan');
})->name('bimbingan');
Route::get('/pengajuan', function () {
    return view('guest.pengajuan');
})->name('pengajuan');

//DOSEN
Route::get('/beranda-dosen', function () {
    return view('dosen.beranda');
})->name('beranda-dosen');
Route::get('/presensi-dosen', function () {
    return view('dosen.presensi-dosen');
})->name('presensi-dosen');
Route::get('/approval-dosen', function () {
    return view('dosen.approval-dosen');
})->name('approval-dosen');

//ADMIN

Route::get('/admin-beranda', function () {
    return view('admin.beranda');
})->name('admin-beranda');
Route::get('/admin-kampus', function () {
    return view('admin.kampus');
})->name('admin-kampus');
Route::get('/admin-jurusan', function () {
    return view('admin.jurusan');
})->name('admin-jurusan');
Route::get('/admin-prodi', function () {
    return view('admin.prodi');
})->name('admin-prodi');
Route::get('/admin-dosen', function () {
    return view('admin.dosen');
})->name('admin-dosen');
Route::get('/admin-mataKuliah', function () {
    return view('admin.mataKuliah');
})->name('admin-mataKuliah');
Route::get('/admin-bimbingan', function () {
    return view('admin.bimbingan');
})->name('admin-bimbingan');
Route::get('/admin-presensi', function () {
    return view('admin.presensi');
})->name('admin-presensi');
Route::get('/admin-pengguna', function () {
    return view('admin.pengguna');
})->name('admin-pengguna');
