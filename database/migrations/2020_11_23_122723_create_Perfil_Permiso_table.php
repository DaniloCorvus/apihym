<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilPermisoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Perfil_Permiso', function (Blueprint $table) {
            $table->integer('Id_Perfil_Permiso', true);
            $table->integer('Id_Perfil')->nullable();
            $table->string('Titulo_Modulo', 100)->nullable();
            $table->string('Modulo', 100)->nullable();
            $table->string('Crear', 10)->default('false');
            $table->string('Editar', 10)->default('false');
            $table->string('Eliminar', 10)->default('false');
            $table->string('Ver', 100)->default('false');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Perfil_Permiso');
    }
}
