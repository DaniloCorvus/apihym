<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevolucionCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Devolucion_Compra', function (Blueprint $table) {
            $table->integer('Id_Devolucion_Compra', true);
            $table->integer('Id_Compra');
            $table->string('Detalle_Devolucion', 50);
            $table->dateTime('Fecha_Registro')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Devolucion_Compra');
    }
}
