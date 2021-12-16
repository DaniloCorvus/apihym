<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientoTerceroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Movimiento_Tercero', function (Blueprint $table) {
            $table->integer('Id_Movimiento_Tercero', true);
            $table->date('Fecha')->nullable();
            $table->text('Valor');
            $table->integer('Id_Moneda_Valor');
            $table->string('Tipo', 100);
            $table->integer('Id_Tercero')->nullable();
            $table->timestamp('Fecha_Creacion')->useCurrent();
            $table->text('Detalle');
            $table->integer('Id_Tipo_Movimiento')->default(0);
            $table->integer('Valor_Tipo_Movimiento')->default(0);
            $table->enum('Estado', ['Activo', 'Anulado'])->default('Activo');
            $table->integer('Id_Funcionario')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Movimiento_Tercero');
    }
}
