<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicioExternoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Servicio_Externo', function (Blueprint $table) {
            $table->integer('Id_Servicio_Externo', true);
            $table->string('Nombre', 50)->nullable();
            $table->integer('Comision');
            $table->enum('Estado', ['Activo', 'Inactivo'])->default('Activo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Servicio_Externo');
    }
}
