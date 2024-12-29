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
use App\Http\Controllers\Admin\ProdiAdmin;


// KONFIGURASI INTEGRASI TERLINDUNGI MIDDLEWARE (JANGAN DIPAKE DULU YA!)
// Route::prefix('/')->group(function () {

// });

// Route::prefix('dosen')->middleware('auth')->group(function () {

// });

Route::prefix('admin')->group(function () {

    Route::get('/bimbingan/getData/{$1}', [BimbinganAdmin::class, 'getBimbinganByDosen']);
});


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
Route::get('/bimbingan', [JadwalGuest::class, 'index'])->name('bimbingan');
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

Route::get('/admin/kampus', [kampusAdmin::class, 'index'])->name('admin-kampus');
Route::post('/adminKampus', [kampusAdmin::class, 'store'])->name('adminKampus.store');
Route::delete('/admin/kampus/{id_kampus}', [kampusAdmin::class, 'destroy'])->name('adminKampus.destroy');
Route::put('/kampus/update/{id_kampus}', [kampusAdmin::class, 'update'])->name('adminKampus.update');


Route::get('/admin/bimbingan', [BimbinganAdmin::class, 'index'])->name('adminBimbingan');
Route::get('/admin/bimbingan/{id}', [BimbinganAdmin::class, 'show'])->name('adminBimbingan.show');
Route::put('/admin/bimbingan/{id}', [BimbinganAdmin::class, 'update'])->name('adminBimbingan.update');


Route::get('/presensi/{tanggal}', [PresensiAdmin::class, 'show'])->name('presensi.show');
Route::put('/presensi/{id}', [PresensiAdmin::class, 'update'])->name('presensi.update');
Route::get('/presensi', [PresensiAdmin::class, 'index'])->name('adminPresensi');

Route::get('/admin/prodi/{id_kampus}', [ProdiAdmin::class, 'index'])->name('admin-prodi');
Route::post('/adminProdi/{id_kampus}', [ProdiAdmin::class, 'store'])->name('adminProdi.store');
Route::delete('/admin/prodi/{id_kampus}/{id_Prodi}', [ProdiAdmin::class, 'destroy'])->name('adminProdi.destroy');
Route::put('/Prodi/update/{id_kampus}/{id_Prodi}', [ProdiAdmin::class, 'update'])->name('adminProdi.update');


Route::get('/admin/dosen', [DosenAdmin::class, 'index'])->name('admin-dosen');
Route::post('/adminDosen', [DosenAdmin::class, 'store'])->name('adminDosen.store');
Route::delete('/admin/dosen/{id_Dosen}', [DosenAdmin::class, 'destroy'])->name('adminDosen.destroy');
Route::put('/Dosen/update/{id_Dosen}', [DosenAdmin::class, 'update'])->name('adminDosen.update');

Route::get('/admin/matkul', [matkulAdmin::class, 'index'])->name('admin-mataKuliah');
Route::post('/adminmatkul', [matkulAdmin::class, 'store'])->name('adminmatkul.store');
Route::delete('/admin/matkul/{id_matkul}', [matkulAdmin::class, 'destroy'])->name('adminmatkul.destroy');
Route::put('/matkul/update/{id_matkul}', [matkulAdmin::class, 'update'])->name('adminmatkul.update');

Route::get('/pengguna', [UserAdmin::class, 'index'])->name('adminPengguna');
Route::post('/pengguna', [UserAdmin::class, 'store'])->name('adminPengguna.store');
Route::get('/pengguna/{id}', [UserAdmin::class, 'show'])->name('adminPengguna.show');
Route::put('/pengguna/{id}', [UserAdmin::class, 'update'])->name('adminPengguna.update');
Route::delete('/pengguna/{id}', [UserAdmin::class, 'destroy'])->name('adminPengguna.destroy');


Route::get('/sesi', [SesiAdmin::class, 'index'])->name('adminSesi');
Route::post('/sesi', [SesiAdmin::class, 'store'])->name('adminSesi.store');
Route::put('/sesi/{id}', [SesiAdmin::class, 'update'])->name('adminSesi.update');
Route::delete('/sesi/{id}', [SesiAdmin::class, 'destroy'])->name('adminSesi.destroy');

Route::get('/admin/jadwal', [JadwalAdmin::class, 'index'])->name('adminJadwal');
Route::get('/admin/jadwal/{id}', [JadwalAdmin::class, 'show'])->name('adminJadwal.show');