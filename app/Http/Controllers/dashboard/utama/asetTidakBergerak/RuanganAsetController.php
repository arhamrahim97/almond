<?php

namespace App\Http\Controllers\dashboard\utama\asetTidakBergerak;

use AsetBergerak;
use App\Models\Pegawai;
use App\Models\Ruangan;
use App\Models\RuanganAset;
use Illuminate\Http\Request;
use App\Models\AsetTidakBergerak;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreRuanganAsetRequest;
use App\Http\Requests\UpdateRuanganAsetRequest;

class RuanganAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ruanganAsetAll = Ruangan::with('asetTidakBergerak')->whereHas('asetTidakBergerak')->latest()->get();
        $ruanganAset = Ruangan::with('asetTidakBergerak')->whereHas('asetTidakBergerak')->latest()->paginate(6);
        return view('dashboard.pages.utama.asetTidakBergerak.ruanganAset.index', compact('ruanganAsetAll', 'ruanganAset'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRuanganAsetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRuanganAsetRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RuanganAset  $ruanganAset
     * @return \Illuminate\Http\Response
     */
    public function show(RuanganAset $ruanganAset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RuanganAset  $ruanganAset
     * @return \Illuminate\Http\Response
     */
    public function edit(RuanganAset $ruanganAset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRuanganAsetRequest  $request
     * @param  \App\Models\RuanganAset  $ruanganAset
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRuanganAsetRequest $request, RuanganAset $ruanganAset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RuanganAset  $ruanganAset
     * @return \Illuminate\Http\Response
     */
    public function destroy(RuanganAset $ruanganAset)
    {
        //
    }

    public function listAsetRuangan(Request $request, Ruangan $ruanganAset)
    {
        if ($request->ajax()) {
            $data = AsetTidakBergerak::with('ruangan')->whereHas('ruangan', function ($query) use ($ruanganAset) {
                $query->where('id', $ruanganAset->id);
            })->orderBy('updated_at', 'desc');

            // filter
            $data->where(function ($query) use ($request) {
                if ($request->keadaanBarang) {
                    $query->where('keadaan_barang', $request->keadaanBarang);
                }

                if ($request->status) {
                    $query->where('status', $request->status);
                }
            });

            $data->where(function ($query) use ($request) {
                if ($request->search) {
                    $query->where('nama_barang', 'like', '%' . $request->search . '%');
                    $query->orWhere('kode_barang', 'like', '%' . $request->search . '%');
                    $query->orWhere('register', 'like', '%' . $request->search . '%');
                }
            });

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('checkData', function ($row) {
                    return $row->id;
                })

                ->addColumn('ruangan', function ($row) {
                    if ($row->ruangan) {
                        return $row->ruangan->nama_ruangan;
                    } else {
                        if (in_array($row->status, ['Dihibahkan', 'Dihapuskan'])) {
                            return '<span class="badge badge-dark shadow text-gray">Tidak Ada</span>';
                        } else {
                            return '<a href="' . url('tentukan-ruangan-aset', $row->id) . '" class="badge badge-danger shadow" data-toggle="tooltip" data-placement="top" title="Tentukan Ruangan Aset">Belum Ditentukan</a>';
                        }
                    }
                })

                ->addColumn('status', function ($row) {
                    if ($row->status == 'Baru') {
                        return '<a href="#" class="badge badge-success ubah-status-aset shadow text-white" data-toggle="tooltip"
                        data-placement="top" title="Ubah Status Aset" value="' . $row->id . '"
                        data-status_aset="' . $row->status . '" data-id="' . $row->id . '"
                        style="cursor: pointer">Baru</a>';
                    } else if ($row->status == 'Digunakan') {
                        return '<a  href="#" class="badge badge-secondary ubah-status-aset shadow text-white" data-toggle="tooltip"
                        data-placement="top" title="Ubah Status Aset" value="' . $row->id . '"
                        data-status_aset="' . $row->status . '" data-id="' . $row->id . '"
                        style="cursor: pointer">Digunakan</a>';
                    } else if ($row->status == 'Diperbaiki') {
                        return '<a href="#"  class="badge badge-warning ubah-status-aset shadow text-white" data-toggle="tooltip"
                        data-placement="top" title="Ubah Status Aset" value="' . $row->id . '"
                        data-status_aset="' . $row->status . '" data-id="' . $row->id . '"
                        style="cursor: pointer">Diperbaiki</a>';
                    } else if ($row->status == 'Rusak') {
                        return '<a href="#"  class="badge badge-danger ubah-status-aset shadow text-white" data-toggle="tooltip"
                        data-placement="top" title="Ubah Status Aset" value="' . $row->id . '"
                        data-status_aset="' . $row->status . '" data-id="' . $row->id . '"
                        style="cursor: pointer">Rusak</span>';
                    } else if ($row->status == 'Hilang') {
                        return '<a href="#"  class="badge badge-info ubah-status-aset shadow text-white" data-toggle="tooltip"
                        data-placement="top" title="Ubah Status Aset" value="' . $row->id . '"
                        data-status_aset="' . $row->status . '" data-id="' . $row->id . '"
                        style="cursor: pointer">Hilang</span>';
                    } else if ($row->status == 'Pengganti') {
                        return '<a href="#"  class="badge badge-primary ubah-status-aset shadow text-white" data-toggle="tooltip"
                        data-placement="top" title="Ubah Status Aset" value="' . $row->id . '"
                        data-status_aset="' . $row->status . '" data-id="' . $row->id . '"
                        style="cursor: pointer">Pengganti</span>';
                    } else { // Dihibahkan, Dijual, Dimusnahkan
                        return '<span class="badge badge-dark shadow text-gray">' . $row->status . '</span>';
                    }
                })

                ->addColumn('keadaan_barang', function ($row) {
                    if ($row->keadaan_barang == 'Baik') {
                        return '<span class="badge badge-count text-success fw-bold">Baik</span>';
                    } else if ($row->keadaan_barang == 'Kurang Baik') {
                        return '<span class="badge badge-count text-warning fw-bold">Kurang Baik</span>';
                    } else if ($row->keadaan_barang == 'Rusak Berat') {
                        return '<span class="badge badge-count text-danger fw-bold">Rusak Berat</span>';
                    }
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="text-center justify-content-center text-white">';
                    if ($row->ruangan) {
                        $actionBtn .= '<a href="' . url('ubah-ruangan-aset', $row->id) . '" id="btn-edit" class="btn btn-secondary btn-sm me-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Pindahkan Aset/Ubah Ruangan" value="' . $row->id . '" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-share"></i></a> ';
                    } else {
                        if (!in_array($row->status, ['Dihibahkan', 'Dijual', 'Dimusnahkan'])) {
                            $actionBtn .= '<a href="' . url('tentukan-ruangan-aset', $row->id) . '" id="btn-edit" class="btn btn-success btn-sm me-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Tentukan Ruangan Aset" value="' . $row->id . '" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-map-marker-alt"></i></a> ';
                        }
                    }
                    $actionBtn .= '<button id="btn-lihat" class="btn btn-primary btn-sm mr-1 text-white shadow btn-lihat" data-toggle="tooltip" data-placement="top" title="Lihat" value="' . $row->id . '" data-button="lihat"><i class="fas fa-eye"></i></button>';

                    $actionBtn .= '<a href="' . route('manajemen-aset-tidak-bergerak.edit', $row->id) . '" id="btn-edit" class="btn btn-warning btn-sm mr-1 my-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fas fa-edit"></i></a>';
                    $actionBtn .= '<button id="btn-delete" class="btn btn-danger btn-sm mr-1 my-1 text-white shadow btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus" value="' . $row->id . '"><i class="fas fa-trash"></i></button>';
                    $actionBtn .= '</div>';
                    return $actionBtn;
                })
                ->rawColumns([
                    'action',
                    'keadaan_barang',
                    'status',
                ])
                ->make(true);
        }

        $data = [
            'ruangan' => $ruanganAset,
            'aset' => $ruanganAset->asetTidakBergerak,
        ];

        return view('dashboard.pages.utama.asetTidakBergerak.ruanganAset.listAsetRuangan', $data);
    }

    public function cariRuangan(Ruangan $ruanganAset)
    {
        $data = [
            'item' => $ruanganAset,
        ];

        return view('dashboard.components.cards.asetTidakBergerak.cariRuanganAset')->with($data)->render();
    }
}
