<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloqueoCuentaBancariaFuncionarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Bloqueo_Cuenta_Bancaria_Funcionario', function (Blueprint $table) {
            $table->integer('Id_Bloqueo_Cuenta_Bancaria_Funcionario', true);
            $table->integer('Id_Cuenta_Bancaria');
            $table->integer('Id_Funcionario');
            $table->date('Fecha');
            $table->string('Hora_Inicio_Sesion', 8)->default('00:00:00');
            $table->enum('Ocupada', ['Si', 'No'])->default('Si');
            $table->string('Hora_Cierre_Sesion', 8)->default('00:00:00');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Bloqueo_Cuenta_Bancaria_Funcionario');
    }
}
