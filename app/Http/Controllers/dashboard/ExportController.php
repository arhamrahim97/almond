<?php

namespace App\Http\Controllers\dashboard;

use App\Exports\ExportSimda;
use App\Models\AsetBergerak;
use Illuminate\Http\Request;
use App\Models\AsetTidakBergerak;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function previewExportSimda()
    {
        $asets = AsetBergerak::orderBy('kode_barang', 'ASC')->orderBy('register', 'ASC')->get()->merge(AsetTidakBergerak::orderBy('kode_barang', 'ASC')->orderBy('register', 'ASC')->get())->whereNotIn('status', ['Dihibahkan', 'Dijual', 'Dimusnahkan']);
        return view('dashboard.pages.utama.previewExportSimda', compact('asets'));
    }

    public function exportSimda()
    {
        // merge AsetBergerak & AsetTidakBergerak
        // $aset = AsetBergerak::all()->merge(AsetTidakBergerak::all())->whereNotIn('status', ['Dihibahkan', 'Dijual', 'Dimusnahkan']);
        $tahun = date('Y');
        $nama_file = 'Status Pengguna Barang Dispusaka ' . $tahun . '.xlsx';
        return Excel::download(new ExportSimda, $nama_file);
        // dd($aset);
    }
}
