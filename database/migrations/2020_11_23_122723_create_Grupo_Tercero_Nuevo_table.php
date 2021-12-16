<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoTerceroNuevoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Grupo_Tercero_Nuevo', function (Blueprint $table) {
            $table->integer('Id_Grupo_Tercero', true);
            $table->string('Nombre_Grupo', 50)->unique('Nombre_Grupo');
            $table->integer('Id_Grupo_Padre')->default(0);
            $table->enum('Estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->dateTime('Fecha_Registro')->useCurrent();
            $table->integer('Id_Funcionario');
            $table->integer('Nivel')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Grupo_Tercero_Nuevo');
    }
}
