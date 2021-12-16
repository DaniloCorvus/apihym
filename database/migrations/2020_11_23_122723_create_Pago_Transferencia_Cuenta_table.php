<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagoTransferenciaCuentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Pago_Transferencia_Cuenta', function (Blueprint $table) {
            $table->integer('Id_Pago_Transferencia_Cuenta', true);
            $table->integer('Id_Pago_Transferencia');
            $table->integer('Id_Cuenta_Destinatario');
            $table->dateTime('Fecha_Registro');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Pago_Transferencia_Cuenta');
    }
}
