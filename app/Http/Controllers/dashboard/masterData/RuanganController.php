<?php

namespace App\Http\Controllers\dashboard\masterData;

use App\Models\Ruangan;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreRuanganRequest;
use App\Http\Requests\UpdateRuanganRequest;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Ruangan::with('fileUploadGambar')->latest();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('checkData', function ($row) {
                    return $row->id;
                })

                ->addColumn('jumlah_foto', function ($row) {
                    return $row->fileUploadGambar->count();
                })

                ->addColumn('created_by', function ($row) {
                    return $row->createdBy->nama_lengkap;
                })

                ->addColumn('updated_by', function ($row) {
                    return $row->updatedBy->nama_lengkap;
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="text-center justify-content-center text-white">';
                    $actionBtn .= '<button id="btn-lihat" class="btn btn-primary btn-sm me-1 text-white shadow btn-lihat" data-toggle="tooltip" data-placement="top" title="Lihat" value="' . $row->id . '" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-eye"></i></button>';
                    $actionBtn .= ' <a href="' . route('ruangan.edit', $row->id) . '" id="btn-edit" class="btn btn-warning btn-sm mr-1 my-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fas fa-edit"></i></a>';
                    $actionBtn .= '<button id="btn-delete" class="btn btn-danger btn-sm mr-1 my-1 text-white shadow btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus" value="' . $row->id . '"><i class="fas fa-trash"></i></button>';
                    $actionBtn .= '</div>';
                    return $actionBtn;
                })


                ->rawColumns([
                    'action'
                ])
                ->make(true);
        }
        return view('dashboard.pages.masterData.ruangan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard.pages.masterData.ruangan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRuanganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_ruangan' => 'required|unique:ruangan,nama_ruangan,NULL,id,deleted_at,NULL',
            ],
            [
                'nama_ruangan.required' => 'Nama Ruangan tidak boleh kosong',
                'nama_ruangan.unique' => 'Nama Ruangan sudah ada',
            ]

        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        if ($request->file_gambar == null) {
            return 'tidak_ada_gambar';
        } else {
            $no = 1;

            $dataRuangan = [
                'nama_ruangan' => $request->nama_ruangan,
                'deskripsi' => $request->deskripsi,
            ];
            $insertRuangan = Ruangan::create($dataRuangan);

            foreach ($request->file('file_gambar') as $val) {
                $namaFile = mt_rand() . '-' . $request->nama_ruangan . '-' . $no . '.' . $val->getClientOriginalExtension();
                $val->storeAs(
                    'upload/foto_ruangan/',
                    $namaFile
                );

                $dataFile = [
                    'another_id' => $insertRuangan->id,
                    'nama_file' => $namaFile,
                    'jenis_file' => 'Gambar',
                    'urutan' => $no,
                ];

                if ($no == 1) {
                    $dataFile['is_sampul'] = 1;
                }

                FileUpload::create($dataFile);
                $no++;
            }
        }

        return response()->json('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function show(Ruangan $ruangan)
    {
        $ruangan['created_at_'] = Carbon::parse($ruangan->created_at)->translatedFormat('j F Y H:i');
        $ruangan['updated_at_'] = Carbon::parse($ruangan->updated_at)->translatedFormat('j F Y H:i');
        $ruangan['created_by_'] = $ruangan->createdBy->nama_lengkap;
        $ruangan['updated_by_'] = $ruangan->updatedBy->nama_lengkap;
        $ruangan['jumlah_foto_'] = $ruangan->fileUploadGambar->count();
        $fotoRuangan = $ruangan->fileUploadGambar->pluck('nama_file');
        $tempFotoRuangan = [];
        foreach ($fotoRuangan as $val) {
            $init = Storage::exists('upload/foto_ruangan/' . $val) ? Storage::url('upload/foto_ruangan/' . $val) : asset('assets/img/blank_photo.png');
            $tempFotoRuangan[] = $init;
        }
        $ruangan['foto_ruangan_'] = $tempFotoRuangan;
        return $ruangan;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function edit(Ruangan $ruangan)
    {
        return view('dashboard.pages.masterData.ruangan.edit', compact('ruangan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRuanganRequest  $request
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ruangan $ruangan)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_ruangan' => 'required|unique:ruangan,nama_ruangan,' . $ruangan->nama_ruangan . ',nama_ruangan,deleted_at,NULL',
            ],
            [
                'nama_ruangan.required' => 'Nama Ruangan tidak boleh kosong',
                'nama_ruangan.unique' => 'Nama Ruangan sudah ada',
            ]

        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        foreach ($ruangan->fileUploadGambar as $item) {
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
                if (Storage::exists('upload/foto_ruangan/' . $namaFile)) {
                    Storage::delete('upload/foto_ruangan/' . $namaFile);
                }
                FileUpload::where('id', $item)->delete();
            }
        }

        $dataRuangan = [
            'nama_ruangan' => $request->nama_ruangan,
            'deskripsi' => $request->deskripsi,
        ];
        $ruangan->update($dataRuangan);

        if ($request->file_gambar !== null) {
            $no = $ruangan->fileUploadGambar->max('urutan') + 1;
            foreach ($request->file('file_gambar') as $val) {
                $namaFile = mt_rand() . '-' . $request->nama_ruangan . '-' . $no . '.' . $val->getClientOriginalExtension();
                $val->storeAs(
                    'upload/foto_ruangan/',
                    $namaFile
                );

                $dataFile = [
                    'another_id' => $ruangan->id,
                    'nama_file' => $namaFile,
                    'jenis_file' => 'Gambar',
                    'urutan' => $no,
                ];

                FileUpload::create($dataFile);
                $no++;
            }
        }
        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruangan $ruangan)
    {
        foreach ($ruangan->fileUploadGambar as $item) {
            $namaFile = $item->nama_file;
            if (Storage::exists('upload/foto_ruangan/' . $namaFile)) {
                Storage::delete('upload/foto_ruangan/' . $namaFile);
            }
            FileUpload::where('id', $item->id)->delete();
        }

        $ruangan->delete();
        return response()->json(['success' => 'Data berhasil dihapus']);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id as $id) {
            $ruangan = Ruangan::with('fileUploadGambar')->find($id);

            if ($ruangan->fileUploadGambar) {
                foreach ($ruangan->fileUploadGambar as $item) {
                    $namaFile = $item->nama_file;
                    if (Storage::exists('upload/foto_ruangan/' . $namaFile)) {
                        Storage::delete('upload/foto_ruangan/' . $namaFile);
                    }
                    FileUpload::where('id', $item->id)->delete();
                }
            }

            $ruangan->delete();
        }
        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
