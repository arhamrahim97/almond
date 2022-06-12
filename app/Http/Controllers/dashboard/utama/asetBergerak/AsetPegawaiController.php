<?php

namespace App\Http\Controllers\dashboard\utama\asetBergerak;

use App\Models\AsetBergerak;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AsetPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('berhasil');
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
     * @param  \App\Models\AsetPegawai  $asetPegawai
     * @return \Illuminate\Http\Response
     */
    public function show(AsetBergerak $asetPegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AsetPegawai  $asetPegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(AsetBergerak $asetPegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AsetPegawai  $asetPegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AsetBergerak $asetPegawai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AsetPegawai  $asetPegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(AsetBergerak $asetPegawai)
    {
        //
    }
}
