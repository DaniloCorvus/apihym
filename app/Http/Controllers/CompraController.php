<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CompraController extends Controller
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
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
        // banco: null
        // titutlar: "1222"
        // valor: null
        
    public function filter(Request $request)
    {
        
        // " SELECT * FROM Tabla WHERE
        //  Nombre LIKE '%$_POST["cadenaBuscar"]%' "; 

        $filterBanco = '';
        
        if(request()->has('banco')){
            $q = request()->get('banco');
            $filterBanco .= " AND B.Apodo LIKE '%$q%' "  ;
        }
        
        if(request()->has('titutlar')){
            $q = request()->get('titutlar');
            $filterBanco .= " AND CB.Nombre_Titular LIKE '%$q%' ";
        }
        
        if(request()->has('valor')){
            $q = request()->get('valor');
            $filterBanco .= " AND CC.Valor LIKE '%$q%' ";
        }
        
        if(request()->has('moneda')){
            $q = request()->get('valor');
            $filterBanco .= " AND CB.Id_Moneda LIKE '%$q%' ";
        }
        
        $query = "SELECT 
				CC.Id_Compra_Cuenta,
				CC.Valor,
				CB.Id_Cuenta_Bancaria,
				CB.Nombre_Titular,
				CB.Numero_Cuenta,
				TC.Nombre AS Tipo_Cuenta,
				B.Apodo AS Banco,
				Moneda.Codigo,
				false AS Seleccionado
			FROM `Compra_Cuenta` CC 
			INNER JOIN Cuenta_Bancaria CB ON CB.Id_Cuenta_Bancaria = CC.Id_Cuenta_Bancaria
			INNER JOIN Banco B ON CB.Id_Banco = B.Id_Banco
			INNER JOIN Tipo_Cuenta TC ON CB.Tipo = TC.Id_Tipo_Cuenta
			INNER JOIN Moneda Moneda ON Moneda.Id_Moneda = CB.Id_Moneda
			WHERE 
				CC.Id_Compra IS NULL " . $filterBanco . " ORDER BY CB.Nombre_Titular";
				
				
			
        return response()->json(['codigo' => 'success', 'compras_pendientes' => DB::select($query) ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        //
    }
}
