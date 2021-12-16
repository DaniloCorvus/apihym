<?php

namespace App\Traits;

use App\Models\Cambio;
use App\Models\CorresponsalDiario;
use App\Models\Diario;
use App\Models\DiarioMonedaCierre;
use App\Models\Giro;
use App\Models\Moneda;
use App\Models\Egreso;
use App\Models\Servicio;
use App\Models\Transferencia;
use App\Models\TrasladoCaja;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait  CierreCajaTraits
{

    public $id = '';
    public $idOficina = '';
    
    

    public function  getInfo()
    {

        $Monedas = $this->getMonedas();
        $resultado = collect();


        foreach ($Monedas as $moneda) {

            $data["Nombre"] = $moneda->Nombre;
            $data["Codigo"] = $moneda->Codigo;
            $data["Id"] = $moneda->Id_Moneda;
            $movimientos = [];

            $movimientos[] = $this->ConsultarIngresosEgresosCambios($moneda->Id_Moneda);
            $movimientos[] = $this->ConsultarIngresosEgresosTransferencias($moneda->Id_Moneda);
            $movimientos[] = $this->ConsultarIngresosEgresosGiros($moneda->Id_Moneda);
            $movimientos[] = $this->ConsultarIngresosEgresosTraslados($moneda->Id_Moneda);
            $movimientos[] = $this->ConsultarIngresosEgresosCorresponsal($moneda->Id_Moneda);
            $movimientos[] = $this->ConsultarIngresosEgresosServicios($moneda->Id_Moneda);
            $movimientos[] = $this->ConsultarEgresos($moneda->Id_Moneda);

            $data["Movimientos"] = $movimientos;
            $resultado->push($data);
        }
        
        return $resultado;
    }

    public function  getDataByCierre()
    {

        $this->id = request()->get("id");
        $Monedas = $this->getMonedas();
        $resultado = collect();


        foreach ($Monedas as $moneda) {

            $data["Nombre"] = $moneda->Nombre;
            $data["Codigo"] = $moneda->Codigo;
            $data["Id"] = $moneda->Id_Moneda;
            $movimientos = [];

            $movimientos[] = $this->ConsultarIngresosEgresosCambios($moneda->Id_Moneda);
            $movimientos[] = $this->ConsultarIngresosEgresosTransferencias($moneda->Id_Moneda);
            $movimientos[] = $this->ConsultarIngresosEgresosGiros($moneda->Id_Moneda);
            $movimientos[] = $this->ConsultarIngresosEgresosTraslados($moneda->Id_Moneda);
            $movimientos[] = $this->ConsultarIngresosEgresosCorresponsal($moneda->Id_Moneda);
            $movimientos[] = $this->ConsultarIngresosEgresosServicios($moneda->Id_Moneda);
            $movimientos[] = $this->ConsultarEgresos($moneda->Id_Moneda);

            $data["Movimientos"] = $movimientos;
            $resultado->push($data);
        }

        return $resultado;
    }


    public function ConsultarIngresosEgresosCambios($Id_Moneda)
    {


        $cambios = Cambio::where(function ($q) use ($Id_Moneda) {
            $q->where('Moneda_Destino',  $Id_Moneda)
                ->orWhere('Moneda_Origen',  $Id_Moneda);
        })
            ->whereDate("Fecha", $this->getFecha())
            ->where('Identificacion_Funcionario', $this->id)
            ->where('Id_Oficina', $this->idOficina)
            ->select(
                DB::raw("
                IFnull(SUM(
                Case
                WHEN Tipo = 'Compra' AND Moneda_Origen = $Id_Moneda AND Estado <> 'Anulado' AND Valor_Origen  IS NOT NULL  THEN 
                Valor_Origen
                Else 0
                END
                )
                +
                SUM(
                Case
                WHEN Tipo = 'Venta' AND fomapago_id <> 3 
                AND Moneda_Origen = $Id_Moneda AND Estado <> 'Anulado' AND Valor_Origen IS NOT NULL  THEN 
                Valor_Origen -  IfNull((SELECT SUM(dv.valor_entregado) From Devolucion_Cambios dv WHERE dv.cambio_id = Id_Cambio), 0) 
                Else 0
                END
                ), 0) As Ingreso_Total
                "),
                DB::raw("
                IFnull(SUM( Case
                WHEN Tipo = 'Compra' AND fomapago_id <> 3 AND Moneda_Destino = $Id_Moneda AND Estado <> 'Anulado' AND Valor_Destino IS NOT NULL  THEN 
                Valor_Destino
                Else 0
                END
                )
                +
                SUM(
                Case
                WHEN Tipo = 'Venta'  AND Moneda_Destino = $Id_Moneda AND Estado <> 'Anulado' AND Valor_Destino IS NOT NULL   THEN 
                Valor_Destino - IfNull((SELECT SUM(dv.valor_recibido) From Devolucion_Cambios dv WHERE dv.cambio_id = Id_Cambio), 0) 
                Else 0
                END
                ), 0)  As Egreso_Total
                "),
                DB::raw("'Cambios' as Nombre")
            )->first();

        return (!$cambios) ? ['Ingreso_Total' => '0', 'Nombre' => 'Cambios', 'Egreso_Total' => '0'] : $cambios;
    }



    public function ConsultarIngresosEgresosTransferencias($Id_Moneda)
    {

        $transferencias =   Transferencia::where('Moneda_Origen', $Id_Moneda)
            ->whereDate("Fecha", $this->getFecha())
            ->where('Identificacion_Funcionario', $this->id)
             ->where('Id_Oficina', $this->idOficina)
            ->whereIn('Estado',  ['Activa', 'Pagada'])
            ->select(
                DB::raw("Sum(IF(Forma_Pago <> 'Credito' AND Forma_Pago <> 'Consignacion',Cantidad_Recibida, 0 )) AS Ingreso_Total, 'Transferencias' as Nombre"),
                DB::raw('0 AS Egreso_Total')
            )
            ->groupByRaw('Moneda_Origen')
            ->first();


        return (!$transferencias) ? ['Ingreso_Total' => '0', 'Nombre' => 'Transferencias', 'Egreso_Total' => '0'] : $transferencias;
    }


    public function ConsultarIngresosEgresosGiros($Id_Moneda)
    {

        $giros =   Giro::where('Id_Moneda', $Id_Moneda)
            ->whereDate('Fecha', $this->getFecha())
             ->where('Id_Oficina', $this->idOficina)
            ->select(
                DB::raw("IfNull(Sum(CASE WHEN Estado <> 'Anulado' AND Identificacion_Funcionario = $this->id THEN Valor_Total Else 0 END), 0) AS Ingreso_Total"),
                DB::raw("IfNull(Sum(CASE WHEN Estado = 'Pagado' AND Funcionario_Pago = $this->id THEN Valor_Entrega Else 0 END), 0) AS Egreso_Total"),
                DB::raw("'Giros' as Nombre")
            )->first();

        return (!$giros) ? ['Ingreso_Total' => '0', 'Nombre' => 'Giros', 'Egreso_Total' => '0'] :  $giros;
    }

    public function ConsultarIngresosEgresosTraslados($Id_Moneda)
    {


        $Ingreso_Total = TrasladoCaja::where('Id_Moneda', $Id_Moneda)

                ->whereDate('Fecha_Traslado', $this->getFecha())
                ->where('Id_Oficina', $this->idOficina)
                ->where('Estado', 'Aprobado')
                ->where('Funcionario_Destino', $this->id)
                ->select(DB::raw('IF(sum(Valor) > 0, sum(Valor), 0) AS Ingreso_Total, "Traslados" as Nombre'))
                ->groupByRaw('Id_Moneda')->first();
                

        $Egreso_Total = TrasladoCaja::where('Id_Moneda', $Id_Moneda)

                ->whereDate('Fecha_Traslado', $this->getFecha())
                ->where('Id_Oficina', $this->idOficina)
                ->where('Estado', 'Aprobado')
                ->where('Id_Cajero_Origen', $this->id)
                ->select(DB::raw('IF(sum(Valor) > 0, sum(Valor), 0) AS Egreso_Total, "Traslados" as Nombre'))
                ->groupByRaw('Id_Moneda')->first();
                
                
                return [
                        'Ingreso_Total' => (gettype($Ingreso_Total) == 'object' ) ?  $Ingreso_Total->Ingreso_Total : 0, 
                        'Nombre' => 'Traslados',
                        'Egreso_Total' => (gettype($Egreso_Total) == 'object') ?  $Egreso_Total->Egreso_Total : 0
                    ];
                                 
               
    }


    public function ConsultarIngresosEgresosCorresponsal($Id_Moneda)
    {

        $corresponsales =   CorresponsalDiario::where('Id_Moneda', $Id_Moneda)

            ->whereDate('Fecha', $this->getFecha())
            ->where('Identificacion_Funcionario', $this->id)
            ->where('Id_Oficina', $this->idOficina)
            ->select(
                DB::raw('IF(sum(Consignacion) > 0, sum(Consignacion), 0) AS Ingreso_Total,  "Corresponsal" as Nombre'),
                DB::raw('IF(sum(Retiro) > 0, sum(Retiro), 0) AS Egreso_Total')
            )
            ->groupByRaw('Id_Moneda')
            ->first();

        return (!$corresponsales) ?  ['Ingreso_Total' => '0', 'Nombre' => 'Corresponsal', 'Egreso_Total' => '0'] : $corresponsales;
    }

    public function ConsultarIngresosEgresosServicios($Id_Moneda)
    {
      
       $Ingreso_Total = Servicio::where('Id_Moneda', $Id_Moneda)

            ->whereDate('Fecha', $this->getFecha())
            ->where('Identificacion_Funcionario', $this->id)
            ->where('Id_Oficina', $this->idOficina)
            ->select(
                DB::raw('IF(sum(Valor + Comision) > 0, sum(Valor + Comision), 0) AS Ingreso_Total, "Servicios" as Nombre '),
            )
            ->groupByRaw('Id_Moneda')
            ->first();
                

        $Egreso_Total = Servicio::where('Id_Moneda', $Id_Moneda)

            ->whereDate('Fecha_Pago', $this->getFecha())
            ->where('Id_Funcionario_Destino', $this->id)
            ->where('Id_Oficina', $this->idOficina)
           ->select(
                DB::raw('IF(sum(Valor + Comision) > 0, sum(Valor + Comision), 0) AS Egreso_Total, "Servicios" as Nombre '),
            )
            ->first();
                
                      
      return [
        'Ingreso_Total' => (gettype($Ingreso_Total) == 'object' ) ?  $Ingreso_Total->Ingreso_Total : 0, 
        'Nombre' => 'Servicios',
        'Egreso_Total' => (gettype($Egreso_Total) == 'object') ?  $Egreso_Total->Egreso_Total : 0
      ];            
      
      
       
    }

    public function ConsultarEgresos($Id_Moneda)
    {
        $egresos =   Egreso::where('Id_Moneda', $Id_Moneda)

            ->whereDate('Fecha', $this->getFecha())
            ->where('Identificacion_Funcionario', $this->id)
            ->where('Id_Oficina', $this->idOficina)
            ->where('Estado', '<>', 'Anulado')
            ->select(

                DB::raw('0 AS Ingreso_Total'),
                DB::raw('SUM(Valor) AS Egreso_Total, "Egresos" as Nombre ')
            )
            ->groupByRaw('Id_Moneda')
            ->first();
      
        
        return (!$egresos) ? ['Ingreso_Total' => 0, 'Nombre' => 'Egresos', 'Egreso_Total' => 0] :  $egresos;
    }

    public function getMonedas()
    {
        return Moneda::where('Estado', 'Activa')->get();
    }
    public function getFecha()
    {
      
      if($this->fecha_fin == null){
         return Carbon::now()->format('Y-m-d');
      }
       return Carbon::parse($this->fecha_fin)->format('Y-m-d');
    }

    public function guardarCierre()
    {
        $hoy = Carbon::now()->format('Y-m-d');
        $hora = Carbon::now()->format('h:mm:ss');
        try {
            $diarios = Diario::where('Fecha',  $hoy)->where('Hora_Cierre', '00:00:00')->get();
            foreach ($diarios as $diario) {
                if ($diario != null) {
                    $this->ActualizarDiario($diario);
                    $this->GuardarValoresCierre($diario);
                }
            }
            $response['tipo'] = 'success';
            $response['mensaje'] = 'Cierre satisfactorio!';
            echo json_encode($response);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    function ActualizarDiario($diario)
    {
        $diario->update([
            'Oficina_Cierre' => strval($diario->Oficina_Apertura),
            'Caja_Cierre' => strval($diario->Caja_Apertura),
            'Observacion' => 'Cierre automatico',
            'Hora_Cierre' => Carbon::now()->format('h:mm:ss')
        ]);
    }

    function GuardarValoresCierre($diario)
    {
        foreach ($this->getDataByCierre() as  $moneda) {
            $egresos = 0;
            $ingresos = 0;

            foreach ($moneda['Movimientos'] as $movimiento) {
                $egresos =  $egresos +  $movimiento['Egreso_Total'];
                $ingresos = $ingresos  +  $movimiento['Ingreso_Total'];
            };

            DiarioMonedaCierre::create([
                'Id_Diario' => $diario['Id_Diario'],
                'Id_Moneda' => $moneda['Id'],
                'Valor_Moneda_Cierre' =>  $ingresos - $egresos,
                'Valor_Diferencia' => 0,
                'Fecha_Registro' => Carbon::now(),
            ]);
        }
    }


    public function guardarCierreCajero()
    {

        try {

            $modelo = json_decode(request()->get('modelo'));
            $diario = Diario::where('Id_Funcionario',  $modelo->Id_Funcionario)->where('Hora_Cierre', '00:00:00')->first();
            $entregado = request()->get('entregado');
            $diferencias = request()->get('diferencias');

            if ($diario != null) {
                $this->ActualizarDiario($diario);
                $this->GuardarValoresCierreCajero($diario, $entregado, $diferencias);
            }

            $response['tipo'] = 'success';
            $response['mensaje'] = 'Cierre satisfactorio!';
            return response()->json($response);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }


    function GuardarValoresCierreCajero($diario, $entregado, $diferencias)
    {
        $dataEntregado = json_decode($entregado);
        $dataDiferencias = json_decode($diferencias);

        foreach ($this->getDataByCierre() as $i => $moneda) {
            DiarioMonedaCierre::create([
                'Id_Diario' => $diario['Id_Diario'],
                'Id_Moneda' => $moneda['Id'],
                'Valor_Moneda_Cierre' => $dataEntregado[$i],
                'Valor_Diferencia' =>  $dataDiferencias[$i],
                'Fecha_Registro' => Carbon::now(),
            ]);
        }
    }
}
