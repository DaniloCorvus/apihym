<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumenMovimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Resumen_Movimiento', function (Blueprint $table) {
            $table->integer('Id_Resumen_Movimiento', true);
            $table->text('Valor');
            $table->text('Moneda');
            $table->text('Tipo');
            $table->text('Modulo');
            $table->timestamp('Fecha')->useCurrent();
            $table->integer('Id_Diario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Resumen_Movimiento');
    }
}
