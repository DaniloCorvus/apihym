<?php

namespace App\Http\Controllers;

use App\Models\Giro;
use Illuminate\Http\Request;

class GiroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Giro  $giro
     * @return \Illuminate\Http\Response
     */
    public function show(Giro $giro)
    {
        return response()->json($giro);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Giro  $giro
     * @return \Illuminate\Http\Response
     */
    public function edit(Giro $giro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Giro  $giro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Giro $giro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Giro  $giro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Giro $giro)
    {
        //
    }
}
