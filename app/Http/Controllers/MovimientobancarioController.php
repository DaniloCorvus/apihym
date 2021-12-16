<?php

namespace App\Http\Controllers;

use App\Models\Movimientobancario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovimientobancarioController extends Controller
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
     * @param  \App\Models\Movimientobancario  $movimientobancario
     * @return \Illuminate\Http\Response
     */
    public function show(Movimientobancario $movimientobancario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movimientobancario  $movimientobancario
     * @return \Illuminate\Http\Response
     */
    public function edit(Movimientobancario $movimientobancario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movimientobancario  $movimientobancario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movimientobancario $movimientobancario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movimientobancario  $movimientobancario
     * @return \Illuminate\Http\Response
     */
    public function deleteMovimiento()
    {
        $mov =  request()->get('mov');
        $id = $mov['Codigo_Movimiento'];
        
        if($mov['Tipo_Movimiento'] == 'Compra'){
        DB::Select("DELETE FROM `Movimiento_Cuenta_Bancaria` WHERE `Id_Movimiento_Cuenta_Bancaria` =  $id ");
        DB::Select("DELETE FROM `Compra_Cuenta` WHERE `Id_Compra_Cuenta` =  $id ");
        }
        
        if($mov['Tipo_Movimiento'] == 'Ajuste'){
        DB::Select("DELETE FROM `Movimiento_Cuenta_Bancaria` WHERE `Id_Movimiento_Cuenta_Bancaria` = $id ");
        }
        
        return response()->json('Movimiento Eliminado correctamente', 200);
    }
}
