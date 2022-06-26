<?php

namespace App\Http\Controllers\dashboard;

use App\Models\AsetBergerak;
use Illuminate\Http\Request;
use App\Models\AsetTidakBergerak;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'asetBergerakBaru' => AsetBergerak::where('status', 'Baru')->count(),
            'asetBergerakDigunakan' => AsetBergerak::where('status', 'Digunakan')->count(),
            'asetBergerakDiperbaiki' => AsetBergerak::where('status', 'Diperbaiki')->count(),
            'asetBergerakRusak' => AsetBergerak::where('status', 'Rusak')->count(),
            'asetBergerakHilang' => AsetBergerak::where('status', 'Hilang')->count(),
            'asetBergerakPengganti' => AsetBergerak::where('status', 'Pengganti')->count(),
            'asetBergerakDihibahkan' => AsetBergerak::where('status', 'Dihibahkan')->count(),
            'asetBergerakDijual' => AsetBergerak::where('status', 'Dijual')->count(),
            'asetBergerakDimusnahkan' => AsetBergerak::where('status', 'Dimusnahkan')->count(),
            'asetBergerakTotal' => AsetBergerak::count(),

            'asetTidakBergerakBaru' => AsetTidakBergerak::where('status', 'Baru')->count(),
            'asetTidakBergerakDigunakan' => AsetTidakBergerak::where('status', 'Digunakan')->count(),
            'asetTidakBergerakDiperbaiki' => AsetTidakBergerak::where('status', 'Diperbaiki')->count(),
            'asetTidakBergerakRusak' => AsetTidakBergerak::where('status', 'Rusak')->count(),
            'asetTidakBergerakHilang' => AsetTidakBergerak::where('status', 'Hilang')->count(),
            'asetTidakBergerakPengganti' => AsetTidakBergerak::where('status', 'Pengganti')->count(),
            'asetTidakBergerakDihibahkan' => AsetTidakBergerak::where('status', 'Dihibahkan')->count(),
            'asetTidakBergerakDijual' => AsetTidakBergerak::where('status', 'Dijual')->count(),
            'asetTidakBergerakDimusnahkan' => AsetTidakBergerak::where('status', 'Dimusnahkan')->count(),
            'asetTidakBergerakTotal' => AsetTidakBergerak::count(),

        ];
        return view('dashboard.pages.dashboard', $data);
    }
}
