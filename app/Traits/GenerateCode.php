<?php

namespace App\Traits;

use App\Models\Configuracion;

/**
 * 
 */
trait GenerateCode
{
    public function generateCod($modulo)
    {
        $index = $modulo;
        $confi = Configuracion::first();
        $confi->$index = $confi[$index] + 1;
        $confi->save();
        return  $confi["Prefijo_" . $index] . sprintf("%05d", $confi[$index]);
    }
}
