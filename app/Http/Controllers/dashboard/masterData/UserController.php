<?php

namespace App\Http\Controllers\dashboard\masterData;;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;


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
                        return '<span class="badge badge-primary">Admin</span>';
                    } elseif ($row->role == 'Staf') {
                        return '<span class="badge badge-warning">Staf</span>';
                    }
                })


                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<span class="badge badge-success">Aktif</span>';
                    } else {
                        return '<span class="badge badge-danger">Tidak Aktif</span>';
                    }
                })

                ->addColumn('action', function ($row) {
                    // $actionBtn = '<div class="text-center justify-content-center text-white">';
                    // $actionBtn .= '<button id="btn-lihat" class="btn btn-primary btn-sm me-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Lihat" value="' . $row->id . '"><i class="fas fa-eye"></i></button>';
                    // $actionBtn .= '<a href="' . route('pegawai.edit', $row->id) . '" id="btn-edit" class="btn btn-warning btn-sm mr-1 my-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fas fa-edit"></i></a> ';
                    // if ($row->user->id != Auth::user()->id) {
                    //     $actionBtn .= '<button id="btn-delete" class="btn btn-danger btn-sm mr-1 my-1 text-white shadow" data-toggle="tooltip" data-placement="top" title="Hapus" value="' . $row->id . '"><i class="fas fa-trash"></i></button>';
                    // }
                    // $actionBtn .= '</div>';
                    // return $actionBtn;
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
