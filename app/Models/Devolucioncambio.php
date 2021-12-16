<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devolucioncambio extends Model
{

    use HasFactory;

    protected  $table = 'Devolucion_Cambios';

    protected $fillable = [
        'hora',
        'observacion',
        'motivodevolucioncambios_id',
        'valor_recibido',
        'valor_entregado',
        'cambio_id'
    ];
}
