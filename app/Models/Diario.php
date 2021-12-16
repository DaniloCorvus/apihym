<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diario extends Model
{
    use HasFactory;
    public $primaryKey = 'Id_Diario';
    protected $table = 'Diario';
    protected $fillable = [
        'Id_DiarioPrimaria',
        'Fecha',
        'Hora_Apertura',
        'Id_Funcionario',
        'Caja_Apertura',
        'Oficina_Apertura',
        'Caja_Cierre',
        'Oficina_Cierre',
        'Hora_Cierre',
        'Observacion'
    ];
}
