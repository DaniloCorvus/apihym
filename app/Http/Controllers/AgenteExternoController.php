<?php

namespace App\Http\Controllers;

use App\Models\AgenteExterno;
use Illuminate\Http\Request;

class AgenteExternoController extends Controller
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
     * @param  \App\Models\AgenteExterno  $agenteExterno
     * @return \Illuminate\Http\Response
     */
    public function show(AgenteExterno $agenteExterno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AgenteExterno  $agenteExterno
     * @return \Illuminate\Http\Response
     */
    public function edit(AgenteExterno $agenteExterno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AgenteExterno  $agenteExterno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AgenteExterno $agenteExterno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AgenteExterno  $agenteExterno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $Request)
    {
        $agente = AgenteExterno::where('Id_Agente_Externo', request()->get('id_agente'))->first();
        $agente->Estado = ($agente->Estado == 'Activo') ? 'Inactivo' : 'Activo';
        $agente->save();
        return response()->json(['data' => $agente]);
    }
}
