<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Compra', function (Blueprint $table) {
            $table->integer('Id_Compra', true);
            $table->string('Codigo', 100);
            $table->integer('Id_Funcionario');
            $table->integer('Id_Tercero');
            $table->float('Valor_Compra', 50);
            $table->float('Tasa', 50);
            $table->float('Valor_Peso', 50);
            $table->timestamp('Fecha')->useCurrent();
            $table->string('Hora', 10)->nullable()->default('00:00:00');
            $table->text('Detalle');
            $table->integer('Id_Moneda_Compra');
            $table->enum('Estado', ['Activa', 'Anulada', 'Pendiente'])->default('Activa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Compra');
    }
}
