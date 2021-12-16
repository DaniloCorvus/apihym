<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpcionPredeterminadaSelectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Opcion_Predeterminada_Select', function (Blueprint $table) {
            $table->integer('Id_Opcion_Predeterminada_Select', true);
            $table->string('Moneda_Que_Compra', 10);
            $table->string('Moneda_Que_Vende', 10);
            $table->string('Moneda_Que_Recibe', 10);
            $table->string('Moneda_Para_El_Cambio', 10);
            $table->string('Forma_Pago', 10);
            $table->string('Moneda_Traslado', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Opcion_Predeterminada_Select');
    }
}
