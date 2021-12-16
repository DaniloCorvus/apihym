<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientoCuentaBancariaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Movimiento_Cuenta_Bancaria', function (Blueprint $table) {
            $table->integer('Id_Movimiento_Cuenta_Bancaria', true);
            $table->date('Fecha')->nullable();
            $table->decimal('Valor', 20);
            $table->string('Tipo', 100);
            $table->integer('Id_Cuenta_Bancaria')->nullable();
            $table->timestamp('Fecha_Creacion')->useCurrent();
            $table->text('Detalle');
            $table->integer('Id_Tipo_Movimiento_Bancario');
            $table->integer('Valor_Tipo_Movimiento_Bancario');
            $table->text('Numero_Transferencia')->nullable();
            $table->enum('Movimiento_Cerrado', ['Si', 'No'])->nullable()->default('No');
            $table->integer('Id_Consultor_Apertura_Cuenta')->nullable();
            $table->enum('Estado', ['Activo', 'Anulado'])->default('Activo');
            $table->integer('Id_Funcionario')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Movimiento_Cuenta_Bancaria');
    }
}
