<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Diario', function (Blueprint $table) {
            $table->integer('Id_Diario', true);
            $table->date('Fecha');
            $table->string('Hora_Apertura', 100);
            $table->integer('Id_Funcionario');
            $table->integer('Caja_Apertura');
            $table->integer('Oficina_Apertura');
            $table->integer('Caja_Cierre')->nullable()->default(0);
            $table->integer('Oficina_Cierre')->nullable()->default(0);
            $table->string('Hora_Cierre', 100)->nullable()->default('00:00:00');
            $table->text('Observacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Diario');
    }
}
