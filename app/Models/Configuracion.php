<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    use HasFactory;
    protected $table = 'Configuracion';
    public $primaryKey  = 'Id_Configuracion';
    public $timestamps = false;

}
