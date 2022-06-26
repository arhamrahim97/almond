<?php

namespace App\Http\Controllers\dashboard\masterData;;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('role', function ($row) {
                    if ($row->role == 'Admin') {
                        if ($row->id == '5gf9ba91-4778-404c-aa7f-5fd327e87e80') {
                            return '<span class="badge badge-danger fw-bold">Super Admin</span>';
                        } else {
                            return '<span class="badge badge-primary fw-bold">Admin</span>';
                        }
                    } elseif ($row->role == 'Staf') {
                        return '<span class="badge badge-secondary  fw-bold">Staf</span>';
                    }
                })


                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<span class="badge fw-bold badge-success">Aktif</span>';
                    } else {
                        return '<span class="badge fw-bold badge-danger">Tidak Aktif</span>';
                    }
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="text-center justify-content-center text-white">';
                    if ($row->role == 'Admin') {
                        if (Auth::user()->id == '5gf9ba91-4778-404c-aa7f-5fd327e87e80') {
                            if ($row->id != '5gf9ba91-4778-404c-aa7f-5fd327e87e80') {
                                $actionBtn .= ' <a href="' . route('akun.edit', $row->id) . '" id="btn-edit" class="btn btn-warning btn-sm mr-1 my-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fas fa-edit"></i></a>';
                                $actionBtn .= '<button id="btn-delete" class="btn btn-danger btn-sm mr-1 my-1 text-white shadow btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus" value="' . $row->id . '"><i class="fas fa-trash"></i></button>';
                            }
                        }
                        // else {
                        //     if ($row->id == Auth::user()->id) {
                        //         $actionBtn .= '<a href="' . route('akun.edit', $row->id) . '" id="btn-edit" class="btn btn-warning btn-sm mr-1 my-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fas fa-edit"></i></a>';
                        //     }
                        // }
                    } else {
                        $actionBtn .= ' <a href="' . route('akun.edit', $row->id) . '" id="btn-edit" class="btn btn-warning btn-sm mr-1 my-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fas fa-edit"></i></a>';
                        $actionBtn .= '<button id="btn-delete" class="btn btn-danger btn-sm mr-1 my-1 text-white shadow btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus" value="' . $row->id . '"><i class="fas fa-trash"></i></button>';
                    }
                    $actionBtn .= '</div>';
                    return $actionBtn;
                })

                ->rawColumns([
                    'action',
                    'role',
                    'status'
                ])
                ->make(true);
        }
        return view('dashboard.pages.masterData.akun.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.masterData.akun.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_lengkap' => 'required',
                'username' => 'required|unique:users,username,NULL,id,deleted_at,NULL|min:4',
                'password' => 'required|min:6',
                'role' => 'required',
                'status' => 'required',

            ],
            [
                'nama_lengkap.required' => 'Nama lengkap tidak boleh kosong',
                'username.required' => 'Username tidak boleh kosong',
                'username.unique' => 'Username sudah terdaftar',
                'username.min' => 'Username minimal 4 karakter',
                'password.required' => 'Password tidak boleh kosong',
                'password.min' => 'Password minimal 6 karakter',
                'role.required' => 'Role tidak boleh kosong',
                'status.required' => 'Status tidak boleh kosong',



            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $data = $request->all();

        $data['password'] = Hash::make($request->password);

        User::create($data);

        return response()->json('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $akun
     * @return \Illuminate\Http\Response
     */
    public function show(User $akun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $akun
     * @return \Illuminate\Http\Response
     */
    public function edit(User $akun)
    {
        return view('dashboard.pages.masterData.akun.edit', compact('akun'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $akun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $akun)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_lengkap' => 'required',
                'username' => 'required|unique:users,username,' . $akun->username . ',username,deleted_at,NULL|min:4',
                // 'password' => 'min:6',
                'role' => 'required',
                'status' => 'required',

            ],
            [
                'nama_lengkap.required' => 'Nama lengkap tidak boleh kosong',
                'username.required' => 'Username tidak boleh kosong',
                'username.unique' => 'Username sudah terdaftar',
                'username.min' => 'Username minimal 4 karakter',
                // 'password.min' => 'Password minimal 6 karakter',
                'role.required' => 'Role tidak boleh kosong',
                'status.required' => 'Status tidak boleh kosong',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'role' => $request->role,
            'status' => $request->status,
        ];

        if ($request->password != null) {
            $data['password'] = Hash::make($request->password);
        }

        $akun->update($data);
        return $request->all();
        // return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $akun
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $akun)
    {
        $akun->delete();
        return response()->json('success');
    }

    public function updateAkun(Request $request, User $akun)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_lengkap_' => 'required',
                'username_' => 'required|unique:users,username,' . $akun->username . ',username,deleted_at,NULL|min:4',
            ],
            [
                'nama_lengkap_.required' => 'Nama lengkap tidak boleh kosong',
                'username_.required' => 'Username tidak boleh kosong',
                'username_.unique' => 'Username sudah terdaftar',
                'username_.min' => 'Username minimal 4 karakter',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $data = [
            'nama_lengkap' => $request->nama_lengkap_,
            'username' => $request->username_,
        ];

        if ($request->password_ != null) {
            $data['password'] = Hash::make($request->password_);
        }

        $akun->update($data);

        return response()->json('success');
    }
}
