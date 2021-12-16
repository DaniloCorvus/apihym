<?php

namespace App\Http\Controllers;

use App\Models\Traslado;
use App\Models\TrasladoCaja;
use Illuminate\Http\Request;
use App\Models\Configuracion;
use Illuminate\Support\Facades\DB;
use \Barryvdh\DomPDF\Facade as PDF; 

class TrasladoController extends Controller
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
     * @param  \App\Models\Traslado  $traslado
     * @return \Illuminate\Http\Response
     */
    public function show(Traslado $traslado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Traslado  $traslado
     * @return \Illuminate\Http\Response
     */
    public function edit(Traslado $traslado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Traslado  $traslado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        try{
        $data = json_decode(request()->get('datos'), true );
        $traslado =  Traslado::firstWhere('Id_Traslado',$data['Id_Traslado'] );
        $traslado->Detalle = $data['Detalle'];
        $traslado->save();
        
         return response()->json(['cod' => 200, 'message' => 'Actualizacion correcta']);
        }catch(\Exception $th){
         return response()->json(['cod' => 400, 'message' => 'No se pudo completar actualizacion', 'errors' => $th->getMessage()]);
        }
        
       
    }
    
    
    public function filter(Request $request)
    {
        Traslado::all();
        return response()->json(Traslado::all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Traslado  $traslado
     * @return \Illuminate\Http\Response
     
     
     */
  
   public function print(Request $request)
    {
       
     $company = Configuracion::first();
     

        switch (request()->get('modulo')) {

            case 'traslado':

                 $traslado =  Traslado::
                   
                   leftJoin('Tercero as pt', function($join)
                          {
                            $join->on('Traslado.Id_Destino', '=', 'pt.Id_Tercero')
                              ->whereIN('Traslado.Destino', ['Cliente', 'Proveedor'] );
                          })
                   
                   ->leftJoin('Cuenta_Bancaria as pc', function($join)
                          {
                            $join->on('Traslado.Id_Destino', '=', 'pc.Id_Cuenta_Bancaria')
                              ->where('Traslado.Destino', 'Cuenta');
                          })
                   
                   
                   ->leftJoin('Tercero as ct', function($join)
                          {
                            $join->on('Traslado.Id_Origen', '=', 'ct.Id_Tercero')
                              ->whereIN('Traslado.Origen', ['Cliente', 'Proveedor'] );
                          })
                   
                   ->leftJoin('Cuenta_Bancaria as cc', function($join)
                          {
                            $join->on('Traslado.Id_Origen', '=', 'cc.Id_Cuenta_Bancaria')
                              ->where('Traslado.Origen', 'Cuenta');
                          })
                   
                                                                      
                    ->join('Moneda AS MO', 'Traslado.Moneda', 'MO.Id_Moneda')
                    ->join('Caja AS Ca', 'Traslado.Id_Caja', 'Ca.Id_Caja')
                   
                    ->join('Oficina AS Off', 'Off.Id_Oficina', 'Ca.Id_Oficina') 
                   
                    ->join('Funcionario', 'Traslado.Identificacion_Funcionario', 'Funcionario.Identificacion_Funcionario')
                   
                    ->select(
                   
                        'Traslado.*',
                        'MO.Codigo AS MoCodigo',
                        'Ca.Nombre AS NombreCaja',
                        'Off.Nombre AS NombreOficina',
                        'Off.Telefono AS TelefonoOficina',
                        'Off.Lema AS Lema',
                   
                   
                        DB::raw("IFNULL(pt.Nombre, pc.Alias) As 'Enviadoa' "),
                        DB::raw("IFNULL(ct.Nombre, cc.Alias) As 'Enviadopor' "),

                   
                        DB::raw("CONCAT(Funcionario.Nombres, ' ', Funcionario.Apellidos) AS full_name"),
                   
                    )
                    ->findOrFail(request()->get('id'));
                    
          

                $pdf = PDF::loadView('pdfs.otroTrasladoInvoice', compact('traslado', 'company'));
                $pdf->setPaper(array(0, 0, 200, 500), 'portrait'); //x inicio, y inicio, ancho final, alto final
                return $pdf->stream('invoice.pdf');
          
          
          		 case 'trasladoCaja':
          			
   

                 $traslado =  TrasladoCaja::
                   
                   
                   leftJoin('Funcionario as fd', function($join)
                          {
                            $join->on('Traslado_Caja.Funcionario_destino', '=', 'fd.Identificacion_Funcionario');
                          })
                   
                  
                   
                   
                   ->leftJoin('Funcionario as fo', function($join)
                          {
                            $join->on('Traslado_Caja.Id_Cajero_Origen', '=', 'fo.Identificacion_Funcionario');
                          })
                   
                  
                   
                                                                      
                    ->join('Moneda AS MO', 'Traslado_Caja.Id_Moneda', 'MO.Id_Moneda')
                    ->join('Caja AS Ca', 'Traslado_Caja.Id_Caja', 'Ca.Id_Caja')
                   
                    ->join('Oficina AS Off', 'Off.Id_Oficina', 'Ca.Id_Oficina') 
                   
                    ->join('Funcionario', 'Traslado_Caja.Identificacion_Funcionario', 'Funcionario.Identificacion_Funcionario')
                   
                    ->select(
                   			
                   		'Traslado_Caja.*',
                         DB::raw("CONCAT('Traslado Caja') As 'nameRecibo' "),
                        'Traslado_Caja.Estado As EstadoEntreCajas',
                        'MO.Codigo AS MoCodigo',
                        'Ca.Nombre AS NombreCaja',
                        'Off.Nombre AS NombreOficina',
                        'Off.Telefono AS TelefonoOficina',
                        'Off.Lema AS Lema',
                   
                   
                        DB::raw("CONCAT(fd.Nombres, ' ', fd.Apellidos) As 'Enviadoa' "),
                        DB::raw("CONCAT(fo.Nombres, ' ', fo.Apellidos) As 'Enviadopor' "),

                   
                        DB::raw("CONCAT(Funcionario.Nombres, ' ', Funcionario.Apellidos) AS full_name"),
                   
                    )
                    ->findOrFail(request()->get('id'));
                    

                $pdf = PDF::loadView('pdfs.otroTrasladoInvoice', compact('traslado', 'company'));
                $pdf->setPaper(array(0, 0, 200, 500), 'portrait'); //x inicio, y inicio, ancho final, alto final
                return $pdf->stream('invoice.pdf');
          
          
                break;
        }
 
    }
}
