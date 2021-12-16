<?php

namespace App\Http\Controllers;

use App\Models\Transferencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TransferenciaCustomController extends Controller
{
   
   public function ubicarse ()
   {
       
       $transferencia = 
         DB::table('Transferencia_Destinatario')
         ->where('Id_Transferencia_Destinatario', request()
         ->get('Id_Transferencia_Destinatario')
         )->first();
         
         ($transferencia->Seleccionada == 1) ? $this->actualizarEstado(0, $transferencia->Id_Transferencia_Destinatario ): $this->actualizarEstado(1, $transferencia->Id_Transferencia_Destinatario );
         
        return response()->json('Ubicado correctamente', 200);
   }
   
   public function bloquear ()
   {
       
       $transferencia = 
         DB::table('Transferencia_Destinatario')
         ->where('Id_Transferencia_Destinatario', request()
         ->get('Id_Transferencia_Destinatario')
         )->first();
         
         
          
        DB::table('Transferencia_Destinatario')
         ->where('Id_Transferencia_Destinatario', request()
         ->get('Id_Transferencia_Destinatario')
         )->update(['Funcionario_Opera' => request()
         ->get('Funcionario')]);
         
         return ($transferencia->Estado_Consultor == 'Abierta') ? $this->actualizarBlockEstado('Cerrada', $transferencia->Id_Transferencia_Destinatario ): $this->actualizarBlockEstado('Abierta', $transferencia->Id_Transferencia_Destinatario );
         
   }
   
   public function actualizarEstado ($estado, $transferencia){
       
        /* DB::table('Transferencia_Destinatario')
         ->where('Id_Transferencia_Destinatario', $transferencia)
         ->update(['Seleccionada' => '0','Id_Transferencia_Destinatario'=>0]);*/
       
       
         DB::table('Transferencia_Destinatario')
         ->where('Id_Transferencia_Destinatario', $transferencia)
         ->update(['Seleccionada' => $estado]);
       
   }
   
   public function desbloquear (){
       
         DB::table('Transferencia_Destinatario')
         ->where('Id_Transferencia_Destinatario', request()->get('Id_Transferencia_Destinatario'))
         ->update(['Estado_Consultor' => 'Cerrada', 'Funcionario_Opera' => null ]);
       
   }
   
   public function actualizarBlockEstado ($estado, $transferencia){
       
        return DB::table('Transferencia_Destinatario')
         ->where('Id_Transferencia_Destinatario', $transferencia)
         ->update(['Estado_Consultor' => $estado]);
       
   }
   
   public function info (){
       
            return DB::table('Transferencia_Destinatario')
            ->where('Id_Transferencia_Destinatario', request()->get('Id_Transferencia_Destinatario'))->get();
   }
}