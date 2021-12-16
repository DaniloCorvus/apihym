<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferenciaRemitente extends Model
{
    use HasFactory;
       protected $table = 'Transferencia_Remitente';
       protected $primarykey = 'Id_Transferencia_Remitente';
       
        protected $fillable = [
        'Id_Transferencia_Remitente',
        'Telefono',
        'Nombre',
        'Estado'
    ];
    
      public $timestamps = false;
       
}
