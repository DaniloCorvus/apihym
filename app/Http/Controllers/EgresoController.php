<?php

namespace App\Http\Controllers;

use App\Models\Egreso;
use App\Models\Moneda;
use App\Models\MovimientoTercero;
use App\Models\Movimientobancario;
use App\Models\Tercero;
use App\Traits\GenerateCode;
use App\Traits\getData;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class EgresoController extends Controller
{
    use GenerateCode;
    use getData;
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
        try {



            $datos = (array)json_decode(request()->get('modelo'));
            $oficina = json_decode(request()->get('oficina'));
            
            $datos['Id_Oficina'] = $oficina;


            $datos['Fecha'] = Carbon::now();
            $datos['Codigo'] = $this->generateCod('Egreso');
            unset($datos['Id_Egreso'], $datos['Id_Grupo']);
            $data = $this->createFields($datos);
            $egreso = Egreso::create($data);

            
            if($datos['Tipo'] != 'Cuentas') {
                
            $dataMovimiento['Fecha'] =  $datos['Fecha'];
            $dataMovimiento['Valor']  =  $datos['Valor'];
            $dataMovimiento['Id_Moneda_Valor'] = $datos['Id_Moneda'];
            $dataMovimiento['Tipo'] = 'Egreso';
            $dataMovimiento['Id_Tercero'] = $datos['Id_Tercero'];
            $dataMovimiento['Detalle'] = 'Egreso por ' . $datos['Valor'] . ' ' . $this->GetCodigoMoneda($datos['Id_Moneda']) . ' ' . ' con codigo ' . $datos['Codigo'];
            $dataMovimiento['Id_Tipo_Movimiento'] = '6';
            $dataMovimiento['Valor_Tipo_Movimiento'] = $egreso->Id_Egreso;
            $dataMovimiento['Estado'] = 'Activo';
            $movimiento = MovimientoTercero::create($dataMovimiento);
            
            }else{
                
            $dataMovimiento['Fecha'] =  $datos['Fecha'];
            $dataMovimiento['Fecha_Creacion'] =  $datos['Fecha'];
            $dataMovimiento['Valor']  =  $datos['Valor'];
            $dataMovimiento['Tipo'] = 'Ingreso';
            $dataMovimiento['Id_Cuenta_Bancaria'] = $datos['Id_Tercero'];
            $dataMovimiento['Detalle'] = 'Ingreso por ' . $datos['Valor'] . ' ' . $this->GetCodigoMoneda($datos['Id_Moneda']) . ' ' . ' con codigo ' . $datos['Codigo'];
            $dataMovimiento['Id_Tipo_Movimiento_Bancario'] = '6';
            $dataMovimiento['Valor_Tipo_Movimiento_Bancario'] = $egreso->id;
            $dataMovimiento['Estado'] = 'Activo';
            $dataMovimiento['Id_Funcionario'] =  $datos['Identificacion_Funcionario'];
            $movimiento = Movimientobancario::create($dataMovimiento);
              
            }
          

            return response()->json(['codigo' => 'success']);
        } catch (\Exception $th) {
            return response()->json(['codigo' => 'warning', 'Message' => $th->getMessage()]);
        }
    }

    function GetCodigoMoneda($id_moneda)
    {
        $codigo = Moneda::find($id_moneda, ['Nombre']);
        return $codigo->Nombre;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Egreso  $egreso
     * @return \Illuminate\Http\Response
     */
    public function show(Egreso $egreso)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Egreso  $egreso
     * @return \Illuminate\Http\Response
     */
    public function edit(Egreso $egreso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Egreso  $egreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Egreso $egreso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Egreso  $egreso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Egreso $egreso)
    {
        //
    }
}