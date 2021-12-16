<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultorAperturaCuentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Consultor_Apertura_Cuenta', function (Blueprint $table) {
            $table->integer('Id_Consultor_Apertura_Cuenta', true);
            $table->integer('Id_Funcionario');
            $table->date('Fecha_Apertura');
            $table->time('Hora_Apertura');
            $table->integer('Id_Oficina');
            $table->integer('Id_Caja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Consultor_Apertura_Cuenta');
    }
}
