<?php

namespace App\Http\Controllers;
use App\Models\TransferenciaRemitenteExterno;
use App\Models\GiroRemitente;
use App\Models\GiroDestinatario;

use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class GiroRemitenteExternoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $data = json_decode(request()->get('modelo'));
        
        if($data->Tipo=='Transferencia'){
            
            
            $data->Id_Transferencia_Remitente = $data->Id_Transferencia_Remitente;
           
            unset($data->Tipo);
             TransferenciaRemitenteExterno::create((array)$data);
            return response()->json(['codigo' => 'success', 'titulo' => 'Exito', 'mensaje' => 'Remitente creado correctamente']);
                
        }/*else{
            if($data->Tipo=='destinatario'){
                  $data->Documento_Destinatario = $data->Id_Transferencia_Remitente;
                $data->Nombre_Destinatario = $data->Nombre;
                $data->Telefono_Destinatario = $data->Telefono;
                $data->Id_Tipo_Documento = 1;
                GiroDestinatario::create((array)$data);
              $mensaje = 'Destinatario creado correctamente';
            }
            else{
                
            $data->Documento_Remitente = $data->Id_Transferencia_Remitente;
            $data->Nombre_Remitente = $data->Nombre;
            $data->Telefono_Remitente = $data->Telefono;
              GiroRemitente::create((array)$data);
              $mensaje = 'Remitente creado correctamente';
            }
            return response()->json(['codigo' => 'success', 'titulo' => 'Exito', 'mensaje'=>$mensaje]);
            
        }*/
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GiroRemitente  $giroRemitente
     * @return \Illuminate\Http\Response
     */
    public function show(GiroRemitente $giroRemitente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GiroRemitente  $giroRemitente
     * @return \Illuminate\Http\Response
     */
    public function edit(GiroRemitente $giroRemitente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GiroRemitente  $giroRemitente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GiroRemitente $giroRemitente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GiroRemitente  $giroRemitente
     * @return \Illuminate\Http\Response
     */
    public function destroy(GiroRemitente $giroRemitente)
    {
        //
    }
}
