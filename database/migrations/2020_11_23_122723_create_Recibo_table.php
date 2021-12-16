<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReciboTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Recibo', function (Blueprint $table) {
            $table->integer('Id_Recibo', true);
            $table->string('Codigo', 200)->nullable()->unique('Codigo');
            $table->timestamp('Fecha')->nullable()->useCurrent();
            $table->integer('Identificacion_Funcionario')->nullable();
            $table->integer('Id_Oficina')->nullable();
            $table->integer('Id_Caja')->nullable();
            $table->integer('Id_Transferencia')->nullable();
            $table->float('Tasa_Cambio', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Recibo');
    }
}
