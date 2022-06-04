<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Agama;
use App\Models\Bidan;
use App\Models\Penyuluh;
use App\Models\Provinsi;
use App\Models\Kecamatan;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use App\Models\DesaKelurahan;
use App\Models\GolonganDarah;
use App\Models\KabupatenKota;
use App\Models\KartuKeluarga;
use App\Models\StatusHubungan;
use Illuminate\Support\Carbon;
use App\Models\AnggotaKeluarga;
use App\Models\WilayahDomisili;
use Illuminate\Validation\Rule;
use App\Models\StatusPerkawinan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Environment\Console;

class AuthController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.login');
    }

    public function cekLogin(Request $request)
    {
        if (($request->username == '') || ($request->password == '')) {
            return response()->json([
                'res' => 'inputan_tidak_lengkap',
            ]);
        }

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            if (Auth::user()->status == '1') {
                $request->session()->regenerate();
                return response()->json([
                    'res' => 'berhasil',
                ]);
            } else {
                Auth::logout();
                return response()->json([
                    'res' => 'akun_tidak_aktif',
                ]);
            }
        }

        return response()->json([
            'res' => 'gagal',
            'mes' => 'Nama Pengguna beserta Kata Sandi yang dimasukkan tidak ditemukan. Silahkan cek kembali inputan anda.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
