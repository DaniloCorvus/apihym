<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giro extends Model
{
    use HasFactory;
    protected  $table = 'Giro';
    protected  $primaryKey = 'Id_Giro';
    
    protected $guard = [];

    public function moneda()
    {
        return $this->hasOne(Moneda::class, 'Id_Moneda', 'Id_Moneda');
    }
}
