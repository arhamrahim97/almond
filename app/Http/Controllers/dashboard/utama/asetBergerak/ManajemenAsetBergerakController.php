<?php

namespace App\Http\Controllers\dashboard\utama\asetBergerak;

use App\Models\Pegawai;
use App\Models\FileUpload;
use App\Models\AsetBergerak;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
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
            $data = AsetBergerak::with('aset', 'pegawai', 'fileUploadGambar')->latest();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('checkData', function ($row) {
                    return $row->id;
                })

                ->addColumn('pegawai', function ($row) {
                    if ($row->pegawai) {
                        return $row->pegawai->nama_lengkap;
                    } else {
                        if (in_array($row->status, ['Dihibahkan', 'Dijual', 'Dimusnahkan'])) {
                            return '<span class="badge badge-dark shadow text-gray">Tidak Ada</span>';
                        } else {
                            return '<a href="' . url('tentukan-aset-pegawai', $row->id) . '" class="badge badge-danger shadow" data-toggle="tooltip" data-placement="top" title="Tentukan Pegawai">Belum Ditentukan</a>';
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
                        if (!in_array($row->status, ['Dihibahkan', 'Dijual', 'Dimusnahkan'])) {
                            $actionBtn .= '<a href="' . url('tentukan-aset-pegawai', $row->id) . '" id="btn-edit" class="btn btn-success btn-sm me-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Tentukan Pegawai" value="' . $row->id . '" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-user-plus"></i></a> ';
                        }
                    }
                    $actionBtn .= '<button id="btn-lihat" class="btn btn-primary btn-sm mr-1 text-white shadow btn-lihat" data-toggle="tooltip" data-placement="top" title="Lihat" value="' . $row->id . '" data-button="lihat"><i class="fas fa-eye"></i></button>';

                    // $actionBtn .= '<button id="btn-duplikat" class="btn btn-info btn-sm me-1 text-white shadow btn-lihat" data-toggle="tooltip" data-placement="top" title="Duplikat Aset" value="' . $row->id . '" data-button="duplikat"><i class="fas fa-copy"></i></button>
                    // ';

                    $actionBtn .= '<a href="' . url('duplikat-aset-bergerak/' . $row->id) . '" id="btn-edit" class="btn btn-info btn-sm me-1 text-white shadow mr-1 my-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Copy Aset"><i class="fas fa-copy"></i></a>';

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
            'aset' => null,
        ];
        return view('dashboard.pages.utama.asetBergerak.manajemenAset.create', $data);
    }


    public function duplicate(AsetBergerak $manajemenAsetBergerak)
    {
        $data = [
            'aset' => $manajemenAsetBergerak,
            'pegawai' => Pegawai::all(),
        ];
        return view('dashboard.pages.utama.asetBergerak.manajemenAset.duplicate', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreManajemenAsetBergerakRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $no_file_gambar = [];
        foreach ($request->all() as $key => $value) {
            if (strstr($key, 'file_gambar_')) {
                $name_file_gambar = strstr($key, 'file_gambar_');
                array_push($no_file_gambar, $name_file_gambar);
            }
        }

        $validator = Validator::make(
            $request->all(),
            [
                'kategori' => 'required',
                'kode_barang' => 'required',
                'register' => ['required', 'max:13', Rule::unique('aset_bergerak')->where(function ($query) use ($request) {
                    return $query->where('kode_barang', $request->kode_barang);
                })],
                'nama_barang' => 'required',
                'merek_tipe' => 'required',
                'nomor_sertifikat_pabrik_chasis_mesin' => 'required',
                'bahan' => 'required',
                'asal_barang' => 'required',
                'tahun_pembelian' => 'required',
                'ukuran_barang_kontruksi' => 'required',
                'satuan' => 'required',
                'keadaan_barang' => 'required',
                'harga_barang' => 'required',
                'nomor_polisi' => 'required',
            ],
            [
                'kategori.required' => 'Kategori tidak boleh kosong.',
                'kode_barang.required' => 'Kode Barang tidak boleh kosong.',
                'register.required' => 'Register tidak boleh kosong.',
                'register.unique' => 'Nomor Register sudah ada untuk kode barang ' . $request->kode_barang . '. Silahkan ganti dengan nomor register yang lain.',
                'nama_barang.required' => 'Nama Barang tidak boleh kosong.',
                'merek_tipe.required' => 'Merek/Tipe tidak boleh kosong. Berikan garis datar (-) apabila ingin tetap mengosongkannya.',
                'nomor_sertifikat_pabrik_chasis_mesin.required' => 'Nomor Sertifikat/Pabrik/Chasis/Mesin tidak boleh kosong. Berikan garis datar (-) apabila belum ingin mengisi nomor sertifikat/pabrik/chasis/mesin.',
                'bahan.required' => 'Bahan tidak boleh kosong. Berikan garis datar (-) apabila ingin tetap mengosongkannya.',
                'asal_barang.required' => 'Asal Barang tidak boleh kosong.',
                'tahun_pembelian.required' => 'Tahun Pembelian tidak boleh kosong.',
                'ukuran_barang_kontruksi.required' => 'Ukuran Barang Kontruksi tidak boleh kosong. Berikan garis datar (-) apabila ingin tetap mengosongkannya.',
                'satuan.required' => 'Satuan tidak boleh kosong. Berikan garis datar (-) apabila ingin tetap mengosongkannya.',
                'keadaan_barang.required' => 'Keadaan Barang tidak boleh kosong.',
                'harga_barang.required' => 'Harga Barang tidak boleh kosong.',
                'nomor_polisi.required' => 'Nomor Polisi tidak boleh kosong.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        if ($no_file_gambar) {
            return response()->json([
                'status' => 'tidak_ada_gambar',
                'mes' => 'Foto tidak boleh kosong',
                'data' => $no_file_gambar,
            ]);
        }

        if ($request->nama_dokumen != null) {
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

        $insertAset = $request->all();
        $insertAset['jumlah_barang'] = 1;
        $insertAset['keterangan'] = $request->keterangan ?? '-';

        $aset = AsetBergerak::create($insertAset);

        if ($request->file_gambar != null) {
            $no_gambar = 1;
            foreach ($request->file('file_gambar') as $file) {
                $namaFile = mt_rand() . '-' . $aset->nama_barang .  '-' . $no_gambar . '.' . $file->getClientOriginalExtension();
                $file->storeAs(
                    'upload/foto_aset_bergerak/',
                    $namaFile
                );

                $dataGambar = [
                    'another_id' => $aset->id,
                    'nama_file' => $namaFile,
                    'jenis_file' => 'Gambar',
                    'urutan' => $no_gambar,
                ];

                FileUpload::create($dataGambar);
                $no_gambar++;
            }
        }

        $no_dokumen = 1;
        if ($request->nama_dokumen != null) {
            for ($i = 0; $i < $countFileDokumen; $i++) {
                $namaFile = mt_rand() . '-' . $request->nama_dokumen[$i] . '-' . $aset->nama_barang . '-' . $no_dokumen . '.' . $request->file_dokumen[$i]->getClientOriginalExtension();

                $request->file_dokumen[$i]->storeAs(
                    'upload/dokumen_aset_bergerak/',
                    $namaFile
                );

                $dataDokumen = [
                    'another_id' => $aset->id,
                    'nama_file' => $namaFile,
                    'jenis_file' => 'Dokumen',
                    'deskripsi' => $request->nama_dokumen[$i],
                    'urutan' => $no_dokumen,
                ];

                FileUpload::create($dataDokumen);
                $no_dokumen++;
            }
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

        if ($manajemenAsetBergerak->fileUploadDokumen) { // jika ada pegawainya dan di ubah
            $no_dokumen = $manajemenAsetBergerak->fileUploadDokumen->max('urutan') + 1;
        } else {
            $no_dokumen = 1;
        }

        if ($request->nama_dokumen != null) {
            for ($i = 0; $i < $countFileDokumen; $i++) {
                $namaFile = mt_rand() . '-' . $request->nama_dokumen[$i] . '-' . $manajemenAsetBergerak->nama_barang . '-' . $no_dokumen . '.' . $request->file_dokumen[$i]->getClientOriginalExtension();

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
                    'pegawai_id' => $request->pegawai_id,
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
            $pegawai = $val->pegawai ? ' (' . $val->pegawai->nama_lengkap . ')' : '';
            $tempDokumenAsetBergerak[] = [
                'nama_file' => $nama_file,
                'deskripsi' => $deskripsi,
                'pegawai' => $pegawai
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
    public function edit(AsetBergerak $manajemenAsetBergerak)
    {
        $data = [
            'pegawai' => Pegawai::all(),
            'aset' => $manajemenAsetBergerak,
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
        $no_file_gambar = [];
        foreach ($request->all() as $key => $value) {
            if (strstr($key, 'file_gambar_')) {
                $name_file_gambar = strstr($key, 'file_gambar_');
                array_push($no_file_gambar, $name_file_gambar);
            }
        }

        $validator = Validator::make(
            $request->all(),
            [
                'kategori' => 'required',
                'kode_barang' => 'required',
                'register' => ['required', 'max:13', Rule::unique('aset_bergerak')->where(function ($query) use ($request) {
                    return $query->where('kode_barang', $request->kode_barang);
                })->ignore($manajemenAsetBergerak->id)],
                'nama_barang' => 'required',
                'merek_tipe' => 'required',
                'nomor_sertifikat_pabrik_chasis_mesin' => 'required',
                'bahan' => 'required',
                'asal_barang' => 'required',
                'tahun_pembelian' => 'required',
                'ukuran_barang_kontruksi' => 'required',
                'satuan' => 'required',
                'keadaan_barang' => 'required',
                'harga_barang' => 'required',
                'nomor_polisi' => 'required',
            ],
            [
                'kategori.required' => 'Kategori tidak boleh kosong',
                'kode_barang.required' => 'Kode Barang tidak boleh kosong',
                'register.required' => 'Register tidak boleh kosong',
                'register.unique' => 'Nomor Register sudah ada untuk kode barang ' . $request->kode_barang . '. Silahkan ganti dengan nomor register yang lain.',
                'nama_barang.required' => 'Nama Barang tidak boleh kosong.',
                'merek_tipe.required' => 'Merek/Tipe tidak boleh kosong. Berikan garis datar (-) apabila ingin tetap mengosongkannya.',
                'nomor_sertifikat_pabrik_chasis_mesin.required' => 'Nomor Sertifikat/Pabrik/Chasis/Mesin tidak boleh kosong. Berikan garis datar (-) apabila belum ingin mengisi nomor sertifikat/pabrik/chasis/mesin.',
                'bahan.required' => 'Bahan tidak boleh kosong. Berikan garis datar (-) apabila ingin tetap mengosongkannya.',
                'asal_barang.required' => 'Asal Barang tidak boleh kosong.',
                'tahun_pembelian.required' => 'Tahun Pembelian tidak boleh kosong.',
                'ukuran_barang_kontruksi.required' => 'Ukuran Barang Kontruksi tidak boleh kosong. Berikan garis datar (-) apabila ingin tetap mengosongkannya.',
                'satuan.required' => 'Satuan tidak boleh kosong. Berikan garis datar (-) apabila ingin tetap mengosongkannya.',
                'keadaan_barang.required' => 'Keadaan Barang tidak boleh kosong.',
                'harga_barang.required' => 'Harga Barang tidak boleh kosong.',
                'nomor_polisi.required' => 'Nomor Polisi tidak boleh kosong.',
            ]
        );


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        if ($no_file_gambar) {
            return response()->json([
                'status' => 'tidak_ada_gambar',
                'mes' => 'Foto tidak boleh kosong',
                'data' => $no_file_gambar,
            ]);
        }

        // validate untuk dokumen lama
        if (in_array(null, $request->nama_dokumen_old)) {
            return 'nama_dokumen_kosong_old';
        }

        if ($request->nama_dokumen != null) {
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

        if ($request->deleteImageOld != null) {
            $deleteImageOld = explode(',', $request->deleteImageOld);
            foreach ($deleteImageOld as $item) {
                $namaFile = FileUpload::where('id', $item)->first()->nama_file;
                if (Storage::exists('upload/foto_aset_bergerak/' . $namaFile)) {
                    Storage::delete('upload/foto_aset_bergerak/' . $namaFile);
                }
                FileUpload::where('id', $item)->delete();
            }
        }

        if ($request->deleteDocumentOld != null) {
            $deleteDocumentOld = explode(',', $request->deleteDocumentOld);
            foreach ($deleteDocumentOld as $item) {
                $namaFile = FileUpload::where('id', $item)->first()->nama_file;
                if (Storage::exists('upload/dokumen_aset_bergerak/' . $namaFile)) {
                    Storage::delete('upload/dokumen_aset_bergerak/' . $namaFile);
                }
                FileUpload::where('id', $item)->delete();
            }
        }


        // update deskripsi/title dokumen lama
        foreach ($request->nama_dokumen_old as $key => $value) {
            $idUpdateDeskripsi = $manajemenAsetBergerak->fileUploadDokumen[$key]->id;
            $dataDokumen = FileUpload::find($idUpdateDeskripsi);

            if ($key >= 2) { // update title selain bpkb dan stnk
                $dataDokumen->update([
                    'deskripsi' => $request->nama_dokumen_old[$key],
                ]);
            }
        }

        //  update file dokumen lama
        if ($request->file_dokumen_old) {
            foreach ($request->file_dokumen_old as $key => $value) {
                $idUpdateDokumen = $manajemenAsetBergerak->fileUploadDokumen[$key]->id;
                $dataDokumen = FileUpload::find($idUpdateDokumen);
                if (Storage::exists('upload/dokumen_aset_bergerak/' . $dataDokumen->nama_file)) {
                    Storage::delete('upload/dokumen_aset_bergerak/' . $dataDokumen->nama_file);
                }

                $namaFile = mt_rand() . '-' . $request->nama_dokumen_old[$key] . '-' . $request->nama_barang . '-' .  $dataDokumen->urutan . '.' . $value->getClientOriginalExtension();
                $value->storeAs('upload/dokumen_aset_bergerak', $namaFile);

                $update = [
                    'nama_file' => $namaFile,
                ];

                if ($key >= 2) { // selain bpkb dan stnk
                    $update['deskripsi'] = $request->nama_dokumen_old[$key];
                }
                $dataDokumen->update($update);
            }
        }


        $dataAsetBergerak = $request->all();
        $dataAsetBergerak['keterangan'] = $request->keterangan ?? '-';
        $manajemenAsetBergerak->update($dataAsetBergerak);

        if ($request->file_gambar !== null) {
            $no_gambar = $manajemenAsetBergerak->fileUploadGambar->max('urutan') + 1;
            foreach ($request->file('file_gambar') as $file) {
                $namaFile = mt_rand() . '-' . $request->nama_barang .  '-' . $no_gambar . '.' . $file->getClientOriginalExtension();
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

        $no_dokumen = $manajemenAsetBergerak->fileUploadDokumen->max('urutan') + 1;
        if ($request->nama_dokumen != null) {
            for ($i = 0; $i < $countFileDokumen; $i++) {
                $namaFile = mt_rand() . '-' . $request->nama_dokumen[$i] . '-' . $request->nama_barang . '-' .  $no_dokumen . '.' . $request->file_dokumen[$i]->getClientOriginalExtension();
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

        return response()->json('success');
    }

    public function getDuplikatAsetBergerak(AsetBergerak $manajemenAsetBergerak)
    {
        $data = [
            'pegawai' => Pegawai::all(),
            'aset' => $manajemenAsetBergerak,
        ];
        return view('dashboard.pages.utama.asetBergerak.manajemenAset.duplicate', $data);
    }

    public function duplikatAsetBergerak(Request $request)
    {
        $no_file_gambar = [];
        foreach ($request->all() as $key => $value) {
            if (strstr($key, 'file_gambar_')) {
                $name_file_gambar = strstr($key, 'file_gambar_');
                array_push($no_file_gambar, $name_file_gambar);
            }
        }
        $validator = Validator::make(
            $request->all(),
            [
                'kategori' => 'required',
                'kode_barang' => 'required',
                'register' => ['required', 'max:13', Rule::unique('aset_bergerak')->where(function ($query) use ($request) {
                    return $query->where('kode_barang', $request->kode_barang);
                })],
                'nama_barang' => 'required',
                'merek_tipe' => 'required',
                'nomor_sertifikat_pabrik_chasis_mesin' => 'required',
                'bahan' => 'required',
                'asal_barang' => 'required',
                'tahun_pembelian' => 'required',
                'ukuran_barang_kontruksi' => 'required',
                'satuan' => 'required',
                'keadaan_barang' => 'required',
                'harga_barang' => 'required',
                'nomor_polisi' => 'required',
            ],
            [
                'kategori.required' => 'Kategori tidak boleh kosong.',
                'kode_barang.required' => 'Kode Barang tidak boleh kosong.',
                'register.required' => 'Register tidak boleh kosong.',
                'register.unique' => 'Nomor Register sudah ada untuk kode barang ' . $request->kode_barang . '. Silahkan ganti dengan nomor register yang lain.',
                'nama_barang.required' => 'Nama Barang tidak boleh kosong.',
                'merek_tipe.required' => 'Merek/Tipe tidak boleh kosong. Berikan garis datar (-) apabila ingin tetap mengosongkannya.',
                'nomor_sertifikat_pabrik_chasis_mesin.required' => 'Nomor Sertifikat/Pabrik/Chasis/Mesin tidak boleh kosong. Berikan garis datar (-) apabila belum ingin mengisi nomor sertifikat/pabrik/chasis/mesin.',
                'bahan.required' => 'Bahan tidak boleh kosong. Berikan garis datar (-) apabila ingin tetap mengosongkannya.',
                'asal_barang.required' => 'Asal Barang tidak boleh kosong.',
                'tahun_pembelian.required' => 'Tahun Pembelian tidak boleh kosong.',
                'ukuran_barang_kontruksi.required' => 'Ukuran Barang Kontruksi tidak boleh kosong. Berikan garis datar (-) apabila ingin tetap mengosongkannya.',
                'satuan.required' => 'Satuan tidak boleh kosong. Berikan garis datar (-) apabila ingin tetap mengosongkannya.',
                'keadaan_barang.required' => 'Keadaan Barang tidak boleh kosong.',
                'harga_barang.required' => 'Harga Barang tidak boleh kosong.',
                'nomor_polisi.required' => 'Nomor Polisi tidak boleh kosong.',
            ]
        );


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        if ($no_file_gambar) {
            return response()->json([
                'status' => 'tidak_ada_gambar',
                'mes' => 'Foto tidak boleh kosong',
                'data' => $no_file_gambar,
            ]);
        }

        if ($request->nama_dokumen != null) {
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

        $insertAset = $request->all();
        $insertAset['jumlah_barang'] = 1;
        $insertAset['keterangan'] = $request->keterangan ?? '-';

        $aset = AsetBergerak::create($insertAset);


        if ($request->file_gambar != null) {
            $no_gambar = 1;
            foreach ($request->file('file_gambar') as $file) {
                $namaFile = mt_rand() . '-' . $aset->nama_barang .  '-' . $no_gambar . '.' . $file->getClientOriginalExtension();
                $file->storeAs(
                    'upload/foto_aset_bergerak/',
                    $namaFile
                );

                $dataGambar = [
                    'another_id' => $aset->id,
                    'nama_file' => $namaFile,
                    'jenis_file' => 'Gambar',
                    'urutan' => $no_gambar,
                ];

                FileUpload::create($dataGambar);
                $no_gambar++;
            }
        }

        $no_dokumen = 1;
        if ($request->nama_dokumen != null) {
            for ($i = 0; $i < $countFileDokumen; $i++) {
                $namaFile = mt_rand() . '-' . $request->nama_dokumen[$i] . '-' . $aset->nama_barang . '-' . $no_dokumen . '.' . $request->file_dokumen[$i]->getClientOriginalExtension();

                $request->file_dokumen[$i]->storeAs(
                    'upload/dokumen_aset_bergerak/',
                    $namaFile
                );

                $dataDokumen = [
                    'another_id' => $aset->id,
                    'nama_file' => $namaFile,
                    'jenis_file' => 'Dokumen',
                    'deskripsi' => $request->nama_dokumen[$i],
                    'urutan' => $no_dokumen,
                ];

                FileUpload::create($dataDokumen);
                $no_dokumen++;
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
