<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    use HasFactory;
    protected $table = 'Transferencia';
    public $primaryKey = "Id_Transferencia";

    public function moneda()
    {
        return $this->hasOne(Moneda::class, 'Id_Moneda', 'Moneda_Origen');
    }
}
