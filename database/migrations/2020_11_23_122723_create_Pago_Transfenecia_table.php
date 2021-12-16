<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagoTransfeneciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Pago_Transfenecia', function (Blueprint $table) {
            $table->integer('Id_Pago_Transfenecia', true);
            $table->integer('Id_Consultor_Apertura_Cuenta');
            $table->timestamp('Fecha')->nullable()->useCurrent();
            $table->dateTime('Fecha_Devolucion')->nullable();
            $table->integer('Id_Transferencia_Destino')->nullable();
            $table->string('Cajero', 100)->nullable()->comment('Este campo es en realidad el id del funcionario(consultor) que paga la transferencia');
            $table->string('Id_Cuenta_Bancaria', 30)->comment('Esta es la cuenta de origen del pago realizado');
            $table->string('Codigo_Transferencia', 30);
            $table->float('Valor', 10)->nullable();
            $table->string('Devuelta', 100)->nullable()->default('No');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Pago_Transfenecia');
    }
}
