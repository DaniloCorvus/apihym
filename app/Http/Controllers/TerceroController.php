<?php

namespace App\Http\Controllers;

use App\Models\CuentaBancaria;
use App\Models\Tercero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TerceroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Tercero::all());
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
     * @param  \App\Models\Tercero  $tercero
     * @return \Illuminate\Http\Response
     */
    public function show(Tercero $tercero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tercero  $tercero
     * @return \Illuminate\Http\Response
     */
    public function edit(Tercero $tercero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tercero  $tercero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tercero $tercero)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tercero  $tercero
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tercero $tercero)
    {
        //
    }

    public function tercerosFilterForRecaudo()
    {


        try {

            if (request()->get('id_destinatario')) {

                $res = Tercero::where('Recaudo', 'Si')
                    ->where(function ($q) {

                        $q->Where('Id_Tercero', 'LIKE', '%' . request()->get('id_destinatario') . '%')
                            ->orWhere('Nombre', 'LIKE', '%' . request()->get('id_destinatario') . '%');
                    })->where('Recaudo', 'Si')
                    ->select('Nombre', 'Id_Tercero as id_destinatario', 'Porcentaje_Recauda')->take(10)->get();
            }

            if (request()->get('id_remitente')) {
                $res = Tercero::where(function ($q) {
                    $q->where('Id_Tercero', 'LIKE', '%' . request()->get('id_remitente') . '%');
                })
                    ->orWhere(function ($q) {
                        $q->where('Nombre', 'LIKE', '%' .  request()->get('id_remitente') . '%');
                    })
                    ->select('Nombre', 'Id_Tercero as id_remitente', 'Telefono', 'Porcentaje_Recauda')->take(10)->get();
            }
            return response()->json($res);
        } catch (\Exception $th) {
            return response()->json($th->getMessage);
        }
    }


    public function filter()
    {
        $filtro = request()->get('id_destinatario');

        if (request()->get('tipo') == 'Cuentas') {
            return response()->json(
                CuentaBancaria::where('Numero_Cuenta',  'LIKE', '%'  . $filtro . '%')
                    ->where('Id_Pais', 2)
                    ->select('Nombre_Titular as Nombre', 'Numero_Cuenta as Id_Tercero')
                    ->get()->take(10)
            );
        }

        if ($filtro == 0) {
            return response()->json(Tercero::where('Nombre',  'LIKE', '%'  . $filtro . '%')->where('Estado', 'Activo')->where('Tipo_Tercero', request()->all('tipo'))->take(10)->get());
        }
        return response()->json(Tercero::where('Id_Tercero',  'LIKE', '%'  . $filtro . '%')->where('Estado', 'Activo')->where('Tipo_Tercero', request()->all('tipo'))->take(10)->get());
    }



    public function tercerosFilter($filter)
    {
        return response()->json(Tercero::where('Tipo_Tercero', $filter)->where('Estado', 'Activo')->get());
    }
}
