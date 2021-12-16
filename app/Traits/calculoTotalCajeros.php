<?php

namespace App\Traits;

use App\Models\Cambio;
use App\Models\CorresponsalDiario;
use App\Models\Diario;
use App\Models\DiarioMonedaCierre;
use App\Models\Giro;
use App\Models\Moneda;
use App\Models\Servicio;
use App\Models\Transferencia;
use App\Models\TrasladoCaja;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait  calculoTotalCajeros
{
    use CierreCajaTraits;
    
     public function getTotal()
     {
        return $this->getInfo();
     }
}