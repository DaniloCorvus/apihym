<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBancoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Banco', function (Blueprint $table) {
            $table->integer('Id_Banco', true);
            $table->string('Nombre', 200)->nullable();
            $table->text('Apodo');
            $table->string('Identificador', 200)->nullable();
            $table->text('Detalle');
            $table->integer('Id_Pais');
            $table->integer('Id_Moneda');
            $table->string('Estado', 100)->default('Activo');
            $table->double('Comision_Otros_Bancos')->nullable()->default(0);
            $table->double('Comision_Mayor_Valor')->nullable()->default(0);
            $table->double('Mayor_Valor')->nullable()->default(0);
            $table->double('Maximo_Transferencia_Otros_Bancos')->nullable()->default(0);
            $table->double('Comision_Consignacion_Nacional')->nullable()->default(0);
            $table->double('Comision_Cuatro_Mil')->nullable()->default(0);
            $table->double('Comision_Consignacion_Local')->nullable()->default(0);
            $table->double('Maximo_Consignacion_Local')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Banco');
    }
}
