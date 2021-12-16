<?php

namespace App\Http\Controllers;

use App\Models\ServicioExterno;
use App\Models\MovimientoTercero;
use \stdClass;

use Illuminate\Http\Request;

class ServicioExternoController extends Controller
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
     * @param  \App\Models\ServicioExterno  $servicioExterno
     * @return \Illuminate\Http\Response
     */
    public function show(ServicioExterno $servicioExterno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServicioExterno  $servicioExterno
     * @return \Illuminate\Http\Response
     */
    public function edit(ServicioExterno $servicioExterno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServicioExterno  $servicioExterno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServicioExterno $servicioExterno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServicioExterno  $servicioExterno
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServicioExterno $servicioExterno)
    {
        //
    }
  
  public function locked(){
    
   // return response()->json(request()->all());
    
    
    
   			$servicio_externo = ServicioExterno::firstWhere('Id_Servicio', request()->get('id'));
    
    		$servicio_externo->locked = ($servicio_externo->locked) ? 0 :  1;
    
    		$servicio_externo->funcionario_locked = ($servicio_externo->locked) ? request()->get('funcionario') :  null;
              
    		$servicio_externo->save();
    
    		//DB::select("update Servicio set locked = where Id_Servicio = " . );
    
   		    return response()->json($servicio_externo);
    
    
  
  }
  
  
     public function translate(){
    
       
   			$servicio_externo = ServicioExterno::firstWhere('Id_Servicio', request()->get('id'));
    
    		$servicio_externo->Id_Funcionario_Destino = request()->get('funcionario');
              
    		$servicio_externo->save();
        
   		    return response()->json($servicio_externo);
    
    
  
  }
  
  public function terminar(){
    
       
            try {
              
              
              
               $servicio_externo = ServicioExterno::firstWhere('Id_Servicio', request()->get('id'));
              
                if (request()->file('archivo')) {
                  
                   
                  
                    $filename = '_' . time() . '.' . request()->file('archivo')->getClientOriginalExtension();
                  
                    request()->file('archivo')->move(public_path() . "/file", $filename);
                    $servicio_externo->evidence = $filename;
                    $servicio_externo->entrega = request()->descripcion;
                    $servicio_externo->estado = 'Pagado';
                    $servicio_externo->Fecha_Pago  = date("Y-m-d H:i:s");
                    $servicio_externo->save();
                  
                  
                    $oItem = new stdClass();
                    $oItem->Fecha = date('Y-m-d');
                    $oItem->Valor = $servicio_externo->Valor;
                    $oItem->Id_Moneda_Valor = 2;
                    $oItem->Tipo = 'Ingreso';
                    $oItem->Id_Tercero = request()->get('documento');
                    $oItem->Id_Funcionario = request()->get('funcionario');
                    $oItem->Detalle = request()->get('ObservacionByFinalizar');
                    $oItem->Id_Tipo_Movimiento = '12';
                    $oItem->Estado = 'Activo';
                    MovimientoTercero::create((Array)$oItem);
                  
                  
                    $oItem = new stdClass();
                    $oItem->Fecha = date('Y-m-d');
                    $oItem->Valor = $servicio_externo->Valor;
                    $oItem->Id_Moneda_Valor = 2;
                    $oItem->Tipo = 'Egreso';
                    $oItem->Id_Tercero = 111111;
                    $oItem->Id_Funcionario = request()->get('funcionario');
                    $oItem->Detalle = request()->get('ObservacionByFinalizar');
                    $oItem->Id_Tipo_Movimiento = '6';
                    $oItem->Estado = 'Activo';
                  
                  
                  	MovimientoTercero::create((Array)$oItem);

                  return response()->json('Registrado exitosamente', 200);
                  
                }
              
            } catch (\Throwable $th) {
                return response([$th->getMessage(), $th->getLine()]);
            }
    
    
  
  }
}
