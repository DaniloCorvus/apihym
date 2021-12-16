<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Municipio', function (Blueprint $table) {
            $table->integer('Id_Municipio', true);
            $table->integer('Id_Departamento')->nullable();
            $table->string('Nombre', 200)->nullable();
            $table->string('Codigo', 3)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Municipio');
    }
}
