<?php

namespace App\Http\Controllers;

use App\Models\Cambio;
use App\Models\Moneda;
use App\Models\Tercero;
use App\Models\Devolucioncambio;
use App\Models\Logsistema;
use App\Models\MotivoDevolucion;
use App\Models\Motivodevolucioncambio;
use App\Models\Transferencia;
use App\Models\Configuracion;
use App\Models\Egreso;
use App\Models\MovimientoTercero;
use App\Traits\GenerateCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Barryvdh\DomPDF\Facade as PDF;

class CambioController extends Controller
{

    use GenerateCode;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        try {
            $query_data = DB::table('Cambio As c')
                ->select('c.*', 'mo.Codigo as codigo_origen', 'md.Codigo as codigo_destino', 'dc.valor_recibido', DB::raw('((c.Valor_Destino - IFNULL(dc.valor_recibido, 0))) As venta_final'))
                ->leftJoin('Devolucion_Cambios As dc', 'c.Id_Cambio', '=', 'dc.cambio_id')
                ->Join('Moneda As mo', 'c.Moneda_Origen', '=', 'mo.Id_Moneda')
                ->Join('Moneda As md', 'c.Moneda_Destino', '=', 'md.Id_Moneda')
                ->whereDate('Fecha', Carbon::today())
                ->where('Identificacion_Funcionario', request()->get('funcionario'))
                ->orderBy('c.Fecha', 'desc')->get();

            return response()->json(['codigo' => 'success', 'query_data' => $query_data]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {


            DB::beginTransaction();
            $code =  $this->generateCod(request()->get('modulo'));
            $datos = json_decode(request()->get('datos'));
            $tercero =  (isset($datos->Id_Tercero) && $datos->Id_Tercero != '' && $datos->Id_Tercero != null) ? $datos->Id_Tercero : null;

            $cambio = Cambio::create([
                'Tipo' => $datos->Tipo,
                'Codigo' =>  $code,
                'Observacion' =>  (isset($datos->observacion)) ? $datos->observacion : '' ,
                'Fecha' => Carbon::now(),
                'Id_Caja' => $datos->Id_Caja,
                'Id_Oficina' => $datos->Id_Oficina,
                'Moneda_Origen' => $datos->Moneda_Origen,
                'Moneda_Destino' => $datos->Moneda_Destino,
                'Tasa' => $datos->Tasa,
                'Valor_Origen' => ($datos->Tipo == 'Venta') ? $datos->Valor_Destino :  $datos->Valor_Origen,
                'Valor_Destino' => ($datos->Tipo == 'Venta') ?  $datos->Valor_Origen :  $datos->Valor_Destino,
                'TotalPago' => ($datos->TotalPago == '') ? 0 : $datos->TotalPago,
                'Vueltos' => $datos->Vueltos,
                'Recibido' => ($datos->Recibido) ? $datos->Recibido : 0,
                'Estado' => $datos->Estado,
                'Identificacion_Funcionario' => $datos->Identificacion_Funcionario,
                'Tercero_id' => ($tercero == null) ? null : $tercero->Id_Tercero,
                'fomapago_id' =>  $datos->fomapago,
            ]);

            Logsistema::create([
                'Id_Funcionario' => $datos->Identificacion_Funcionario,
                'Accion' => request()->get('modulo'),
                'Detalle' => "Nuevo cambio de divisas de tipo: $datos->Tipo !",
                'Fecha_Registro' => Carbon::now(),
            ]);
            DB::commit();


            if ($datos->fomapago == 3) {
                $datos->Id_Cambio = $cambio->Id_Cambio;
                $datos->Id_Tercero = $tercero->Id_Tercero;
                $this->guardarMovimiento($datos);
            }



            return  response()->json('ok');
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json($th->getMessage(), 400);
        }
    }

    public function guardarMovimiento($datos)
    {
        // return response()->json($datos);

        if ($datos->Tipo == 'Venta') {
            $oItem = new MovimientoTercero();
            $oItem->Fecha = date("Y-m-d H:i:s");
            $oItem->Tipo = "Egreso";
            $oItem->Valor = ($datos->Tipo == 'Venta') ? $datos->Valor_Destino :  $datos->Valor_Origen;
            $oItem->Detalle = "Nuevo cambio de divisas de tipo: $datos->Tipo !";
            $oItem->Id_Moneda_Valor =  2;
            $oItem->Id_Tipo_Movimiento = '2';
            $oItem->Valor_Tipo_Movimiento = $datos->Id_Cambio;
            $oItem->Id_Tercero = $datos->Id_Tercero;
            $oItem->Id_Funcionario = $datos->Identificacion_Funcionario;
            $oItem->Estado = 'Activo';
            $oItem->save();

            //	$this->DescontarCupo($datos["Documento_Origen"], $datos['Cantidad_Recibida']);

            $tercero = Tercero::find($datos->Id_Tercero);
            $tercero->Cupo_Disponible = $tercero->Cupo_Disponible - $oItem->Valor;
            $tercero->save();
        } else {

            $oItem = new MovimientoTercero();
            $oItem->Fecha = date("Y-m-d H:i:s");
            $oItem->Tipo = "Ingreso";
            $oItem->Valor = ($datos->Tipo == 'Compra') ?  $datos->Valor_Destino :  $datos->Valor_Origen;
            $oItem->Detalle = "Nuevo cambio de divisas de tipo: $datos->Tipo !";
            $oItem->Id_Moneda_Valor = 2;
            $oItem->Id_Tipo_Movimiento = '2';
            $oItem->Valor_Tipo_Movimiento = $datos->Id_Cambio;
            $oItem->Id_Tercero = $datos->Id_Tercero;
            $oItem->Estado = 'Activo';
            $oItem->Id_Funcionario = $datos->Identificacion_Funcionario;
            $oItem->save();


            $tercero = Tercero::find($datos->Id_Tercero);
            $tercero->Cupo_Disponible = $tercero->Cupo_Disponible + $oItem->Valor;
            $tercero->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cambio  $cambio
     * @return \Illuminate\Http\Response
     */
    public function show(Cambio $cambio, $id)
    {
        return response()->json([
            'cambio' => Cambio::with('tercero')->findOrFail($id), 'motivos' => Motivodevolucioncambio::all(),
            'Monedas' => Moneda::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cambio  $cambio
     * @return \Illuminate\Http\Response
     */
    public function edit(Cambio $cambio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cambio  $cambio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cambio $cambio)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cambio  $cambio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cambio $cambio)
    {
        //
    }

    public function printCambio()
    {
      

        $company = Configuracion::first();

        switch (request()->get('modulo')) {

            case 'cambio':

                $cambio =  Cambio::leftJoin('Tercero', 'Cambio.Tercero_id', 'Tercero.Id_Tercero')
                    ->join('Moneda AS MO', 'Cambio.Moneda_Origen', 'MO.Id_Moneda')
                    ->join('Moneda AS MD', 'Cambio.Moneda_Destino', 'MD.Id_Moneda')
                    ->join('Caja AS Ca', 'Cambio.Id_Caja', 'Ca.Id_Caja')
                    ->join('Oficina AS Of', 'Cambio.Id_Oficina', 'Of.Id_Oficina')
                    ->join('fomapagos AS Fp', 'Cambio.fomapago_id', 'Fp.id')
                    ->join('Funcionario', 'Cambio.Identificacion_Funcionario', 'Funcionario.Identificacion_Funcionario')
                    ->select(
                        'Cambio.*',
                        'MO.Codigo AS MoCodigo',
                        'MD.Codigo AS MdCodigo',
                        'Ca.Nombre AS NombreCaja',
                        'Of.Nombre AS NombreOficina',
                        'Of.Telefono AS TelefonoOficina',
                        'Of.Lema AS Lema',
                        'Of.Pie_Pagina AS Footer',
                        'Fp.Nombre As FormaPago',
                        DB::raw("CONCAT(Funcionario.Nombres, ' ', Funcionario.Apellidos) AS full_name"),
                        'Tercero.Id_Tercero',
                        'Tercero.Nombre',
                        'Tercero.Telefono As TelefonoCliente',
                        DB::raw('IFNULL(Tercero.Id_Tercero, \'0\') AS Id_Tercero'),
                        DB::raw('IFNULL(Tercero.Nombre, \'Cliente\') AS Nombre'),
                        DB::raw('IFNULL(Tercero.Telefono, \'0\') AS TelefonoCliente')
                    )
                    ->findOrFail(request()->get('id'));

          $pdf = PDF::loadView('pdfs.cambioInvoice', compact('cambio', 'company'));
                $pdf->setPaper(array(0, 0, 200, 500), 'portrait'); //x inicio, y inicio, ancho final, alto final
                return $pdf->stream('invoice.pdf');
                break;

            case 'pago':

                $pago = (object)DB::Select('SELECT Gir.*, Gir.Valor_Entrega As Valor_Destino, Gir.Valor_Recibido As Valor_Origen, Gir.Documento_Destinatario, 
                                        Gir.Nombre_Destinatario, Gir.Valor_Total, Mon.Codigo as MoCodigo,  Mon.Codigo as MdCodigo, Caj.Nombre as Caja, Ofi.Nombre as NombreOficina,
                                        Ofi.Lema, Ofi.Pie_Pagina As Footer, Ofi.Telefono as TelefonoOficina, Gir.Telefono_Remitente As TelefonoCliente, Gir.Nombre_Remitente As Nombre, Gir.Documento_Remitente As Id_inv,
                                        \'Efectivo\' As FormaPago,
                                        \'Pago\' As Tipo,
                                         Gir.comision As Tasa,
                                        concat(Fun.Nombres, " " ,Fun.Apellidos) As full_name
                                        from Giro Gir
                                        LEFT join Moneda Mon on Gir.Id_Moneda = Mon.Id_Moneda
                                        LEFT join Caja Caj on Gir.Id_Caja = Caj.Id_Caja
                                        inner join Funcionario Fun on Fun.Identificacion_Funcionario = Gir.Identificacion_Funcionario 
                                        LEFT join Oficina Ofi on Gir.Id_Oficina = Ofi.Id_Oficina WHERE `Id_Giro` = ' . request()->get('id'))[0];

                $pdf = PDF::loadView('pdfs.pagoInvoice', compact('pago', 'company'));
                $pdf->setPaper(array(0, 0, 200, 550), 'portrait'); //x inicio, y inicio, ancho final, alto final
                return $pdf->stream('invoice.pdf');
                break;

            case 'pagado':

                $pago = (object)DB::Select('SELECT Gir.*, Gir.Valor_Entrega As Valor_Destino, Gir.Valor_Recibido As Valor_Origen, Gir.Documento_Destinatario, 
                                        Gir.Nombre_Destinatario, Gir.Valor_Total, Mon.Codigo as MoCodigo,  Mon.Codigo as MdCodigo, Caj.Nombre as Caja, Ofi.Nombre as NombreOficina,
                                        Ofi.Lema, Ofi.Pie_Pagina As Footer, Ofi.Telefono as TelefonoOficina, Gir.Telefono_Remitente As TelefonoCliente, Gir.Nombre_Remitente As Nombre, Gir.Documento_Remitente As Id_inv,
                                        \'Efectivo\' As FormaPago,
                                        \'Pago\' As Tipo,
                                         Gir.comision As Tasa,
                                        concat(Fun.Nombres, " " ,Fun.Apellidos) As full_name
                                        from Giro Gir
                                        LEFT join Moneda Mon on Gir.Id_Moneda = Mon.Id_Moneda
                                        LEFT join Caja Caj on Gir.Id_Caja = Caj.Id_Caja
                                        inner join Funcionario Fun on Fun.Identificacion_Funcionario = Gir.Identificacion_Funcionario 
                                        LEFT join Oficina Ofi on Gir.Id_Oficina = Ofi.Id_Oficina WHERE `Id_Giro` = ' . request()->get('id'))[0];

                $pdf = PDF::loadView('pdfs.pagadoInvoice', compact('pago', 'company'));
                $pdf->setPaper(array(0, 0, 200, 550), 'portrait'); //x inicio, y inicio, ancho final, alto final
                return $pdf->stream('invoice.pdf');
                break;

            case 'egresos':
                $egreso = Egreso::leftJoin('Tercero', 'Egreso.Id_Tercero', 'Tercero.Id_Tercero')
                            ->join('Moneda AS MO', 'Egreso.Id_Moneda', 'MO.Id_Moneda')
                            ->join('Oficina AS Of', 'Egreso.Id_Oficina', 'Of.Id_Oficina')
                             ->join('Funcionario', 'Egreso.Identificacion_Funcionario', 'Funcionario.Identificacion_Funcionario')
                            ->select(
                                'Egreso.*',
                                'MO.Codigo AS MoCodigo',
                                'Egreso.Valor AS Valor_Destino',
                                'Tercero.Tipo_Tercero',
                                'Tercero.Id_Tercero as Id_inv',
                                'Tercero.Telefono As TelefonoCliente',
                                'Tercero.Celular',
                                'Tercero.Nombre',
                                'Of.Nombre AS NombreOficina',
                                'Of.Telefono AS TelefonoOficina',
                                 DB::raw("CONCAT(Funcionario.Nombres, ' ', Funcionario.Apellidos) AS full_name"),
                                'Of.Lema AS Lema',
                                'Of.Pie_Pagina AS Footer')
                    ->findOrFail(request()->get('id'));
                $pdf = PDF::loadView('pdfs.egresoInvoice', compact('egreso', 'company'));
                $pdf->setPaper(array(0, 0, 200, 500), 'portrait'); //x inicio, y inicio, ancho final, alto final
                return $pdf->stream('invoice.pdf');
                break;
                
            case 'externo':
                
               $externo = (object)DB::select('SELECT Ser.*, Mon.Codigo As MoCodigo, Mon.Codigo As MdCodigo, Caj.Nombre as Caja, Ofi.Nombre as NombreOficina, 
                        Ofi.Telefono as TelefonoOficina, 
                        Ofi.Lema as Lema, 
                        Ofi.Pie_Pagina as Footer, 
                        SerExt.Nombre as ServicioExterno, 
                        concat(Fun.Nombres, " " ,Fun.Apellidos) As Nombre,
                        Fun.Identificacion_Funcionario, Ser.Id_Funcionario_Destino
                        from Servicio Ser
                        inner join Moneda Mon on Ser.Id_Moneda = Mon.Id_Moneda
                        inner join Caja Caj on Ser.Id_Caja = Caj.Id_Caja
                        inner join Oficina Ofi on Ser.Id_Oficina = Ofi.Id_Oficina
                        inner join Servicio_Externo SerExt on Ser.Servicio_Externo = SerExt.Id_Servicio_Externo
                        inner join Funcionario Fun on Fun.Identificacion_Funcionario = Ser.Id_Funcionario_Destino WHERE Id_Servicio =' . request()->get('id'))[0];
                    
                $pdf = PDF::loadView('pdfs.externoInvoice', compact('externo', 'company'));
                $pdf->setPaper(array(0, 0, 200, 500), 'portrait'); //x inicio, y inicio, ancho final, alto final
                return $pdf->stream('invoice.pdf');
                break;
                
            case 'externoPagado':
                
               $externo = (object)DB::select('SELECT Ser.*, Mon.Codigo As MoCodigo, Mon.Codigo As MdCodigo, Caj.Nombre as Caja, Ofi.Nombre as NombreOficina, 
                        Ofi.Telefono as TelefonoOficina, 
                        Ofi.Lema as Lema, 
                        Ofi.Pie_Pagina as Footer, 
                        SerExt.Nombre as ServicioExterno, 
                        concat(Fun.Nombres, " " ,Fun.Apellidos) As Nombre,
                        Fun.Identificacion_Funcionario, Ser.Id_Funcionario_Destino
                        from Servicio Ser
                        inner join Moneda Mon on Ser.Id_Moneda = Mon.Id_Moneda
                        inner join Caja Caj on Ser.Id_Caja = Caj.Id_Caja
                        inner join Oficina Ofi on Ser.Id_Oficina = Ofi.Id_Oficina
                        inner join Servicio_Externo SerExt on Ser.Servicio_Externo = SerExt.Id_Servicio_Externo
                        inner join Funcionario Fun on Fun.Identificacion_Funcionario = Ser.Id_Funcionario_Destino WHERE Id_Servicio =' . request()->get('id'))[0];
                    // pagadoExternoInvoice.blade.php
                $pdf = PDF::loadView('pdfs.pagadoExternoInvoice', compact('externo', 'company'));
                $pdf->setPaper(array(0, 0, 200, 475), 'portrait'); //x inicio, y inicio, ancho final, alto final
                return $pdf->stream('invoice.pdf');
                break;


            case 'transferencia':
          
          

                $transferencia =  Transferencia::leftJoin('Transferencia_Remitente', 'Transferencia.Documento_Origen', 'Transferencia_Remitente.Id_Transferencia_Remitente')
                    ->leftJoin('Tercero', 'Transferencia.Documento_Origen', 'Tercero.Id_Tercero')
                    ->Join('Moneda As MO', 'Transferencia.Moneda_Origen', 'MO.Id_Moneda')
                    ->Join('Moneda As MD', 'Transferencia.Moneda_Destino', 'MD.Id_Moneda')
                    ->Join('Caja As Ca', 'Transferencia.Id_Caja', 'Ca.Id_Caja')
                    ->join('Oficina As Of', 'Transferencia.Id_Oficina', 'Of.Id_Oficina')
                    ->leftJoin('Transferencia_Destinatario As TD', 'TD.Id_Transferencia', 'Transferencia.Id_Transferencia')
                    ->join('Funcionario', 'Transferencia.Identificacion_Funcionario', 'Funcionario.Identificacion_Funcionario')
                    ->select(
                        'Transferencia.*',
                        'Transferencia.Cantidad_Recibida AS Valor_Destino',
                        'Transferencia.Cantidad_Transferida AS Valor_Origen',
                        'Valor_Transferencia',
                        'MO.Codigo AS MoCodigo',
                        'MD.Codigo AS MdCodigo',
                        'Ca.Nombre AS NombreCaja',
                        'Of.Nombre AS NombreOficina',
                        'Of.Lema AS Lema',
                        'Of.Pie_Pagina AS Footer',
                        'Of.Telefono AS TelefonoOficina',
                        'Transferencia_Remitente.Id_Transferencia_Remitente as Id_inv',
                        'Transferencia_Remitente.Telefono',
                        'Transferencia_Remitente.Nombre As Remitente',
                        DB::raw("CONCAT(Funcionario.Nombres, ' ', Funcionario.Apellidos) AS full_name"),
                        DB::raw('IFNULL(Transferencia_Remitente.Id_Transferencia_Remitente, Tercero.Id_Tercero) As Id_inv'),
                        DB::raw('IFNULL(Transferencia_Remitente.Telefono, Tercero.Telefono) As Telefono'),
                        DB::raw('IFNULL(Transferencia_Remitente.Nombre, Tercero.Nombre) As Remitente')
                    )
                    ->firstWhere('Transferencia.Id_Transferencia',request()->get('id'));
          

                $destinatarios =  Transferencia::leftJoin('Transferencia_Remitente', 'Transferencia.Documento_Origen', 'Transferencia_Remitente.Id_Transferencia_Remitente')
                    ->join('Moneda As MO', 'Transferencia.Moneda_Origen', 'MO.Id_Moneda')
                    ->join('Moneda As MD', 'Transferencia.Moneda_Destino', 'MD.Id_Moneda')
                    ->join('Caja As Ca', 'Transferencia.Id_Caja', 'Ca.Id_Caja')
                    ->join('Oficina As Of', 'Transferencia.Id_Oficina', 'Of.Id_Oficina')
                    ->join('Transferencia_Destinatario As TD', 'TD.Id_Transferencia', 'Transferencia.Id_Transferencia')
                    ->join('Destinatario AS D', 'TD.Numero_Documento_Destino', 'D.Id_Destinatario')
                    ->join('Destinatario_Cuenta As DC', 'TD.Id_Destinatario_Cuenta', 'DC.Id_Destinatario_Cuenta')

                    ->select(
                        'Transferencia.*',
                        'Transferencia.Cantidad_Recibida AS Valor_Destino',
                        'Transferencia.Cantidad_Transferida AS Valor_Origen',
                        'D.Id_Destinatario',
                        'D.Nombre AS Nombre_Destinatario',
                        'DC.Numero_Cuenta AS Numero_Cuenta_Destinatario',
                        'Valor_Transferencia',
                        'MO.Codigo AS MoCodigo',
                        'MD.Codigo AS MdCodigo',
                        'Ca.Nombre AS NombreCaja',
                        'Of.Nombre AS NombreOficina',
                        'Of.Lema AS Lema',
                        'Of.Pie_Pagina AS Footer',
                        'Of.Telefono AS TelefonoOficina',
                        'Transferencia_Remitente.Id_Transferencia_Remitente as Id_inv',
                        'Transferencia_Remitente.Telefono',
                        'Transferencia_Remitente.Nombre As Remitente'
                    )
                    ->Where('Transferencia.Id_Transferencia', request()->get('id'))->get();
          
          

                $pdf = PDF::loadView('pdfs.transferInvoice', compact('transferencia', 'company', 'destinatarios'));
                $pdf->setPaper(array(0, 0, 300, 475), 'portrait'); //x inicio, y inicio, ancho final, alto final
                return $pdf->stream('invoice.pdf');
        }
    }
}
