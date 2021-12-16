<?php

namespace App\Http\Controllers;

use App\Models\Diario;
use App\Models\DiarioMonedaCierre;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

class FuncionarioController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }


    /**
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            return  Funcionario::all();
        }
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
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function show(Funcionario $funcionario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function edit(Funcionario $funcionario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Funcionario $funcionario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funcionario $funcionario)
    {
        //
    }

    /**
     * Se actualiza el estado de la caja del funcionario recibido
     * @param \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function estadoCaja()
    {
        try{
             $d = Diario::where('Id_Funcionario', request()->get('id'))
                ->orderBy('Id_Diario', 'Desc')
                ->first();
                
        $d->Caja_Cierre = NULL ;
		$d->Oficina_Cierre = NULL;
		$d->Hora_Cierre = "00:00:00";
        $d->save();
                
        DiarioMonedaCierre::where('Id_Diario', $d->Id_Diario)
        ->delete();
        
       return  response()->json('Caja abierta Correctamente');
        }   catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
       

    }
}
