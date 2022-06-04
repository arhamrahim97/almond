<?php

namespace App\Http\Controllers\dashboard\masterData;

use App\Models\Pegawai;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\JabatanStruktural;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdatePegawaiRequest;
use Carbon\Carbon;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pegawai::with('jabatanStruktural')->latest();
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
        return view('dashboard.pages.masterData.pegawai.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'jabatanStruktural' => JabatanStruktural::all(),
        ];
        return view('dashboard.pages.masterData.pegawai.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePegawaiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_lengkap' => 'required',
                'jenis_kelamin' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'nomor_hp' => 'required',
                'alamat' => 'required',
                'nip' => 'required|unique:pegawai,nip,NULL,id,deleted_at,NULL|digits:16',
                'jabatan_struktural_id' => 'required',
                'unit_kerja' => 'required',
                'foto_profil' => 'image|file|max:3072'
            ],
            [
                'nama_lengkap.required' => 'Nama lengkap tidak boleh kosong',
                'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong',
                'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong',
                'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong',
                'nomor_hp.required' => 'Nomor HP tidak boleh kosong',
                'alamat.required' => 'Alamat tidak boleh kosong',
                'nip.required' => 'NIP tidak boleh kosong',
                'nip.unique' => 'NIP sudah terdaftar',
                'nip.digits' => 'NIP harus 16 digit',
                'jabatan_struktural_id.required' => 'Golongan - Jabatan - Pangkat tidak boleh kosong',
                'unit_kerja.required' => 'Unit kerja tidak boleh kosong',
                'foto_profil.image' => 'Foto profil harus berupa gambar',
                'foto_profil.file' => 'Foto profil harus berupa file',
                'foto_profil.max' => 'Foto profil tidak boleh lebih dari 3 MB'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $data = $request->all();
        $data['tanggal_lahir'] = date('Y-m-d', strtotime($data['tanggal_lahir']));
        $data['jabatan_struktural_id'] = $data['jabatan_struktural_id'];
        if ($request->file('foto_profil')) {
            $request->file('foto_profil')->storeAs(
                'upload/foto_profil/pegawai/',
                $request->nip .
                    '.' . $request->file('foto_profil')->extension()
            );
            $data['foto_profil'] = $request->nip .
                '.' . $request->file('foto_profil')->extension();
        }

        Pegawai::create($data);
        return response()->json(['success' => 'Data berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        $pegawai['golongan_jabatan_pangkat'] = $pegawai->jabatanStruktural->golongan . ' - ' . $pegawai->jabatanStruktural->jabatan . ' - ' . $pegawai->jabatanStruktural->pangkat;
        $pegawai['created_at_'] = Carbon::parse($pegawai->created_at)->translatedFormat('j F Y H:i');
        $pegawai['updated_at_'] = Carbon::parse($pegawai->updated_at)->translatedFormat('j F Y H:i');
        $pegawai['created_by_'] = $pegawai->createdBy->nama_lengkap;
        $pegawai['updated_by_'] = $pegawai->updatedBy->nama_lengkap;
        $pegawai['cek_foto_profil'] = Storage::exists('upload/foto_profil/pegawai/' . $pegawai->foto_profil);
        $pegawai['foto_profil_'] = Storage::url('upload/foto_profil/pegawai/' . $pegawai->foto_profil);
        return $pegawai;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        $data = [
            'jabatanStruktural' => JabatanStruktural::all(),
            'pegawai' => $pegawai
        ];
        return view('dashboard.pages.masterData.pegawai.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePegawaiRequest  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $validateFotoProfil = '';
        if ($request->file('foto_profil')) {
            $fileName = $request->file('foto_profil');
            if ($fileName != $pegawai->foto_profil) {
                $validateFotoProfil = 'image|file|max:3072';
            }
        }

        $validator = Validator::make(
            $request->all(),
            [
                'nama_lengkap' => 'required',
                'jenis_kelamin' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'nomor_hp' => 'required',
                'alamat' => 'required',
                'nip' => 'required|unique:pegawai,nip,' . $pegawai->nip . ',nip,deleted_at,NULL|digits:16',
                'jabatan_struktural_id' => 'required',
                'unit_kerja' => 'required',
                'foto_profil' => $validateFotoProfil
            ],
            [
                'nama_lengkap.required' => 'Nama lengkap tidak boleh kosong',
                'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong',
                'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong',
                'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong',
                'nomor_hp.required' => 'Nomor HP tidak boleh kosong',
                'alamat.required' => 'Alamat tidak boleh kosong',
                'nip.required' => 'NIP tidak boleh kosong',
                'nip.unique' => 'NIP sudah terdaftar',
                'nip.digits' => 'NIP harus 16 digit',
                'jabatan_struktural_id.required' => 'Golongan - Jabatan - Pangkat tidak boleh kosong',
                'unit_kerja.required' => 'Unit kerja tidak boleh kosong',
                'foto_profil.image' => 'Foto profil harus berupa gambar',
                'foto_profil.file' => 'Foto profil harus berupa file',
                'foto_profil.max' => 'Foto profil tidak boleh lebih dari 3 MB'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $data = $request->all();
        $data['tanggal_lahir'] = date('Y-m-d', strtotime($data['tanggal_lahir']));
        $data['jabatan_struktural_id'] = $data['jabatan_struktural_id'];
        if ($request->file('foto_profil')) {
            if (Storage::exists('upload/foto_profil/pegawai/' . $pegawai->foto_profil)) {
                Storage::delete('upload/foto_profil/pegawai/' . $pegawai->foto_profil);
            }
            $request->file('foto_profil')->storeAs(
                'upload/foto_profil/pegawai/',
                $data['nip'] .
                    '.' . $request->file('foto_profil')->extension()
            );
            $data['foto_profil'] = $data['nip'] . '.' . $request->file('foto_profil')->extension();
        }

        $pegawai->update($data);
        return response()->json(['success' => 'Data berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        if (Storage::exists('upload/foto_profil/pegawai/' . $pegawai->foto_profil)) {
            Storage::delete('upload/foto_profil/pegawai/' . $pegawai->foto_profil);
        }
        $pegawai->delete();
        return response()->json(['success' => 'Data berhasil dihapus']);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id as $id) {
            $pegawai = Pegawai::find($id);
            if (Storage::exists('upload/foto_profil/pegawai/' . $pegawai->foto_profil)) {
                Storage::delete('upload/foto_profil/pegawai/' . $pegawai->foto_profil);
            }
            $pegawai->delete();
        }
        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
