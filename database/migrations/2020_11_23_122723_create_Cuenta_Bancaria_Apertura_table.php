<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentaBancariaAperturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cuenta_Bancaria_Apertura', function (Blueprint $table) {
            $table->integer('Id_Cuenta_Bancaria_Apertura', true);
            $table->integer('Id_Consultor_Apertura_Cuenta');
            $table->integer('Id_Cuenta_Bancaria');
            $table->date('Fecha_Apertura');
            $table->time('Hora_Apertura')->nullable();
            $table->float('Monto_Apertura', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Cuenta_Bancaria_Apertura');
    }
}
