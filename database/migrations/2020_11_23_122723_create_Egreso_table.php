<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEgresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Egreso', function (Blueprint $table) {
            $table->integer('Id_Egreso', true);
            $table->integer('Id_Grupo');
            $table->integer('Id_Tercero');
            $table->integer('Id_Moneda');
            $table->integer('Valor');
            $table->string('Detalle', 200);
            $table->integer('Identificacion_Funcionario');
            $table->dateTime('Fecha')->useCurrent();
            $table->enum('Estado', ['Activo', 'Anulado'])->default('Activo');
            $table->string('Codigo', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Egreso');
    }
}
