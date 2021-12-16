<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Servicio', function (Blueprint $table) {
            $table->integer('Id_Servicio', true);
            $table->string('Servicio_Externo', 30)->nullable();
            $table->integer('Comision')->nullable();
            $table->integer('Valor')->nullable();
            $table->longText('Detalle')->nullable();
            $table->dateTime('Fecha')->useCurrent();
            $table->string('Codigo', 100)->nullable();
            $table->string('Estado', 100)->default('Activo');
            $table->text('Identificacion_Funcionario');
            $table->integer('Id_Caja')->nullable();
            $table->integer('Id_Oficina')->nullable();
            $table->integer('Id_Moneda')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Servicio');
    }
}
