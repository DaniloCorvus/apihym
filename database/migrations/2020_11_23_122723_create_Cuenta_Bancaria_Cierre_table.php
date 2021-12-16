<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentaBancariaCierreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cuenta_Bancaria_Cierre', function (Blueprint $table) {
            $table->integer('Id_Cuenta_Bancaria_Cierre', true);
            $table->integer('Id_Consultor_Cierre_Cuenta');
            $table->integer('Id_Cuenta_Bancaria');
            $table->date('Fecha_Cierre');
            $table->time('Hora_Cierre');
            $table->float('Monto_Cierre', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Cuenta_Bancaria_Cierre');
    }
}
