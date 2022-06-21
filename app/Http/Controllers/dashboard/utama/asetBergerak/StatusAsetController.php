<?php

namespace App\Http\Controllers\dashboard\utama\asetBergerak;


use App\Models\FileUpload;
use App\Models\AsetBergerak;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StatusAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pages.utama.asetBergerak.statusAset.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AsetBergerak  $asetBergerak
     * @return \Illuminate\Http\Response
     */
    public function show(AsetBergerak $asetBergerak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AsetBergerak  $asetBergerak
     * @return \Illuminate\Http\Response
     */
    public function edit(AsetBergerak $asetBergerak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AsetBergerak  $asetBergerak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AsetBergerak $asetBergerak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AsetBergerak  $asetBergerak
     * @return \Illuminate\Http\Response
     */
    public function destroy(AsetBergerak $asetBergerak)
    {
        //
    }

    public function ubahStatusAsetBergerak(Request $request)
    {
        $aset = AsetBergerak::find($request->id);

        $validator = Validator::make(
            $request->all(),
            [
                'status' => 'required',
            ],
            [
                'status.required' => 'Status tidak boleh kosong',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        // if ($request->nama_dokumen) {
        //     return 'ada';
        // } else {
        //     return 'tidak ada';
        // }
        $update = [
            'status' => $request->status,
        ];

        if (in_array($request->status, ['Dihibahkan', 'Dijual', 'Dimusnahkan'])) {
            $update['pegawai_id'] = null;
        }

        $aset->update($update);

        if (in_array($request->status, ['Hilang', 'Pengganti', 'Dihibahkan', 'Dijual', 'Dimusnahkan'])) {

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

            $no_dokumen = $aset->fileUploadDokumen->max('urutan') + 1;
            if ($request->nama_dokumen != null) {
                for ($i = 0; $i < $countFileDokumen; $i++) {
                    $namaFile = mt_rand() . '-' . $request->nama_dokumen[$i] . '-' . $request->nama_barang . '-' .  $no_dokumen . '.' . $request->file_dokumen[$i]->getClientOriginalExtension();
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

                    if (in_array($request->status, ['Hilang', 'Pengganti'])) {
                        $dataDokumen['pegawai_id'] = $aset->pegawai_id;
                    }

                    FileUpload::create($dataDokumen);
                    $no_dokumen++;
                }
            }
        }




        return 'success';
    }
}
