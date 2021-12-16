<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrasladoCajaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Traslado_Caja', function (Blueprint $table) {
            $table->integer('Id_Traslado_Caja', true);
            $table->integer('Funcionario_Destino')->nullable();
            $table->integer('Id_Cajero_Origen')->nullable();
            $table->integer('Valor')->nullable();
            $table->string('Detalle', 200)->nullable();
            $table->integer('Id_Moneda');
            $table->timestamp('Fecha_Traslado')->nullable()->useCurrent();
            $table->dateTime('created_at')->nullable();
            $table->enum('Estado', ['Pendiente', 'Anulado', 'Aprobado', 'Negado'])->default('Pendiente');
            $table->string('Aprobado', 100)->nullable();
            $table->string('Codigo', 100);
            $table->text('Identificacion_Funcionario');
            $table->string('Alerta', 100)->default('Si');
            $table->integer('Id_Caja')->nullable();
            $table->integer('Id_Oficina')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Traslado_Caja');
    }
}
