<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoTerceroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Grupo_Tercero', function (Blueprint $table) {
            $table->integer('Id_Grupo_Tercero', true);
            $table->string('Nombre', 30);
            $table->string('Detalle', 200)->nullable();
            $table->integer('Padre')->nullable()->default(0);
            $table->string('Estado', 100)->default('Activo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Grupo_Tercero');
    }
}
