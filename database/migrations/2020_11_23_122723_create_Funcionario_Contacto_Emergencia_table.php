<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionarioContactoEmergenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Funcionario_Contacto_Emergencia', function (Blueprint $table) {
            $table->integer('Identificacion_Funcionario_Contacto_Emergencia', true);
            $table->integer('Identificacion_Funcionario')->default(0)->index('Identificacion_Funcionario');
            $table->string('Parentesco', 45)->nullable()->default('');
            $table->string('Nombre', 200)->nullable()->default('');
            $table->string('Telefono', 15)->nullable()->default('');
            $table->string('Celular', 15)->default('');
            $table->string('Direccion', 200)->nullable()->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Funcionario_Contacto_Emergencia');
    }
}
