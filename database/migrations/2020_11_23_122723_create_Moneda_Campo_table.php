<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonedaCampoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Moneda_Campo', function (Blueprint $table) {
            $table->integer('Id_Moneda_Campo', true);
            $table->string('Campo_Visual', 200);
            $table->string('Columna', 100);
            $table->string('Color', 100);
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
        Schema::dropIfExists('Moneda_Campo');
    }
}
