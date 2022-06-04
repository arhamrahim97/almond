<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreRuanganRequest;
use App\Http\Requests\UpdateRuanganRequest;
use App\Models\FileUpload;
use GuzzleHttp\Promise\Create;
use PhpParser\Node\Stmt\Foreach_;

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
            $data = Ruangan::with('jabatanStruktural')->latest();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('checkData', function ($row) {
                    return $row->id;
                })
                ->addColumn('golongan_jabatan_pangkat', function ($row) {
                    return $row->jabatanStruktural->golongan . ' - ' . $row->jabatanStruktural->jabatan . ' - ' . $row->jabatanStruktural->pangkat;
                })

                ->addColumn('created_at', function ($row) {
                    return $row->created_at;
                })

                ->addColumn('created_by', function ($row) {
                    return $row->createdBy->nama_lengkap;
                })

                ->addColumn('updated_at', function ($row) {
                    return $row->updated_at;
                })

                ->addColumn('updated_by', function ($row) {
                    return $row->updatedBy->nama_lengkap;
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="text-center justify-content-center text-white">';
                    $actionBtn .= '<button id="btn-lihat" class="btn btn-primary btn-sm me-1 text-white shadow btn-lihat" data-toggle="tooltip" data-placement="top" title="Lihat" value="' . $row->id . '" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-eye"></i></button>';
                    $actionBtn .= ' <a href="' . route('pegawai.edit', $row->id) . '" id="btn-edit" class="btn btn-warning btn-sm mr-1 my-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fas fa-edit"></i></a>';
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
                'nama_ruangan' => 'required',
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
                $namaFile = $request->nama_ruangan . '-' . $no . '.' . $val->getClientOriginalExtension();
                $val->storeAs(
                    'upload/foto_ruangan/',
                    $namaFile .
                        '.' . $val->extension()
                );

                $dataFile = [
                    'another_id' => $insertRuangan->id,
                    'nama_file' => $namaFile,
                    'urutan' => $no,
                ];

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function edit(Ruangan $ruangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRuanganRequest  $request
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRuanganRequest $request, Ruangan $ruangan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruangan $ruangan)
    {
        //
    }
}
