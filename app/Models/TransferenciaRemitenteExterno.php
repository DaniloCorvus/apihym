<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferenciaRemitenteExterno extends Model
{
    use HasFactory;
       protected $table = 'Transferencia_Remitente_Externo';
       protected $primarykey = 'Id_Transferencia_Remitente';
       
        protected $fillable = [
        'Id_Transferencia_Remitente',
        'Id_Agente_Externo',
        'Telefono',
        'Nombre',
        'Estado'
    ];
    
      public $timestamps = false;
       
}
