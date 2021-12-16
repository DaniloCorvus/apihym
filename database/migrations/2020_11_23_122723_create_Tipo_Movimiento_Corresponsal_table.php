<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoMovimientoCorresponsalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tipo_Movimiento_Corresponsal', function (Blueprint $table) {
            $table->integer('Id_Tipo_Movimiento_Corresponsal', true);
            $table->string('Nombre', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Tipo_Movimiento_Corresponsal');
    }
}
