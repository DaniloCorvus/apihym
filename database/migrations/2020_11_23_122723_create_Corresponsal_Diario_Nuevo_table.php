<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorresponsalDiarioNuevoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Corresponsal_Diario_Nuevo', function (Blueprint $table) {
            $table->integer('Id_Corresponsal_Diario', true);
            $table->integer('Id_Corresponsal_Bancario');
            $table->float('Retiro', 20);
            $table->float('Consignacion', 20);
            $table->float('Total_Corresponsal', 20);
            $table->date('Fecha');
            $table->time('Hora');
            $table->integer('Identificacion_Funcionario');
            $table->integer('Id_Caja');
            $table->integer('Id_Oficina');
            $table->integer('Id_Moneda');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Corresponsal_Diario_Nuevo');
    }
}
