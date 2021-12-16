<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimientobancario extends Model
{
    protected $table = 'Movimiento_Cuenta_Bancaria';
    public $primaryKey = 'Id_Tipo_Movimiento_Bancario';
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
}
