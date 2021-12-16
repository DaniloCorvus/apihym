<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Configuracion', function (Blueprint $table) {
            $table->integer('Id_Configuracion')->primary();
            $table->string('Nombre_Empresa', 100)->nullable();
            $table->string('NIT', 50);
            $table->integer('Telefono')->nullable();
            $table->integer('Celular')->nullable();
            $table->string('Direccion', 50)->nullable();
            $table->string('Correo', 30)->nullable();
            $table->integer('Extras_Legales');
            $table->integer('Festivos_Legales');
            $table->integer('Llegadas_Tarde');
            $table->integer('Salario_Base');
            $table->integer('Subsidio_Transporte');
            $table->time('Hora_Inicio_Dia');
            $table->time('Hora_Fin_Dia');
            $table->string('Hora_Extra_Diurna', 5);
            $table->string('Hora_Extra_Nocturna', 5);
            $table->string('Hora_Extra_Domingo_Diurna', 5);
            $table->string('Hora_Extra_Domingo_Nocturna', 5);
            $table->string('Recargo_Dominical_Diurna', 5);
            $table->string('Recargo_Dominical_Nocturna', 5);
            $table->string('Recargo_Diurna', 5);
            $table->string('Recargo_Nocturno', 5);
            $table->time('Hora_Inicio_Noche');
            $table->time('Hora_Fin_Noche');
            $table->longText('Festivos');
            $table->longText('Libres')->nullable();
            $table->integer('Recibo');
            $table->string('Prefijo_Recibo', 100);
            $table->string('Codigo_Formato_Recibo', 100);
            $table->string('Nombre_Dian_Recibo', 100);
            $table->integer('Compra')->nullable();
            $table->string('Prefijo_Compra', 200)->nullable();
            $table->string('Codigo_Formato_Compra', 200)->nullable();
            $table->string('Nombre_Dian_Compra', 200)->nullable();
            $table->integer('Servicio_Externo')->nullable();
            $table->string('Prefijo_Servicio_Externo', 200)->nullable();
            $table->string('Codigo_Formato_Servicio_Externo', 200)->nullable();
            $table->string('Nombre_Dian_Servicio_Externo', 200)->nullable();
            $table->integer('Giro')->nullable();
            $table->string('Prefijo_Giro', 200)->nullable();
            $table->string('Codigo_Formato_Giro', 200)->nullable();
            $table->string('Nombre_Dian_Giro', 200)->nullable();
            $table->integer('Transferencia')->nullable();
            $table->string('Prefijo_Transferencia', 200)->nullable();
            $table->string('Codigo_Formato_Transferencia', 200)->nullable();
            $table->string('Nombre_Dian_Transferencia', 200)->nullable();
            $table->integer('Traslado')->nullable();
            $table->string('Prefijo_Traslado', 200)->nullable();
            $table->string('Codigo_Formato_Traslado', 200)->nullable();
            $table->string('Nombre_Dian_Traslado', 200)->nullable();
            $table->integer('Egreso')->nullable();
            $table->string('Prefijo_Egreso', 200)->nullable();
            $table->string('Codigo_Formato_Egreso', 200)->nullable();
            $table->string('Nombre_Dian_Egreso', 200)->nullable();
            $table->integer('Cambio');
            $table->string('Prefijo_Cambio', 100);
            $table->string('Codigo_Formato_Cambio', 100);
            $table->string('Nombre_Dian_Cambio', 1000);
            $table->integer('Traslado_Caja');
            $table->string('Prefijo_Traslado_Caja', 100);
            $table->string('Codigo_Formato_Traslado_Caja', 100);
            $table->string('Nombre_Dian_Traslado_Caja', 100);
            $table->integer('Servicio');
            $table->string('Prefijo_Servicio', 100);
            $table->string('Codigo_Formato_Servicio', 100);
            $table->string('Nombre_Dian_Servicio', 100);
            $table->time('Fin_Hora_Laboral')->nullable();
            $table->text('Fechas_Festivas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Configuracion');
    }
}
