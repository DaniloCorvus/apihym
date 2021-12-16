<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicioComisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Servicio_Comision', function (Blueprint $table) {
            $table->integer('Id_Servicio_Comision', true);
            $table->float('Valor_Minimo', 15)->nullable();
            $table->float('Valor_Maximo', 15)->nullable();
            $table->float('Comision', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Servicio_Comision');
    }
}
