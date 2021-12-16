<?php

namespace App\Http\Controllers;

use App\Traits\CierreCajaTraits;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class CalculosController extends Controller
{

    use CierreCajaTraits;

    public $fecha_inicio;
    public $fecha_fin = null;



    public $monedas = [];

    function calcularCajeroTotales()
    {

        $this->monedas = $this->getMonedas();

        $FullDatafuncionario = $this->getFullDatafuncionario(request()->get('id_funcionario'));
        $FullMontos = $this->getFullMontos($FullDatafuncionario);
        $amountTotalByOficina = $this->amountTotalByOficina($FullMontos);

        $keys = ['x', 'y'];
        $valores = [$amountTotalByOficina, $FullMontos];

        $resp = compact('amountTotalByOficina', 'FullMontos');

        return response()->json($resp);
    }

    function destructOficinas($FullMontos)
    {

        $funcionarios = [];

        foreach ($FullMontos as $oficina) {

            foreach ($oficina['Data'] as $item) {

                array_push($funcionarios, $item);
            }
        }
        return $funcionarios;
    }

    function calcularCajeroTotalesPrincipal()
    {
        $this->fecha_inicio = Carbon::now();
        $this->fecha_fin = request()->has('Fecha_fin');

        if (request()->has('Fecha_fin')) {

            $this->fecha_fin = Carbon::parse(request()->get('Fecha_fin'));
        }

        if (request()->has('Fecha_inicio')) {

            $this->fecha_inicio = Carbon::parse(request()->get('Fecha_inicio'));
        }

        $this->monedas = $this->getMonedas();

        $FullData = $this->getFullData(request()->get('id_funcionario'));
        $FullMontos = $this->getFullMontos($FullData);
        $amountTotalByOficina = $this->amountTotalByOficina($FullMontos);

        $keys = ['x', 'y'];
        $valores = [$amountTotalByOficina, $FullMontos];


        $FullMontos = $this->destructOficinas($FullMontos);
        $resp = compact('amountTotalByOficina', 'FullMontos');

        return response()->json($resp);
    }

    function amountTotalByOficina($montosByOficina)
    {

        $response = [];
        $moneda = '';
        $codigo = '';

        foreach ($montosByOficina as $index => $oficina) {

            $montos = [];
            $montos['Oficina'] = $oficina['Oficina'];
            $montos['Moneda'] = [];
            $montos['Saldo'] = [];
            foreach ($oficina['Data'] as $funcionario) {

                foreach ($funcionario['data'] as $k => $temporalData) {


                    $saldos = 0;

                    $montos['Moneda'][$k] = array('Nombre' => $temporalData['Nombre'], 'Codigo' => $temporalData['Codigo']);


                    foreach ($temporalData['Movimientos'] as $i => $movimiento) {

                        $saldos +=   ($movimiento['Ingreso_Total'] - $movimiento['Egreso_Total']);
                    }
                    $montos['Saldo'][$k][] = $saldos;
                }
            }

            array_push($response, $montos);
        }

        foreach ($response as $k =>  $res) {
            $temp = [];
            $total = 0;

            $dataByOficina[$k] = [];

            array_push($dataByOficina[$k], $res['Oficina']);

            foreach ($res['Moneda'] as $i => $moneda) {

                $temp['Moneda'] = $moneda;

                $total = array_sum($res['Saldo'][$i]);

                $temp['Monto'] = $total;

                $dataByOficina[$k]['Of'][$i] = $temp;
            }
        }

        return $dataByOficina;
    }

    function suma($total, $subTotal)
    {
        $total += $subTotal;
        return $total;
    }

    function getFullMontos($dataFuncionario)
    {

        $montosByFuncionario = [];
        $temp = [];

        foreach ($dataFuncionario['oficinas'] as $index => $oficinas) {

            $this->idOficina = $oficinas['Id_Oficina'];
            $temp[$oficinas['Oficina']] = [];

            foreach ($oficinas['funcionarios'] as  $i => $funcionario) {

                $this->id = $funcionario->Identificacion_Funcionario;

                $temp[$oficinas['Oficina']][] =

                    [
                        'Funcionario_identificacion' => $funcionario->Identificacion_Funcionario,
                        'Funcionario_Nombre' => $funcionario->Nombres,
                        'Funcionario_Apellido' => $funcionario->Apellidos,
                        'data' => $this->getInfo(),
                        'Id_Oficina' => $oficinas['Id_Oficina'],
                        'Oficina' => $oficinas['Oficina']
                    ];
            }

            array_push($montosByFuncionario, ['Oficina' => $oficinas['Oficina'], 'Data' => $temp[$oficinas['Oficina']]]);
        }

        return $montosByFuncionario;
    }
    function getFullDatafuncionario($id)
    {
        $dataFuncionario = [];

        foreach ($this->getOficinasFuncionario($id) as $index => $oficinaDependiente) {
            $dataFuncionario['oficinas'][$index]  =
                [
                    'funcionarios' => $this->getFuncionarios($oficinaDependiente->Id_Oficina),
                    'Oficina' => $oficinaDependiente->Nombre,
                    'Id_Oficina' => $oficinaDependiente->Id_Oficina
                ];
        }

        return $dataFuncionario;
    }
    function getFullData($id)
    {

        $dataFuncionario = [];

        foreach ($this->getOficinas() as $index => $oficinaDependiente) {

            $dataFuncionario['oficinas'][$index]  =
                [
                    'funcionarios' => $this->getFuncionarios($oficinaDependiente->Id_Oficina),
                    'Oficina' => $oficinaDependiente->Nombre,
                    'Id_Oficina' => $oficinaDependiente->Id_Oficina
                ];
        }

        return $dataFuncionario;
    }
    function getOficinasFuncionario($currentFuncionario)
    {
         return DB::select('SELECT offf.Id_Oficina, offf.Nombre From Cajero_Oficina as cofff
              INNER JOIN Oficina as offf ON offf.Id_Oficina = cofff.Id_Oficina
              WHERE Id_Cajero = '. $currentFuncionario);
    }
    function getOficinas()
    {

        $result    =   DB::select('SELECT offf.Id_Oficina, offf.Nombre FROM Oficina As offf WHERE offf.Estado = "Activa"');
        return  $result;
    }

    function getFuncionarios($oficina)
    {

        $inicio =  $this->fecha_inicio->format('Y-m-d');
        $fin = $this->fecha_fin->format('Y-m-d');

        return DB::select(
            "SELECT fun.Identificacion_Funcionario, fun.Nombres, fun.Apellidos, dia.Fecha FROM Diario as dia
                                                        INNER JOIN Funcionario as fun ON fun.Identificacion_Funcionario = dia.Id_Funcionario
                                                        INNER JOIN Oficina as offf On offf.Id_Oficina = dia.Oficina_Apertura
                                                        WHERE offf.Id_Oficina = $oficina
                                                        AND  dia.Fecha = '$fin'
                                                        -- AND  dia.Fecha <= '$fin'

                                                        "
        );



        //   return        DB::select('SELECT fun.Identificacion_Funcionario, fun.Nombres, fun.Apellidos From Cajero_Oficina as cof
        //                 INNER JOIN Funcionario as fun ON fun.Identificacion_Funcionario = cof.Id_Cajero
        //                 INNER JOIN Oficina as of ON of.Id_Oficina = cof.Id_Oficina
        //                 WHERE of.Id_Oficina =  '.$oficina.'
        //                 AND (fun.Id_Perfil = 3 or fun.Id_Perfil = 2 or fun.Id_Perfil = 6)');
    }
}
