<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgenteExterno extends Model
{
    use HasFactory;
    public $primaryKey  = 'Id_Agente_Externo';
    protected $table = 'Agente_Externo';
    public $timestamps = false;


}
