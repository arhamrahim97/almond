<?php

namespace App\Http\Controllers\dashboard\utama\asetBergerak;

use App\Models\Pegawai;
use App\Models\FileUpload;
use App\Models\AsetBergerak;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ManajemenAsetBergerak;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Policies\ManajemenAsetBergerakPolicy;
use App\Http\Requests\StoreManajemenAsetBergerakRequest;
use App\Http\Requests\UpdateManajemenAsetBergerakRequest;

class ManajemenAsetBergerakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = AsetBergerak::with('pegawai', 'fileUpload')->latest();
            return DataTables::of($data)
                ->addIndexColumn()

                // ->addColumn('checkData', function ($row) {
                //     return $row->id;
                // })

                // ->addColumn('jumlah_foto', function ($row) {
                //     return $row->fileUpload->count();
                // })

                ->addColumn('pegawai', function ($row) {
                    if ($row->pegawai) {
                        return $row->pegawai->nama_lengkap;
                    } else {
                        return '<span class="badge badge-danger">Belum Ditentukan</span>';
                    }
                })

                ->addColumn('status', function ($row) {
                    if ($row->status == 'Baru') {
                        return '<span class="badge badge-success">Baru</span>';
                    } else if ($row->status == 'Digunakan') {
                        return '<span class="badge badge-secondary">Digunakan</span>';
                    } else {
                        return '<span class="badge badge-danger">Rusak</span>';
                    }
                })



                ->addColumn('created_by', function ($row) {
                    return $row->createdBy->nama_lengkap;
                })

                ->addColumn('updated_by', function ($row) {
                    return $row->updatedBy->nama_lengkap;
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="text-center justify-content-center text-white">';
                    if ($row->pegawai) {
                        $actionBtn .= '<a href="' . url('ubah-aset-pegawai', $row->id) . '" id="btn-edit" class="btn btn-secondary btn-sm me-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Ubah Pegawai" value="' . $row->id . '" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-user-edit"></i></a> ';
                    } else {
                        $actionBtn .= '<a href="' . url('tentukan-aset-pegawai', $row->id) . '" id="btn-edit" class="btn btn-success btn-sm me-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Tentukan Pegawai" value="' . $row->id . '" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-user-plus"></i></a> ';
                    }

                    $actionBtn .= ' <a href="' . route('manajemen-aset-bergerak.edit', $row->id) . '" id="btn-edit" class="btn btn-info btn-sm mr-1 my-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Duplicate Aset"><i class="fas fa-copy"></i></a>';
                    $actionBtn .= '<button id="btn-lihat" class="btn btn-primary btn-sm me-1 text-white shadow btn-lihat" data-toggle="tooltip" data-placement="top" title="Lihat" value="' . $row->id . '" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-eye"></i></button>';
                    $actionBtn .= ' <a href="' . route('manajemen-aset-bergerak.edit', $row->id) . '" id="btn-edit" class="btn btn-warning btn-sm mr-1 my-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fas fa-edit"></i></a>';
                    $actionBtn .= '<button id="btn-delete" class="btn btn-danger btn-sm mr-1 my-1 text-white shadow btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus" value="' . $row->id . '"><i class="fas fa-trash"></i></button>';
                    $actionBtn .= '</div>';
                    return $actionBtn;
                })


                ->rawColumns([
                    'action',
                    'pegawai',
                    'status',
                ])
                ->make(true);
        }
        return view('dashboard.pages.utama.asetBergerak.manajemenAset.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'pegawai' => Pegawai::all(),
        ];
        return view('dashboard.pages.utama.asetBergerak.manajemenAset.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreManajemenAsetBergerakRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_aset' => 'required',
                'merek' => 'required',
                'model' => 'required',
                'kode_inventaris' => 'required',
                // 'pegawai_id' => 'required',

            ],
            [
                'nama_aset.required' => 'Nama Aset tidak boleh kosong',
                'merek.required' => 'Merek tidak boleh kosong',
                'model.required' => 'Model tidak boleh kosong',
                'kode_inventaris.required' => 'Kode Inventaris tidak boleh kosong',
                // 'pegawai_id.required' => 'Pegawai tidak boleh kosong',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        if ($request->file_gambar == null) {
            return 'tidak_ada_gambar';
        }


        $dataAsetBergerak = [
            'nama_aset' => $request->nama_aset,
            'merek' => $request->merek,
            'model' => $request->model,
            'kode_inventaris' => $request->kode_inventaris,
            'deskripsi' => $request->deskripsi,
        ];

        $insertAsetBergerak = AsetBergerak::create($dataAsetBergerak);

        $no_gambar = 1;
        foreach ($request->file('file_gambar') as $file) {
            $namaFile = mt_rand() . '-' . $request->nama_aset . '-' . $request->merek . '-' . $request->model . '-' . $no_gambar . '.' . $file->getClientOriginalExtension();
            $file->storeAs(
                'upload/foto_aset_bergerak/',
                $namaFile
            );

            $dataGambar = [
                'another_id' => $insertAsetBergerak->id,
                'nama_file' => $namaFile,
                'jenis_file' => 'Gambar',
                'urutan' => $no_gambar,
            ];

            if ($no_gambar == 1) {
                $dataGambar['is_sampul'] = 1;
            }

            FileUpload::create($dataGambar);
            $no_gambar++;
        }

        return response()->json('success');
    }


    public function tentukanPegawai(AsetBergerak $manajemenAsetBergerak)
    {
        $data = [
            'aset' => $manajemenAsetBergerak,
            'pegawai' => Pegawai::all(),
        ];
        return view('dashboard.pages.utama.asetBergerak.manajemenAset.tentukanAsetPegawai', $data);
    }

    public function tentukanPegawaiStore(Request $request, AsetBergerak $manajemenAsetBergerak)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'pegawai_id' => 'required',
            ],
            [
                'pegawai_id.required' => 'Pegawai tidak boleh kosong',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        if ($request->nama_dokumen != null) {
            if (!$manajemenAsetBergerak->pegawai) { // jika belum ada pegawainya dan baru ditentukan
                if (($request->file_dokumen == null) && (count($request->nama_dokumen) == 1)) {
                    return 'tidak_ada_dokumen';
                }
            }

            $countFileDokumen = count($request->file_dokumen ?? []);
            $countNamaDokumen = count($request->nama_dokumen);

            if ($countFileDokumen == $countNamaDokumen) {
                if (in_array(null, $request->nama_dokumen)) {
                    return 'nama_dokumen_kosong';
                }
            } else {
                return 'nama_dokumen_kosong_dan_file_dokumen_kosong';
            }
        }

        if ($request->deleteDocumentOld !== null) {
            $deleteDocumentOld = explode(',', $request->deleteDocumentOld);
            foreach ($deleteDocumentOld as $item) {
                $namaFile = FileUpload::where('id', $item)->first()->nama_file;
                if (Storage::exists('upload/dokumen_aset_bergerak/' . $namaFile)) {
                    Storage::delete('upload/dokumen_aset_bergerak/' . $namaFile);
                }
                FileUpload::where('id', $item)->delete();
            }
        }

        if ($manajemenAsetBergerak->pegawai) { // jika ada pegawainya dan di ubah
            $no_dokumen = $manajemenAsetBergerak->fileUploadDokumen->max('urutan') + 1;
        } else {
            $no_dokumen = 1;
        }

        if ($request->nama_dokumen != null) {
            for ($i = 0; $i < $countFileDokumen; $i++) {
                $namaFile = mt_rand() . '-' . $request->nama_dokumen[$i] . '-' . $manajemenAsetBergerak->nama_aset . '-' . $manajemenAsetBergerak->merek . '-' . $manajemenAsetBergerak->model . '.' . $request->file_dokumen[$i]->getClientOriginalExtension();

                $request->file_dokumen[$i]->storeAs(
                    'upload/dokumen_aset_bergerak/',
                    $namaFile
                );

                $dataDokumen = [
                    'another_id' => $manajemenAsetBergerak->id,
                    'nama_file' => $namaFile,
                    'jenis_file' => 'Dokumen',
                    'deskripsi' => $request->nama_dokumen[$i],
                    'urutan' => $no_dokumen,
                ];

                FileUpload::create($dataDokumen);
                $no_dokumen++;
            }
        }

        $manajemenAsetBergerak->update([
            'pegawai_id' => $request->pegawai_id,
            'status' => 'Digunakan',
        ]);

        return response()->json('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManajemenAsetBergerak  $manajemenAsetBergerak
     * @return \Illuminate\Http\Response
     */
    public function show(AsetBergerak $manajemenAsetBergerak)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManajemenAsetBergerak  $manajemenAsetBergerak
     * @return \Illuminate\Http\Response
     */
    public function edit(AsetBergerak $manajemen_aset_bergerak)
    {
        $data = [
            'pegawai' => Pegawai::all(),
            'aset' => $manajemen_aset_bergerak,
        ];
        return view('dashboard.pages.utama.asetBergerak.manajemenAset.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateManajemenAsetBergerakRequest  $request
     * @param  \App\Models\ManajemenAsetBergerak  $manajemenAsetBergerak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManajemenAsetBergerak $manajemenAsetBergerak)
    {
        return $request->deleteDocumentOld;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManajemenAsetBergerak  $manajemenAsetBergerak
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManajemenAsetBergerak $manajemenAsetBergerak)
    {
        //
    }
}
