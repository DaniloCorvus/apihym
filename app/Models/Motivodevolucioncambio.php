<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motivodevolucioncambio extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre','estado'
    ];
    protected $table = 'Motivo_Devolucion_Cambios';
}
