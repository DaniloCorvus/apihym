<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoTercero extends Model
{
    use HasFactory;
    protected $table = 'Movimiento_Tercero';
    protected $fillable = [
        'Fecha',
        'Valor',
        'Id_Moneda_Valor',
        'Tipo',
        'Id_Tercero',
        'Detalle',
        'Valor_Tipo_Movimiento',
        'Id_Tipo_Movimiento',
        'Estado',
    ];
    
    
     
}
