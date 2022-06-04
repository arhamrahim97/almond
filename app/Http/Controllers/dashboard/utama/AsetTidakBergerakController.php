<?php

namespace App\Http\Controllers\dashboard\utama;

use Illuminate\Http\Request;
use App\Models\AsetTidakBergerak;
use App\Http\Controllers\Controller;

class AsetTidakBergerakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pages.utama.asetTidakBergerak.manajemenAset.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.utama.asetTidakBergerak.manajemenAset.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAsetTidakBergerakRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'gambar.required' => 'Gambar tidak boleh kosong',
                'gambar.image' => 'Gambar harus berupa gambar',
                'gambar.mimes' => 'Gambar harus berupa jpeg,png,jpg,gif,svg',
                'gambar.max' => 'Gambar tidak boleh lebih dari 2MB',
            ]

        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $gambar = $request->file('gambar');

        $temp = [];
        foreach ($gambar as $row) {
            $gambar = $row->getClientOriginalName();
            // $row->move('images/asetTidakBergerak', $gambar);
            array_push($temp, $gambar);
        }
        // $data = [];
        // foreach ($request->file('imageFile') as $row) {
        //     array_push($data, $row->getClientOriginalName());
        // }
        // return $data;
        return $temp;
        // return $image;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AsetTidakBergerak  $asetTidakBergerak
     * @return \Illuminate\Http\Response
     */
    public function show(AsetTidakBergerak $asetTidakBergerak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AsetTidakBergerak  $asetTidakBergerak
     * @return \Illuminate\Http\Response
     */
    public function edit(AsetTidakBergerak $asetTidakBergerak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAsetTidakBergerakRequest  $request
     * @param  \App\Models\AsetTidakBergerak  $asetTidakBergerak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AsetTidakBergerak $asetTidakBergerak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AsetTidakBergerak  $asetTidakBergerak
     * @return \Illuminate\Http\Response
     */
    public function destroy(AsetTidakBergerak $asetTidakBergerak)
    {
        //
    }
}
