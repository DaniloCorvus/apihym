<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Pais', function (Blueprint $table) {
            $table->integer('Id_Pais', true);
            $table->string('Codigo', 5)->nullable();
            $table->string('Nombre', 200)->nullable();
            $table->integer('Id_Moneda');
            $table->integer('Cantidad_Digitos_Inicial_Cuenta');
            $table->integer('Cantidad_Digitos_Cuenta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Pais');
    }
}
