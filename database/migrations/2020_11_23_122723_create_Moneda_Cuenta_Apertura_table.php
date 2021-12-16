<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonedaCuentaAperturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Moneda_Cuenta_Apertura', function (Blueprint $table) {
            $table->integer('Id_Moneda_Cuenta_Apertura', true);
            $table->integer('Id_Moneda');
            $table->integer('Id_Cuenta_Bancaria');
            $table->decimal('Valor', 20, 4);
            $table->integer('Id_Bloqueo_Cuenta')->default(0);
            $table->dateTime('Fecha_Apertura')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Moneda_Cuenta_Apertura');
    }
}
