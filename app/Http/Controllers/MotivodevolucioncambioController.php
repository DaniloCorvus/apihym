<?php

namespace App\Http\Controllers;

use App\Models\MotivoDevolucion;
use App\Models\Motivodevolucioncambio;
use Illuminate\Http\Request;

class MotivodevolucioncambioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Motivodevolucioncambio::all());
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
        $data = json_decode(request()->get('data'));
        return response()->json(Motivodevolucioncambio::create([
            'nombre' => $data->nombre
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Motivodevolucioncambio  $motivodevolucioncambio
     * @return \Illuminate\Http\Response
     */
    public function show(Motivodevolucioncambio $motivodevolucioncambio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Motivodevolucioncambio  $motivodevolucioncambio
     * @return \Illuminate\Http\Response
     */
    public function edit(Motivodevolucioncambio $motivodevolucioncambio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Motivodevolucioncambio  $motivodevolucioncambio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Motivodevolucioncambio $motivodevolucioncambio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Motivodevolucioncambio  $motivodevolucioncambio
     * @return \Illuminate\Http\Response
     */
    public function destroy($motivodevolucioncambio)
    {
        
       
        
    $motivodevolucioncambio = Motivodevolucioncambio::find($motivodevolucioncambio);
    
       $motivodevolucioncambio->estado =  $motivodevolucioncambio->estado == 'Inactivo' ? 'Activo' : 'Inactivo';
        
          $motivodevolucioncambio->save();
        
        
        
        return response()->json($motivodevolucioncambio);
    }
}
