<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenteExternoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Agente_Externo', function (Blueprint $table) {
            $table->integer('Id_Agente_Externo', true);
            $table->string('Nombre', 200)->nullable();
            $table->integer('Documento')->nullable();
            $table->integer('Cupo')->nullable();
            $table->string('Username', 100)->nullable();
            $table->string('Password', 100)->nullable();
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
        Schema::dropIfExists('Agente_Externo');
    }
}
