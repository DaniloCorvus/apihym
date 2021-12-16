<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorresponsalDiario extends Model
{
    use HasFactory;

    protected  $table = 'Corresponsal_Diario_Nuevo';
    public $primaryKey = 'Id_Corresponsal_Diario';
    protected $fillable = [
        'Consignacion',
        'Fecha',
        'Hora',
        'Id_Caja',
        'Id_Moneda',
        'Id_Oficina',
        'Identificacion_Funcionario',
        'Retiro',
        'Total_Corresponsal',
    ];

    public function moneda()
    {
        return $this->hasOne(Moneda::class, 'Id_Moneda', 'Moneda');
    }
}
