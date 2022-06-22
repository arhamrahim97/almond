<?php

use App\Models\AsetTidakBergerak;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\dashboard\masterData\UserController;
use App\Http\Controllers\dashboard\masterData\PegawaiController;
use App\Http\Controllers\dashboard\masterData\RuanganController;
use App\Http\Controllers\dashboard\utama\kelolaAset\AsetController;
use App\Http\Controllers\dashboard\utama\asetBergerak\StatusAsetController;
use App\Http\Controllers\dashboard\utama\asetBergerak\AsetPegawaiController;
use App\Http\Controllers\dashboard\utama\asetBergerak\ManajemenAsetBergerakController;
use App\Http\Controllers\dashboard\utama\asetTidakBergerak\ManajemenAsetTidakBergerakController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/cekLogin', [AuthController::class, 'cekLogin']);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
});


Route::get('/test', function () {
    return view('test');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('/kelola-aset', AsetController::class);
    # Start: Aset Bergerak
    Route::resource('/manajemen-aset-bergerak', ManajemenAsetBergerakController::class);
    Route::get('/tentukan-aset-pegawai/{manajemenAsetBergerak}', [ManajemenAsetBergerakController::class, 'tentukanPegawai']);
    Route::post('/tentukan-aset-pegawai/{manajemenAsetBergerak}', [ManajemenAsetBergerakController::class, 'tentukanPegawaiStore']);
    Route::get('/ubah-aset-pegawai/{manajemenAsetBergerak}', [ManajemenAsetBergerakController::class, 'tentukanPegawai']);
    Route::get('/duplikat-aset-bergerak/{manajemenAsetBergerak}', [ManajemenAsetBergerakController::class, 'getDuplikatAsetBergerak'])->name('getDuplikatAsetBergerak');
    Route::post('/duplikat-aset-bergerak', [ManajemenAsetBergerakController::class, 'duplikatAsetBergerak'])->name('duplikatAsetBergerak');
    Route::post('/manajemen-aset-bergerak/delete-selected', [ManajemenAsetBergerakController::class, 'deleteSelected']);

    Route::resource('/aset-pegawai', AsetPegawaiController::class);
    Route::get('/aset-pegawai/cari-pegawai/{asetPegawai}', [AsetPegawaiController::class, 'cariPegawai']);
    Route::post('/ubah-status-aset-bergerak', [StatusAsetController::class, 'ubahStatusAsetBergerak'])->name('ubahStatusAsetBergerak');

    Route::resource('/status-aset-bergerak', StatusAsetController::class);
    # Stop: Aset Bergerak


    # Start: Aset Tidak Bergerak
    Route::resource('/manajemen-aset-tidak-bergerak', ManajemenAsetTidakBergerakController::class);
    Route::get('/tentukan-ruangan-aset/{manajemenAsetTidakBergerak}', [ManajemenAsetTidakBergerakController::class, 'tentukanRuangan']);
    Route::post('/tentukan-ruangan-aset/{manajemenAsetTidakBergerak}', [ManajemenAsetTidakBergerakController::class, 'tentukanRuanganStore']);
    Route::get('/ubah-ruangan-aset/{manajemenAsetTidakBergerak}', [ManajemenAsetTidakBergerakController::class, 'tentukanRuangan']);
    Route::post('/manajemen-aset-tidak-bergerak/delete-selected', [ManajemenAsetTidakBergerakController::class, 'deleteSelected']);




    Route::get('/duplikat-aset-tidak-bergerak/{manajemenAsetTidakBergerak}', [ManajemenAsetTidakBergerakController::class, 'getDuplikatAsetTidakBergerak'])->name('getDuplikatAsetTidakBergerak');
    Route::post('/duplikat-aset-tidak-bergerak', [ManajemenAsetTidakBergerakController::class, 'duplikatAsetTidakBergerak'])->name('duplikatAsetTidakBergerak');






    // Route::resource('/aset-tidak-bergerak', AsetTidakBergerakController::class);
    // Route::resource('/aset-bergerak', AsetBergerakController::class);

    Route::resource('/pegawai', PegawaiController::class);
    Route::post('/pegawai/delete-selected', [PegawaiController::class, 'deleteSelected']);
    Route::resource('/ruangan', RuanganController::class);
    Route::post('/ruangan/delete-selected', [RuanganController::class, 'deleteSelected']);

    Route::resource('/akun', UserController::class);
});
