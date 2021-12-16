<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiarioMonedaCierreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Diario_Moneda_Cierre', function (Blueprint $table) {
            $table->integer('Id_Diario_Moneda_Cierre', true);
            $table->integer('Id_Diario');
            $table->integer('Id_Moneda');
            $table->decimal('Valor_Moneda_Cierre', 20, 4);
            $table->decimal('Valor_Diferencia', 20, 4);
            $table->dateTime('Fecha_Registro')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Diario_Moneda_Cierre');
    }
}
