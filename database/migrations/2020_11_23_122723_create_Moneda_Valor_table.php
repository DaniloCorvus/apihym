<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonedaValorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Moneda_Valor', function (Blueprint $table) {
            $table->integer('Id_Moneda_Valor', true);
            $table->string('Identificacion_Funcionario', 200)->nullable();
            $table->integer('Id_Moneda')->nullable();
            $table->string('Valor', 100)->nullable();
            $table->string('Campo_Visual', 200);
            $table->string('Columna', 100)->nullable();
            $table->string('Color', 100)->nullable();
            $table->integer('Orden')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Moneda_Valor');
    }
}
