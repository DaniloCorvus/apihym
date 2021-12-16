<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logsistema extends Model
{
    use HasFactory;
    protected $table = 'Log_Sistema';
    public $primaryKey  = 'Id_Log_Sistema';
    public $timestamps = false;

    protected $fillable = [
        'Id_Funcionario',
        'Accion',
        'Detalle',
        'Fecha_Registro'
    ];
}
