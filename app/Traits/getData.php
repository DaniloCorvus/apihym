<?php

namespace App\Traits;

use App\Models\Configuracion;

/**
 * 
 */
trait getData
{
    public function createFields($datos)
    {
        $data = [];
        foreach ($datos as $index => $value) {
            $data[$index] = $value;
        }
        return $data;
    }
}
