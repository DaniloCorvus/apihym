<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogSistemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Log_Sistema', function (Blueprint $table) {
            $table->integer('Id_Log_Sistema', true);
            $table->integer('Id_Funcionario');
            $table->string('Accion', 50);
            $table->text('Detalle');
            $table->integer('Id_Registro')->nullable();
            $table->timestamp('Fecha_Registro')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Log_Sistema');
    }
}
