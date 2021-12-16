<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoAjusteCuentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tipo_Ajuste_Cuenta', function (Blueprint $table) {
            $table->integer('Id_Tipo_Ajuste_Cuenta', true);
            $table->string('Descripcion_Ajuste', 30);
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
        Schema::dropIfExists('Tipo_Ajuste_Cuenta');
    }
}
