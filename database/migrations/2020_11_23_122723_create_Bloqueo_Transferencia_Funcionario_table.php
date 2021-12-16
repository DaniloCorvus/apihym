<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloqueoTransferenciaFuncionarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Bloqueo_Transferencia_Funcionario', function (Blueprint $table) {
            $table->integer('Id_Bloqueo_Transferencia_Funcionario', true);
            $table->integer('Id_Transferencia');
            $table->integer('Id_Funcionario');
            $table->date('Fecha');
            $table->string('Hora', 8);
            $table->enum('Bloqueada', ['Si', 'No'])->default('Si');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Bloqueo_Transferencia_Funcionario');
    }
}
