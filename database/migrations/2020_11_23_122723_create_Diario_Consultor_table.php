<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiarioConsultorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Diario_Consultor', function (Blueprint $table) {
            $table->integer('Id_Diario_Consultor', true);
            $table->integer('Id_Funcionario');
            $table->date('Fecha_Apertura')->nullable();
            $table->time('Hora_Apertura')->nullable();
            $table->date('Fecha_Cierre')->nullable();
            $table->time('Hora_Cierre')->nullable();
            $table->integer('Id_Oficina')->nullable();
            $table->integer('Id_Caja')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Diario_Consultor');
    }
}
