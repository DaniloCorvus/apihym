<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRutaFuncionarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Ruta_Funcionario', function (Blueprint $table) {
            $table->integer('Id_Ruta_Funcionario', true);
            $table->integer('Id_Funcionario');
            $table->timestamp('Fecha')->useCurrent();
            $table->string('Latitud', 50);
            $table->string('Longitud', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Ruta_Funcionario');
    }
}
