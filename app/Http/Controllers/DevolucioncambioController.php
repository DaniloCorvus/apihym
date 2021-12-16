<?php

namespace App\Http\Controllers;

use App\Models\Cambio;
use App\Models\Devolucioncambio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class DevolucioncambioController extends Controller
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
        $data = json_decode(request()->get('data'));
        $q = DB::table('Cambio As c')
            ->select(DB::raw('(c.Valor_Destino - IFNULL(dc.valor_recibido, 0 )) As venta_final'))
            ->leftJoin('Devolucion_Cambios As dc', 'c.Id_Cambio', '=', 'dc.cambio_id')
            ->Join('Moneda As mo', 'c.Moneda_Origen', '=', 'mo.Id_Moneda')
            ->Join('Moneda As md', 'c.Moneda_Destino', '=', 'md.Id_Moneda')
            ->whereDate('Fecha', Carbon::today())
            ->where('Id_Cambio', $data->Id_Cambio)
            ->first();

        $cambio = Cambio::with('devolucioncambios')->where('Id_Cambio', $data->Id_Cambio)->first();

        $saldo = $q->venta_final ? $q->venta_final : 0;

        if ($saldo <  $data->Valor_Devolver) {
            return response()->json(['codigo' => 404, 'message' => 'El valor a devolver supera el valor original']);
        }
        if (count($cambio->devolucioncambios) > 0) {
            return response()->json(['codigo' => 404, 'message' => 'Este movimiento ya tiene devoluciones']);
        }

        if (!isset($data->Observacion)) {
            $data->Observacion = '';
        }

        Devolucioncambio::create([
            'hora' => Carbon::now(),
            'cambio_id' => $data->Id_Cambio,
            'observacion' => ($data->Observacion) ? $data->Observacion : '',
            'motivodevolucioncambios_id' => $data->Motivo,
            'valor_recibido' => $data->Valor_Devolver,
            'valor_entregado' => $data->Valor_Devuelto,
        ]);

        return response()->json(['codigo' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Devolucioncambio  $devolucioncambio
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $cambio)
    {
        return response()->json(Cambio::find($cambio)->devolucioncambios()->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Devolucioncambio  $devolucioncambio
     * @return \Illuminate\Http\Response
     */
    public function edit(Devolucioncambio $devolucioncambio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Devolucioncambio  $devolucioncambio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Devolucioncambio $devolucioncambio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Devolucioncambio  $devolucioncambio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Devolucioncambio $devolucioncambio)
    {
        //
    }
}
