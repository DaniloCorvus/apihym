<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorresponsalDiarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Corresponsal_Diario', function (Blueprint $table) {
            $table->integer('Id_Corresponsal_Diario', true);
            $table->integer('Id_Corresponsal_Bancario')->nullable();
            $table->integer('Valor')->nullable();
            $table->string('Detalle', 200)->nullable();
            $table->date('Fecha')->nullable();
            $table->time('Hora')->nullable();
            $table->integer('Identificacion_Funcionario')->nullable();
            $table->integer('Id_Moneda')->default(1);
            $table->integer('Id_Caja')->nullable();
            $table->integer('Id_Oficina')->nullable();
            $table->integer('Id_Tipo_Movimiento_Corresponsal');
            $table->enum('Estado', ['Activo', 'Anulado'])->default('Activo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Corresponsal_Diario');
    }
}
