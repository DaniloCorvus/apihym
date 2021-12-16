<?php

namespace App\Http\Controllers;

use App\Models\Corresponsal;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CorresponsalController extends Controller
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
     * @param  \App\Models\Corresponsal  $corresponsal
     * @return \Illuminate\Http\Response
     */
    public function show(Corresponsal $corresponsal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Corresponsal  $corresponsal
     * @return \Illuminate\Http\Response
     */
    public function edit(Corresponsal $corresponsal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Corresponsal  $corresponsal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = json_decode(request()->get('datos'));

        $corresponsal = Corresponsal::where('Id_Corresponsal_Bancario', $data->Id_Corresponsal_Bancario)->first();
        $corresponsal->Id_Municipio = $data->Municipio;
        $corresponsal->Id_Departamento = $data->Departamento;
        $corresponsal->Cupo = $data->Cupo;
        $corresponsal->Nombre = $data->Nombre;
        $corresponsal->save();
        return response()->json(['codigo' => 'success', 'titulo' => 'Exito', 'mensaje' => 'Corresponsal actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Corresponsal  $corresponsal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Corresponsal $corresponsal)
    {
        //
    }
}
