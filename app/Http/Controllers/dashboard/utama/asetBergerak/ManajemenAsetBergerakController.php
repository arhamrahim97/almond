<?php

namespace App\Http\Controllers\dashboard\utama\asetBergerak;

use App\Models\Pegawai;
use App\Models\FileUpload;
use App\Models\AsetBergerak;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            $data = AsetBergerak::with('pegawai', 'fileUploadGambar')->latest();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('checkData', function ($row) {
                    return $row->id;
                })

                ->addColumn('aset', function ($row) {
                    return $row->nama_aset . ' ' . $row->merek . ' ' . $row->model;
                })

                ->addColumn('pegawai', function ($row) {
                    if ($row->pegawai) {
                        return $row->pegawai->nama_lengkap;
                    } else {
                        if ($row->status != 'Dibuang') {
                            return '<a href="' . url('tentukan-aset-pegawai', $row->id) . '" class="badge badge-danger shadow" data-toggle="tooltip" data-placement="top" title="Tentukan Pegawai">Belum Ditentukan</a>';
                        } else {
                            return '<span class="badge badge-dark shadow text-gray">Aset Telah Dibuang</span>';
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
                    } else if ($row->status == 'Rusak') {
                        return '<a href="#"  class="badge badge-danger ubah-status-aset shadow text-white" data-toggle="tooltip"
                        data-placement="top" title="Ubah Status Aset" value="' . $row->id . '"
                        data-status_aset="' . $row->status . '" data-id="' . $row->id . '"
                        style="cursor: pointer">Rusak</span>';
                    } else if ($row->status == 'Diperbaiki') {
                        return '<a href="#"  class="badge badge-warning ubah-status-aset shadow text-white" data-toggle="tooltip"
                        data-placement="top" title="Ubah Status Aset" value="' . $row->id . '"
                        data-status_aset="' . $row->status . '" data-id="' . $row->id . '"
                        style="cursor: pointer">Diperbaiki</a>';
                    } else if ($row->status == 'Dibuang') {
                        return '<span class="badge badge-dark shadow text-gray">Dibuang</span>';
                    } else { // hilang
                        return '<span class="badge badge-dark shadow text-gray">Hilang</span>';
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
                        $actionBtn .= '<a href="' . url('ubah-aset-pegawai', $row->id) . '" id="btn-edit" class="btn btn-secondary btn-sm me-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Pindahkan Aset/Ubah Pegawai" value="' . $row->id . '" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-user-edit"></i></a> ';
                    } else {
                        if ($row->status != 'Dibuang') {
                            $actionBtn .= '<a href="' . url('tentukan-aset-pegawai', $row->id) . '" id="btn-edit" class="btn btn-success btn-sm me-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Tentukan Pegawai" value="' . $row->id . '" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-user-plus"></i></a> ';
                        }
                    }
                    $actionBtn .= '<button id="btn-lihat" class="btn btn-primary btn-sm me-1 text-white shadow btn-lihat" data-toggle="tooltip" data-placement="top" title="Lihat" value="' . $row->id . '" data-button="lihat"><i class="fas fa-eye"></i></button>';

                    $actionBtn .= ' <button id="btn-duplikat" class="btn btn-info btn-sm me-1 text-white shadow btn-lihat" data-toggle="tooltip" data-placement="top" title="Duplikat Aset" value="' . $row->id . '" data-button="duplikat"><i class="fas fa-copy"></i></button>
                    ';
                    $actionBtn .= '<a href="' . route('manajemen-aset-bergerak.edit', $row->id) . '" id="btn-edit" class="btn btn-warning btn-sm mr-1 my-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fas fa-edit"></i></a>';
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

            ],
            [
                'nama_aset.required' => 'Nama Aset tidak boleh kosong',
                'merek.required' => 'Merek tidak boleh kosong',
                'model.required' => 'Model tidak boleh kosong',
                'kode_inventaris.required' => 'Kode Inventaris tidak boleh kosong',
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
            'pegawai' => Pegawai::latest()->get(),
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
        $manajemenAsetBergerak['created_at_'] = Carbon::parse($manajemenAsetBergerak->created_at)->translatedFormat('j F Y H:i');
        $manajemenAsetBergerak['updated_at_'] = Carbon::parse($manajemenAsetBergerak->updated_at)->translatedFormat('j F Y H:i');
        $manajemenAsetBergerak['created_by_'] = $manajemenAsetBergerak->createdBy->nama_lengkap;
        $manajemenAsetBergerak['updated_by_'] = $manajemenAsetBergerak->updatedBy->nama_lengkap;
        $manajemenAsetBergerak['jumlah_foto_'] = $manajemenAsetBergerak->fileUploadGambar->count();
        $fotoAsetBergerak = $manajemenAsetBergerak->fileUploadGambar->pluck('nama_file');
        $tempFotoAsetBergerak = [];
        foreach ($fotoAsetBergerak as $val) {
            $init = Storage::exists('upload/foto_aset_bergerak/' . $val) ? Storage::url('upload/foto_aset_bergerak/' . $val) : asset('assets/img/blank_photo.png');
            $tempFotoAsetBergerak[] = $init;
        }
        $manajemenAsetBergerak['foto_aset_bergerak_'] = $tempFotoAsetBergerak;

        $manajemenAsetBergerak['pegawai_'] = $manajemenAsetBergerak->pegawai ?  $manajemenAsetBergerak->pegawai->nama_lengkap : '';
        $manajemenAsetBergerak['jumlah_dokumen_'] = $manajemenAsetBergerak->fileUploadDokumen->count();
        $dokumenAsetBergerak = $manajemenAsetBergerak->fileUploadDokumen;
        $tempDokumenAsetBergerak = [];
        foreach ($dokumenAsetBergerak as $val) {
            $nama_file = Storage::exists('upload/dokumen_aset_bergerak/' . $val->nama_file) ? Storage::url('upload/dokumen_aset_bergerak/' . $val->nama_file) : 'tidak-ditemukan';
            $deskripsi = $val->deskripsi;
            $tempDokumenAsetBergerak[] = [
                'nama_file' => $nama_file,
                'deskripsi' => $deskripsi,
            ];
        }
        $manajemenAsetBergerak['dokumen_aset_bergerak_'] = $tempDokumenAsetBergerak;
        return $manajemenAsetBergerak;
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
    public function update(Request $request, AsetBergerak $manajemenAsetBergerak)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_aset' => 'required',
                'merek' => 'required',
                'model' => 'required',
                'kode_inventaris' => 'required',

            ],
            [
                'nama_aset.required' => 'Nama Aset tidak boleh kosong',
                'merek.required' => 'Merek tidak boleh kosong',
                'model.required' => 'Model tidak boleh kosong',
                'kode_inventaris.required' => 'Kode Inventaris tidak boleh kosong',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        foreach ($manajemenAsetBergerak->fileUploadGambar as $item) {
            if ($item->id != $request->foto_sampul) {
                FileUpload::where('id', $item->id)->update(['is_sampul' => 0]);
            } else {
                FileUpload::where('id', $item->id)->update(['is_sampul' => 1]);
            }
        }

        if ($request->deleteImageOld !== null) {
            $deleteImageOld = explode(',', $request->deleteImageOld);
            foreach ($deleteImageOld as $item) {
                $namaFile = FileUpload::where('id', $item)->first()->nama_file;
                if (Storage::exists('upload/foto_aset_bergerak/' . $namaFile)) {
                    Storage::delete('upload/foto_aset_bergerak/' . $namaFile);
                }
                FileUpload::where('id', $item)->delete();
            }
        }

        $dataAsetBergerak = [
            'nama_aset' => $request->nama_aset,
            'merek' => $request->merek,
            'model' => $request->model,
            'kode_inventaris' => $request->kode_inventaris,
            'deskripsi' => $request->deskripsi,
        ];

        $manajemenAsetBergerak->update($dataAsetBergerak);

        if ($request->file_gambar !== null) {
            $no_gambar = $manajemenAsetBergerak->fileUploadGambar->max('urutan') + 1;
            foreach ($request->file('file_gambar') as $file) {
                $namaFile = mt_rand() . '-' . $request->nama_aset . '-' . $request->merek . '-' . $request->model . '-' . $no_gambar . '.' . $file->getClientOriginalExtension();
                $file->storeAs(
                    'upload/foto_aset_bergerak/',
                    $namaFile
                );

                $dataGambar = [
                    'another_id' => $manajemenAsetBergerak->id,
                    'nama_file' => $namaFile,
                    'jenis_file' => 'Gambar',
                    'urutan' => $no_gambar,
                ];

                FileUpload::create($dataGambar);
                $no_gambar++;
            }
        }

        return response()->json('success');
    }

    public function duplikatAsetBergerak(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'jumlah_duplikat' => 'required',
            ],
            [
                'jumlah_duplikat.required' => 'Jumlah duplikat tidak boleh kosong',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $asetBergerak = AsetBergerak::find($request->id);

        for ($i = 0; $i < $request->jumlah_duplikat; $i++) {
            $dataAsetBergerak = [
                'nama_aset' => $asetBergerak->nama_aset,
                'merek' => $asetBergerak->merek,
                'model' => $asetBergerak->model,
                'kode_inventaris' => $asetBergerak->kode_inventaris,
                'deskripsi' => $asetBergerak->deskripsi,
                'status' => 'Baru',
            ];

            $insertAset = AsetBergerak::create($dataAsetBergerak);

            foreach ($asetBergerak->fileUploadGambar as $item) {
                $extension = pathinfo(storage_path('upload/foto_aset_bergerak/' . $item->nama_file), PATHINFO_EXTENSION);
                $namaFile = mt_rand() . '-' . $asetBergerak->nama_aset . '-' . $asetBergerak->merek . '-' . $asetBergerak->model . '-' . $item->urutan . '.' . $extension;
                Storage::copy('upload/foto_aset_bergerak/' . $item->nama_file, 'upload/foto_aset_bergerak/' . $namaFile);
                $dataGambar = [
                    'another_id' => $insertAset->id,
                    'nama_file' => $namaFile,
                    'jenis_file' => 'Gambar',
                    'urutan' => $item->urutan,
                ];
                if ($item->is_sampul == 1) {
                    $dataGambar['is_sampul'] = 1;
                }
                FileUpload::create($dataGambar);
            }
        }
        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManajemenAsetBergerak  $manajemenAsetBergerak
     * @return \Illuminate\Http\Response
     */
    public function destroy(AsetBergerak $manajemenAsetBergerak)
    {
        if ($manajemenAsetBergerak->fileUploadGambar) {
            foreach ($manajemenAsetBergerak->fileUploadGambar as $item) {
                if (Storage::exists('upload/foto_aset_bergerak/' . $item->nama_file)) {
                    Storage::delete('upload/foto_aset_bergerak/' . $item->nama_file);
                }
                FileUpload::where('id', $item->id)->delete();
            }
        }

        if ($manajemenAsetBergerak->fileUploadDokumen) {
            foreach ($manajemenAsetBergerak->fileUploadDokumen as $item) {
                if (Storage::exists('upload/dokumen_aset_bergerak/' . $item->nama_file)) {
                    Storage::delete('upload/dokumen_aset_bergerak/' . $item->nama_file);
                }
                FileUpload::where('id', $item->id)->delete();
            }
        }

        $manajemenAsetBergerak->delete();
        return response()->json(['success' => 'Data berhasil dihapus']);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id as $id) {
            $asetBergerak = AsetBergerak::with('fileUploadGambar', 'fileUploadDokumen')->find($id);

            if ($asetBergerak->fileUploadGambar) {
                foreach ($asetBergerak->fileUploadGambar as $item) {
                    if (Storage::exists('upload/foto_aset_bergerak/' . $item->nama_file)) {
                        Storage::delete('upload/foto_aset_bergerak/' . $item->nama_file);
                    }
                    FileUpload::where('id', $item->id)->delete();
                }
            }

            if ($asetBergerak->fileUploadDokumen) {
                foreach ($asetBergerak->fileUploadDokumen as $item) {
                    if (Storage::exists('upload/dokumen_aset_bergerak/' . $item->nama_file)) {
                        Storage::delete('upload/dokumen_aset_bergerak/' . $item->nama_file);
                    }
                    FileUpload::where('id', $item->id)->delete();
                }
            }

            $asetBergerak->delete();
        }
        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
