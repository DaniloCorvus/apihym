<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corresponsal extends Model
{
    use HasFactory;
    public $primaryKey = 'Id_Corresponsal_Bancario';
    protected $table='Corresponsal_Bancario';
    protected $fillable = [
        'Id_Corresponsal_Bancario',
        'Nombre',
        'Cupo',
        'Id_Departamento',
        'Id_Municipio',
        'Departamento',
        'Municipio'
    ];
}
