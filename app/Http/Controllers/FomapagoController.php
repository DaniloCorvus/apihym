<?php

namespace App\Http\Controllers;

use App\Models\Fomapago;
use Illuminate\Http\Request;

class FomapagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Fomapago::all());
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
     * @param  \App\Models\Fomapago  $fomapago
     * @return \Illuminate\Http\Response
     */
    public function show(Fomapago $fomapago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fomapago  $fomapago
     * @return \Illuminate\Http\Response
     */
    public function edit(Fomapago $fomapago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fomapago  $fomapago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fomapago $fomapago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fomapago  $fomapago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fomapago $fomapago)
    {
        //
    }
}
