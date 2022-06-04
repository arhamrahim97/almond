<?php

use App\Http\Controllers\AuthController;
use App\Models\AsetTidakBergerak;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\dashboard\utama\AsetBergerakController;
use App\Http\Controllers\dashboard\utama\AsetTidakBergerakController;
use App\Http\Controllers\dashboard\masterData\PegawaiController;
use App\Http\Controllers\dashboard\masterData\UserController;
use App\Http\Controllers\RuanganController;

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
    Route::resource('/aset-tidak-bergerak', AsetTidakBergerakController::class);
    Route::resource('/aset-bergerak', AsetBergerakController::class);

    Route::resource('/pegawai', PegawaiController::class);
    Route::resource('/ruangan', RuanganController::class);
    Route::post('/pegawai/delete-selected', [PegawaiController::class, 'deleteSelected']);
    Route::resource('/akun', UserController::class);
});
