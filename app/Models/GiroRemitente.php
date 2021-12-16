<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiroRemitente extends Model
{
    use HasFactory;
    protected $table = 'Giro_Remitente';

    protected $fillable = [
        'Documento_Remitente',
        'Id_Tipo_Documento',
        'Nombre_Remitente',
        'Telefono_Remitente',
        'Estado'
    ];
}
