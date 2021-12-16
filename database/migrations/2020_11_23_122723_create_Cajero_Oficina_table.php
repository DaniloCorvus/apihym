<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajeroOficinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cajero_Oficina', function (Blueprint $table) {
            $table->integer('Id_Cajero_Oficina', true);
            $table->integer('Id_Cajero');
            $table->integer('Id_Oficina');
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
        Schema::dropIfExists('Cajero_Oficina');
    }
}
