<?php

use App\Http\Controllers\TrasladoController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\FlujoEfectivoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CajeroController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\RecaudoController;
use App\Http\Controllers\CambioController;
use App\Http\Controllers\CierreCajaController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\CorresponsalController;
use App\Http\Controllers\CorresponsalDiarioController;
use App\Http\Controllers\DevolucioncambioController;
use App\Http\Controllers\EgresoController;
use App\Http\Controllers\FomapagoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\GenericoController;
use App\Http\Controllers\GiroRemitenteController;
use App\Http\Controllers\GiroRemitenteExternoController;
use App\Http\Controllers\MonedaController;
use App\Http\Controllers\MotivodevolucioncambioController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\TerceroController;
use App\Http\Controllers\GiroController;
use App\Http\Controllers\CalculosController;
use App\Http\Controllers\TransferenciaCustomController;
use App\Http\Controllers\MovimientobancarioController;
use App\Http\Controllers\ServicioExternoController;
use App\Models\Cambio;
use App\Models\Configuracion;
use App\Models\CorresponsalDiario;
use App\Models\Devolucioncambio;
use App\Models\Funcionario;
use App\Models\GiroRemitente;
use App\Models\TrasladoCaja;
use App\Models\Tercero;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


Route::get('my', function () {

  TrasladoCaja::where('Id_Moneda', 2)
    ->whereDate('Fecha_Traslado', Carbon::now()->format('Y-m-d'))->where('Funcionario_Destino', 9999999)
    ->select(DB::raw('IF(sum(Valor) > 0, sum(Valor), 0) AS Ingreso_Total, "Traslados" as Nombre'))
    ->groupByRaw('Id_Moneda')
    ->where('Estado', 'Aprobado')
    ->first();


  TrasladoCaja::where('Id_Moneda', 2)
    ->whereDate('Fecha_Traslado', Carbon::now()->format('Y-m-d'))->where('Id_Cajero_Origen', 9999999)
    ->select(DB::raw('IF(sum(Valor) > 0, sum(Valor), 0) AS Egreso_Total,  "Traslados" as Nombre'))
    ->groupByRaw('Id_Moneda')
    ->where('Estado', 'Aprobado')
    ->first();
});

