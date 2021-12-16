<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonedaOficinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Moneda_Oficina', function (Blueprint $table) {
            $table->integer('Id', true);
            $table->integer('Id_Moneda');
            $table->integer('Oficina_Id');
            $table->integer('Monto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Moneda_Oficina');
    }
}
