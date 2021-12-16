<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    use HasFactory;
    protected $table = 'Moneda';
    public $primaryKey = 'Id_Moneda';

    public function ValorMoneda()
    {
        return $this->hasOne(Valormoneda::class, 'Id_Moneda', 'Id_Moneda');
    }
}
