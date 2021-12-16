<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrasladoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Traslado', function (Blueprint $table) {
            $table->integer('Id_Traslado', true);
            $table->timestamp('Fecha')->useCurrent();
            $table->string('Origen', 45);
            $table->string('Destino', 45);
            $table->integer('Id_Origen');
            $table->integer('Id_Destino');
            $table->string('Moneda', 45);
            $table->float('Valor', 20);
            $table->enum('Estado', ['Activo', 'Anulado'])->default('Activo');
            $table->text('Detalle');
            $table->integer('Identificacion_Funcionario');
            $table->string('Codigo', 45);
            $table->integer('Id_Caja')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Traslado');
    }
}
