<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionarioExperienciaLaboralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Funcionario_Experiencia_Laboral', function (Blueprint $table) {
            $table->integer('id_Funcionario_Experiencia_Laboral', true);
            $table->integer('Identificacion_Funcionario')->index('Identificacion_Funcionario');
            $table->string('Nombre_Empresa', 45)->nullable();
            $table->string('Cargo', 45)->nullable();
            $table->string('Ingreso_Empresa', 15)->nullable();
            $table->string('Retiro_Empresa', 15)->nullable();
            $table->string('Labores')->nullable();
            $table->string('Jefe', 45)->nullable();
            $table->string('Telefono', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Funcionario_Experiencia_Laboral');
    }
}
