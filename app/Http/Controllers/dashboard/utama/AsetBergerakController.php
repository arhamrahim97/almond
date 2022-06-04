<?php

namespace App\Http\Controllers\dashboard\utama;

use App\Models\AsetBergerak;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AsetBergerakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pages.utama.asetBergerak.manajemenAset.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.utama.asetBergerak.manajemenAset.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAsetBergerakRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
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
     * @param  \App\Http\Requests\UpdateAsetBergerakRequest  $request
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
}
