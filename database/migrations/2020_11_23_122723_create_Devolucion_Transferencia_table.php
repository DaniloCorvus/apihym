<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevolucionTransferenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Devolucion_Transferencia', function (Blueprint $table) {
            $table->integer('Id_Devolucion_Transferencia', true);
            $table->integer('Id_Pago_Transferencia');
            $table->integer('Id_Motivo_Devolucion');
            $table->integer('Id_Transferencia_Destinatario');
            $table->timestamp('Fecha')->useCurrent();
            $table->integer('Id_Funcionario');
            $table->text('Observaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Devolucion_Transferencia');
    }
}
