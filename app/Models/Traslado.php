<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traslado extends Model
{
    use HasFactory;

    protected  $table = 'Traslado';
    public $primaryKey = "Id_Traslado";
    protected $fillable = ['Detalle'];
    
    public $timestamps = false;
    

    public function moneda()
    {
        return $this->hasOne(Moneda::class, 'Id_Moneda', 'Moneda');
    }
}
