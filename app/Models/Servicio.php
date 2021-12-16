<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected  $table = 'Servicio';

    public function moneda()
    {
        return $this->hasOne(Moneda::class, 'Id_Moneda', 'Id_Moneda');
    }
}
