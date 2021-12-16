<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiarioMonedaCierre extends Model
{

    // Diario_Moneda_Cierre
    use HasFactory;

    use HasFactory;
    public $primaryKey = 'Id_Diario_Moneda_Cierre';
    protected $table = 'Diario_Moneda_Cierre';
    protected $fillable = [
        'Id_Diario',
        'Id_Moneda',
        'Valor_Moneda_Cierre',
        'Valor_Diferencia',
        'Fecha_Registro'
    ];

    
}
