<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorresponsalBancarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Corresponsal_Bancario', function (Blueprint $table) {
            $table->integer('Id_Corresponsal_Bancario', true);
            $table->string('Nombre', 50)->nullable();
            $table->integer('Cupo')->nullable();
            $table->integer('Id_Departamento');
            $table->integer('Id_Municipio');
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
        Schema::dropIfExists('Corresponsal_Bancario');
    }
}
