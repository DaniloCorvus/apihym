<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajaRecaudosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Caja_Recaudos', function (Blueprint $table) {
            $table->integer('Id_Caja_Recaudos', true);
            $table->string('Nombre', 100)->nullable();
            $table->string('Username', 100)->nullable();
            $table->string('Password', 100);
            $table->integer('Id_Departamento');
            $table->integer('Id_Municipio');
            $table->enum('Estado', ['Activa', 'Inactiva'])->default('Activa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Caja_Recaudos');
    }
}
