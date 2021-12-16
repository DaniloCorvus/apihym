<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Alerta', function (Blueprint $table) {
            $table->integer('Id_Alerta', true);
            $table->integer('Identificacion_Funcionario')->nullable();
            $table->string('Tipo', 30)->nullable();
            $table->dateTime('Fecha')->useCurrent();
            $table->string('Detalles', 200)->nullable();
            $table->enum('Respuesta', ['SI', 'NO'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Alerta');
    }
}
