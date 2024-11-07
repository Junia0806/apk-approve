<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

//GUEST (MAHASISWA)
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
Route::get('/admin-pengguna', function () {
    return view('admin.pengguna');
})->name('admin-pengguna');
