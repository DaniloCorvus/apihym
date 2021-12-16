<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBolsaBolivaresTerceroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Bolsa_Bolivares_Tercero', function (Blueprint $table) {
            $table->integer('Id_Bolsa_Bolivares_Tercero', true);
            $table->integer('Id_Tercero');
            $table->bigInteger('Bolsa_Bolivares');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Bolsa_Bolivares_Tercero');
    }
}
