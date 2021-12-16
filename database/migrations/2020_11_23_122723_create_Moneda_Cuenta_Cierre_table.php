<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonedaCuentaCierreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Moneda_Cuenta_Cierre', function (Blueprint $table) {
            $table->integer('Id_Moneda_Cierre_Cuenta', true);
            $table->integer('Id_Moneda');
            $table->integer('Id_Cuenta_Bancaria');
            $table->decimal('Valor', 20, 4);
            $table->integer('Id_Bloqueo_Cuenta');
            $table->dateTime('Fecha_Cierre')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Moneda_Cuenta_Cierre');
    }
}
