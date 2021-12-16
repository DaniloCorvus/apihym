<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOficinaMonedaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Oficina_Moneda', function (Blueprint $table) {
            $table->integer('Id_Oficina_Moneda', true);
            $table->string('Identificacion_Funcionario', 200)->nullable();
            $table->integer('Id_Moneda')->nullable();
            $table->double('Valor')->nullable();
            $table->string('Campo_Visual', 200);
            $table->integer('Id_Oficina')->nullable();
            $table->timestamp('Creado')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Oficina_Moneda');
    }
}
