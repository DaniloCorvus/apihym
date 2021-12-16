<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrasladoCaja extends Model
{
    use HasFactory;

    protected  $table = 'Traslado_Caja';
    public $primaryKey = "Id_Traslado_Caja";
    //protected $fillable = ['Detalle'];

    public function moneda()
    {
        return $this->hasOne(Moneda::class, 'Id_Moneda', 'Id_Moneda');
    }
}
