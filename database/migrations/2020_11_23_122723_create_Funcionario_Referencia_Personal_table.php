<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionarioReferenciaPersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Funcionario_Referencia_Personal', function (Blueprint $table) {
            $table->integer('id_Funcionario_Referencias', true);
            $table->integer('Identificacion_Funcionario')->index('Identificacion_Funcionario');
            $table->string('Nombres', 45)->nullable();
            $table->string('Profesion', 45)->nullable();
            $table->string('Empresa', 45)->nullable();
            $table->string('Telefono', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Funcionario_Referencia_Personal');
    }
}
