<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiroComisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Giro_Comision', function (Blueprint $table) {
            $table->integer('Id_Giro_Comision', true);
            $table->double('Valor_Minimo', 15, 2);
            $table->double('Valor_Maximo', 15, 2);
            $table->double('Comision', 15, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Giro_Comision');
    }
}
