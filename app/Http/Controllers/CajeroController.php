<?php

namespace App\Http\Controllers;

use App\Models\Cajero;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CajeroController extends Controller
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
     * @param  \App\Models\Cajero  $cajero
     * @return \Illuminate\Http\Response
     */
    public function show(Cajero $cajero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cajero  $cajero
     * @return \Illuminate\Http\Response
     */
    public function edit(Cajero $cajero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cajero  $cajero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cajero $cajero)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cajero  $cajero
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cajero $cajero)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cajero  $cajero
     * @return \Illuminate\Http\Response
     */
    public function filtro(Cajero $cajero)
    {
        try {
            
            $match = request()->get('match') ;
            
            $funcionario = DB::select("SELECT 
                                            CONCAT(Nombres, ' ', Apellidos) AS Nombre,
                                            Identificacion_Funcionario AS Id_Tercero
                                            FROM
                                            Funcionario 
                                            INNER JOIN Diario As Diario ON Diario.Id_Funcionario = Funcionario.Identificacion_Funcionario 
                                            WHERE
                                            Identificacion_Funcionario LIKE '%$match%'
                                            AND Diario.Fecha = Cast(CURRENT_DATE As Date)");
                                            
            // $funcionario = Funcionario::select(DB::raw('CONCAT(Nombres, ", ", Apellidos) AS Nombre'), 'Identificacion_Funcionario AS Id_Tercero')
            // ->where('Identificacion_Funcionario', 'LIKE', '%' . request()->get('match') . '%')
            
            // ->where(function($q){
            //     $q->where('Id_Perfil', 2)
            //     ->orWhere('Id_Perfil', 3);
            // })
            
            // ->get();
            return response()->json($funcionario);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
