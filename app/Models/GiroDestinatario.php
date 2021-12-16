<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiroDestinatario extends Model
{
    use HasFactory;
    protected $table = 'Giro_Destinatario';
    protected $primarykey = 'Documento_Destinatario';
    public $timestamps = false;
    
      protected $fillable = [
        'Documento_Destinatario',
        'Nombre_Destinatario',
        'Telefono_Destinatario',
        'Id_Tipo_Documento',
       
    ];
    
      
    
}