Route::group(['middleware' => ['Cors']], function () {

  Auth::routes();
  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  //Funcionarios
  Route::get('funcionarios', [FuncionarioController::class, 'index']);
  //Monedas
  Route::get('monedas', [MonedaController::class, 'index']);
  //Gnericos
  Route::get('genericos/paises', [GenericoController::class, 'paises']);
  Route::get('genericos/tipo-documento-extrangeros', [GenericoController::class, 'tipoDocumentosExtranjeros']);
  Route::get('genericos/tipo-documento-nacionales', [GenericoController::class, 'tipoDocumentoNacionales']);

  //Cuentas bancarias
  // Route::get('cuentasbancarias/buscar-cuentas-bancarias-por-moneda', [CuentaBancariaController::class, 'buscar']);
  //Terceros
  Route::get('terceros-filter', [TerceroController::class, 'filter']);
  Route::get('terceros', [TerceroController::class, 'index']);
  Route::get('terceros/filter/{tipos}', [TerceroController::class, 'tercerosFilter']);
  //Forma de pago
  Route::get('foma-pago', [FomapagoController::class, 'index']);

  //Cambios
  Route::post('cambios', [CambioController::class, 'store']);
  Route::get('cambios', [CambioController::class, 'index']);
  Route::get('print-cambio', [CambioController::class, 'printCambio']);
  Route::post('custom/cambios/update', [CambioController::class, 'update']);
  Route::get('cambios/{id}', [CambioController::class, 'show']);


  //Devoluciones
  Route::resource('giros', GiroController::class);


  //Devoluciones
  Route::get('motivos-devolucion', [MotivodevolucioncambioController::class, 'index']);
  Route::post('motivos-devolucion', [MotivodevolucioncambioController::class, 'store']);
  Route::post('motivos-devolucion/{id}', [MotivodevolucioncambioController::class, 'destroy']);

  Route::post('devolucion/store', [DevolucioncambioController::class, 'store']);
  Route::get('devoluciones/show/{Id_Cambio}', [DevolucioncambioController::class, 'show']);

  Route::resource('remitentes', GiroRemitenteController::class);
  Route::resource('remitentes-externo', GiroRemitenteExternoController::class);
  Route::resource('egresos', EgresoController::class);

  Route::get('cierre-caja', [CierreCajaController::class, 'getInfo']);

  Route::get('cierre-caja/cronjob', [CierreCajaController::class, 'guardarCierre']);

  Route::post('cierre-caja/funcionario', [FuncionarioController::class, 'estadoCaja']);

  Route::post('cierre-caja/guardar', [CierreCajaController::class, 'guardarCierre']);
  Route::post('cierre-caja/cajero/guardar', [CierreCajaController::class, 'guardarCierreCajero']);


  Route::post('corresponsales/update', [CorresponsalController::class, 'update']);
  Route::put('corresponsales-diarios/update', [CorresponsalDiarioController::class, 'update']);

  //Cajeros
  Route::get('filtrar-cajeros', [CajeroController::class, 'filtro']);

  #CAMBIO CARLOS C. TODAS LAS OFICINAS
  //Route::get('calcular-totales-cajeros', [CalculosController::class, 'calcularCajeroTotales']);
  Route::get('calcular-totales-cajeros', [CalculosController::class, 'calcularCajeroTotalesPrincipal']);



  Route::get('ubicarse', [TransferenciaCustomController::class, 'ubicarse']);
  Route::get('bloquear', [TransferenciaCustomController::class, 'bloquear']);
  Route::get('info', [TransferenciaCustomController::class, 'info']);
  Route::get('desbloquear', [TransferenciaCustomController::class, 'desbloquear']);

  // /***************************************************************************************************************************/
  // Recaudos

  Route::resource('recaudos', RecaudoController::class);

  Route::post('get_recaudos_funcionario', [RecaudoController::class, 'getRecaudos']);

  Route::get('filtrarTerceros', [RecaudoController::class, 'filtrarTerceros'])->name('filtrarTerceros');

  Route::post('tercerosFilterForRecaudo', [TerceroController::class, 'tercerosFilterForRecaudo']);


  // /**********************************************************Modulos*****************************************************************/
  Route::get('modulos', [ModuloController::class, 'index'])->name('modulos');


  // /**********************************************************Filtros*****************************************************************/
  Route::post('compras/compras-filter', [CompraController::class, 'filter'])->name('compras-filter');

  Route::post('traslados', [TrasladoController::class, 'update'])->name('traslados');

  Route::get('print-traslado', [TrasladoController::class, 'print'])->name('print.traslados');



  // /**********************************************************Flujo de efectivo y recaudo*****************************************************************/
  Route::get('flujo-efectivo', [FlujoEfectivoController::class, 'getInfo']);

  Route::post('getrecaudo-destinatarios', [RecaudoController::class, 'getrecaudoDestinatarios']);
  Route::post('delete-recaudo', [RecaudoController::class, 'deleteRecaudo']);

  // /********************************************************** Ajustes y compras en consultor ***********************************************************/

  Route::post('delete-movimiento', [MovimientobancarioController::class, 'deleteMovimiento']);

  // /********************************************************** Informes ***********************************************************/

  Route::get('informe-compras', [InformeController::class, 'informeCompra']);

  Route::get('print-caja', [CierreCajaController::class, 'getInfoForPrint']);


  Route::post('locked-servicio-externo', [ServicioExternoController::class, 'locked']);
  Route::post('translate-servicio-externo', [ServicioExternoController::class, 'translate']);
  Route::post('terminar_servicio', [ServicioExternoController::class, 'terminar']);
});
