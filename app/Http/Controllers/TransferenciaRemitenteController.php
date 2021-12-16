<?php

namespace App\Http\Controllers;

use App\Models\TransferenciaRemitente;
use Illuminate\Http\Request;

class TransferenciaRemitenteController extends Controller
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
        $data = json_decode(request()->get('modelo'));
        $data->Id_Transferencia_Remitente = $data->Id_Transferencia_Remitente;
        GiroRemitente::create((array)$data);
        return response()->json(['codigo' => 'success', 'titulo' => 'Exito', 'mensaje' => 'Remitente creado correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransferenciaRemitente  $transferenciaRemitente
     * @return \Illuminate\Http\Response
     */
    public function show(TransferenciaRemitente $transferenciaRemitente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransferenciaRemitente  $transferenciaRemitente
     * @return \Illuminate\Http\Response
     */
    public function edit(TransferenciaRemitente $transferenciaRemitente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransferenciaRemitente  $transferenciaRemitente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransferenciaRemitente $transferenciaRemitente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransferenciaRemitente  $transferenciaRemitente
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransferenciaRemitente $transferenciaRemitente)
    {
        //
    }
}
