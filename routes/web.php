<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// GUEST
use App\Http\Controllers\CekSesi;
use App\Http\Controllers\JadwalGuest;
use App\Http\Controllers\PengajuanGuest;

// DOSEN
use App\Http\Controllers\Dosen\DashboardDosen;
use App\Http\Controllers\Dosen\PresensiDosen;
use App\Http\Controllers\Dosen\BimbinganDosen;

// ADMIN
use App\Http\Controllers\Admin\DashboardAdmin;
use App\Http\Controllers\Admin\KampusAdmin;
use App\Http\Controllers\Admin\DosenAdmin;
use App\Http\Controllers\Admin\MatkulAdmin;
use App\Http\Controllers\Admin\BimbinganAdmin;
use App\Http\Controllers\Admin\JadwalAdmin;
use App\Http\Controllers\Admin\PresensiAdmin;
use App\Http\Controllers\Admin\UserAdmin;
use App\Http\Controllers\Admin\SesiAdmin;


// KONFIGURASI INTEGRASI TERLINDUNGI MIDDLEWARE (JANGAN DIPAKE DULU YA!)
// Route::prefix('/')->group(function () {
//     Route::resource('cek-sesi', CekSesi::class);
//     Route::resource('jadwal', JadwalGuest::class);
//     Route::resource('pengajuan', PengajuanGuest::class);
// });

// Route::prefix('dosen')->middleware('auth')->group(function () {
//     Route::resource('dashboard', DashboardDosen::class);
//     Route::resource('presensi', PresensiDosen::class);
//     Route::resource('bimbingan', BimbinganDosen::class);
// });

// Route::prefix('admin')->middleware('auth')->group(function () {
//     Route::resource('dashboard', DashboardAdmin::class);
//     Route::resource('kampus', KampusAdmin::class);
//     Route::resource('dosen', DosenAdmin::class);
//     Route::resource('matkul', MatkulAdmin::class);
//     Route::resource('bimbingan', BimbinganAdmin::class);
//     Route::resource('jadwal', JadwalAdmin::class);
//     Route::resource('presensi', PresensiAdmin::class);
//     Route::resource('user', UserAdmin::class);
//     Route::resource('sesi', SesiAdmin::class);
// });


// KONFIGURASI FRONT-END
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
