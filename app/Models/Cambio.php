<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cambio extends Model
{
    use HasFactory;
    protected $table = 'Cambio';
    public $primaryKey  = 'Id_Cambio';
    public $timestamps = false;

    protected $fillable = [
        // 'Id_Cambio'
        'Tipo',
        'Codigo',
        'Observacion',
        'Fecha',
        'Id_Caja',
        'Id_Oficina',
        'Moneda_Origen',
        'Moneda_Destino',
        'Tasa',
        'Valor_Origen',
        'Valor_Destino',
        'TotalPago',
        'Vueltos',
        'Recibido',
        'Estado',
        'Identificacion_Funcionario',
        'Tercero_id',
        'fomapago_id'
    ];

    public function devolucioncambios()
    {
        return $this->hasMany(Devolucioncambio::class, 'cambio_id', 'Id_Cambio');
    }
    public function tercero()
    {
        /**   tabla del relacionado       tabla donde estoy parado */
        return $this->belongsTo(Tercero::class, 'Id_Tercero','Tercero_id');
    }

    public function moneda()
    {
        return $this->hasOne(Moneda::class, 'Id_Moneda', 'Moneda_Origen');
    }
}
