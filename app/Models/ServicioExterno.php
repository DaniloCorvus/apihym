<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicioExterno extends Model
{
    use HasFactory;
    protected $table = 'Servicio';
    protected $primaryKey = 'Id_Servicio';
}
