<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Ruangan;
use App\Exports\ExportSimda;
use App\Models\AsetBergerak;
use Illuminate\Http\Request;
use App\Models\AsetTidakBergerak;
use App\Exports\ExportRuanganAset;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function previewExportSimda()
    {
        $asets = AsetBergerak::orderBy('kode_barang', 'ASC')->orderBy('register', 'ASC')->get()->merge(AsetTidakBergerak::orderBy('kode_barang', 'ASC')->orderBy('register', 'ASC')->get())->whereNotIn('status', ['Dihibahkan', 'Dihapuskan']);
        return view('dashboard.pages.utama.previewExportSimda', compact('asets'));
    }

    public function exportSimda()
    {
        $jumlahKategori = AsetBergerak::orderBy('kode_barang', 'ASC')->orderBy('register', 'ASC')->get()->merge(AsetTidakBergerak::orderBy('kode_barang', 'ASC')->orderBy('register', 'ASC')->get())->whereNotIn('status', ['Dihibahkan', 'Dihapuskan'])->groupBy('kategori')->count();
        $jumlahAset = AsetBergerak::orderBy('kode_barang', 'ASC')->orderBy('register', 'ASC')->get()->merge(AsetTidakBergerak::orderBy('kode_barang', 'ASC')->orderBy('register', 'ASC')->get())->whereNotIn('status', ['Dihibahkan', 'Dihapuskan'])->count();
        $data = [
            'jumlahKategori' => $jumlahKategori,
            'jumlahAset' => $jumlahAset,
            'totalRow' => $jumlahKategori + $jumlahAset,
        ];

        $tahun = date('Y');
        $nama_file = 'Status Pengguna Barang Dispusaka ' . $tahun . '.xlsx';
        return Excel::download(new ExportSimda($data), $nama_file);
    }

    public function exportRuangan(Ruangan $ruanganAset)
    {
        $count = AsetTidakBergerak::with('ruangan')->whereHas('ruangan', function ($query) use ($ruanganAset) {
            $query->where('id', $ruanganAset->id);
        })->orderBy('updated_at', 'desc')->count();
        $data = [
            'id' => $ruanganAset->id,
            'count' => $count,
        ];
        $nama_file = 'Aset Di ' . $ruanganAset->nama_ruangan . ' (' . date('d-m-Y') . ').xlsx';
        return Excel::download(new ExportRuanganAset($data), $nama_file);
    }
}
