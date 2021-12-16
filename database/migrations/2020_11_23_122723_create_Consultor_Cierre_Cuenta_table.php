<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultorCierreCuentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Consultor_Cierre_Cuenta', function (Blueprint $table) {
            $table->integer('Id_Consultor_Cierre_Cuenta', true);
            $table->integer('Id_Consultor_Apertura_Cuenta');
            $table->integer('Id_Funcionario');
            $table->date('Fecha_Cierre');
            $table->time('Hora_Cierre');
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
        Schema::dropIfExists('Consultor_Cierre_Cuenta');
    }
}
