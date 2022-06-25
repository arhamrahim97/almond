<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\dashboard\ExportController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\masterData\UserController;
use App\Http\Controllers\dashboard\masterData\PegawaiController;
use App\Http\Controllers\dashboard\masterData\RuanganController;
use App\Http\Controllers\dashboard\utama\asetBergerak\AsetPegawaiController;
use App\Http\Controllers\dashboard\utama\asetTidakBergerak\RuanganAsetController;
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

Route::get('/', function () {
    return view('landingPage');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
    Route::post('/ubah-status-aset-bergerak', [ManajemenAsetBergerakController::class, 'ubahStatusAsetBergerak'])->name('ubahStatusAsetBergerak');
    # End: Aset Bergerak


    # Start: Aset Tidak Bergerak
    Route::resource('/manajemen-aset-tidak-bergerak', ManajemenAsetTidakBergerakController::class);
    Route::get('/tentukan-ruangan-aset/{manajemenAsetTidakBergerak}', [ManajemenAsetTidakBergerakController::class, 'tentukanRuangan']);
    Route::post('/tentukan-ruangan-aset/{manajemenAsetTidakBergerak}', [ManajemenAsetTidakBergerakController::class, 'tentukanRuanganStore']);
    Route::get('/ubah-ruangan-aset/{manajemenAsetTidakBergerak}', [ManajemenAsetTidakBergerakController::class, 'tentukanRuangan']);
    Route::post('/manajemen-aset-tidak-bergerak/delete-selected', [ManajemenAsetTidakBergerakController::class, 'deleteSelected']);
    Route::post('/manajemen-aset-tidak-bergerak/tentukan-ruangan-selected', [ManajemenAsetTidakBergerakController::class, 'tentukanAsetSelected']);
    Route::post('/tentukan-ruangan-beberapa-aset', [ManajemenAsetTidakBergerakController::class, 'tentukanRuanganBeberapaAset'])->name('tentukanRuanganBeberapaAset');
    Route::post('/ubah-status-aset-tidak-bergerak', [ManajemenAsetTidakBergerakController::class, 'ubahStatusAsetTidakBergerak'])->name('ubahStatusAsetTidakBergerak');

    Route::resource('/ruangan-aset', RuanganAsetController::class);
    Route::get('/ruangan-aset/cari-ruangan/{ruanganAset}', [RuanganAsetController::class, 'cariRuangan']);

    Route::get('/list-aset-ruangan/{ruanganAset}', [RuanganAsetController::class, 'listAsetRuangan']);

    Route::get('/duplikat-aset-tidak-bergerak/{manajemenAsetTidakBergerak}', [ManajemenAsetTidakBergerakController::class, 'getDuplikatAsetTidakBergerak'])->name('getDuplikatAsetTidakBergerak');
    Route::post('/duplikat-aset-tidak-bergerak', [ManajemenAsetTidakBergerakController::class, 'duplikatAsetTidakBergerak'])->name('duplikatAsetTidakBergerak');
    # End: Aset Tidak Bergerak

    Route::get('/preview-export-simda', [ExportController::class, 'previewExportSimda']);
    Route::get('/export-simda', [ExportController::class, 'exportSimda']);


    Route::group(['middleware' => ['role:Admin']], function () {
        # Start: Master Data
        Route::resource('/pegawai', PegawaiController::class);
        Route::post('/pegawai/delete-selected', [PegawaiController::class, 'deleteSelected']);
        Route::resource('/ruangan', RuanganController::class);
        Route::post('/ruangan/delete-selected', [RuanganController::class, 'deleteSelected']);

        Route::resource('/akun', UserController::class);
        # End: Master Data
    });
    Route::post('/update-akun/{akun}', [UserController::class, 'updateAkun'])->name('updateAkun');
});
