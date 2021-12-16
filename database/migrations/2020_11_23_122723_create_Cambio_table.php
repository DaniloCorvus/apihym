<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCambioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cambio', function (Blueprint $table) {
            $table->integer('Id_Cambio', true);
            $table->string('Tipo', 100);
            $table->bigInteger('fomapago_id');
            $table->string('Codigo', 100)->nullable();
            $table->timestamp('Fecha')->nullable()->useCurrent();
            $table->integer('Id_Caja')->nullable();
            $table->integer('Id_Oficina')->nullable();
            $table->string('Moneda_Origen', 100)->nullable();
            $table->string('Moneda_Destino', 100)->nullable()->default('Pesos');
            $table->string('Tasa', 100)->nullable();
            $table->float('Valor_Origen', 10)->nullable();
            $table->float('Valor_Destino', 10)->nullable();
            $table->double('TotalPago');
            $table->integer('Vueltos')->nullable()->default(0);
            $table->integer('Recibido')->default(0);
            $table->string('Estado', 100)->default('Realizado');
            $table->text('Identificacion_Funcionario')->nullable();
            $table->bigInteger('Tercero_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Cambio');
    }
}
