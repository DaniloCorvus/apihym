<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionarioCuentaBancariaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Funcionario_Cuenta_Bancaria', function (Blueprint $table) {
            $table->integer('Id_Funcionario_Cuenta_Bancaria', true);
            $table->integer('Id_Funcionario');
            $table->integer('Id_Cuenta_Bancaria');
            $table->enum('EnUso', ['Si', 'No'])->default('Si');
            $table->dateTime('Fecha_Registro')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Funcionario_Cuenta_Bancaria');
    }
}
