<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotivoDevolucionTransferenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Motivo_Devolucion_Transferencia', function (Blueprint $table) {
            $table->integer('Id_Motivo_Devolucion_Transferencia', true);
            $table->string('Motivo_Devolucion', 30);
            $table->dateTime('Fecha_Creacion')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Motivo_Devolucion_Transferencia');
    }
}
