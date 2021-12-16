<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraCuentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Compra_Cuenta', function (Blueprint $table) {
            $table->integer('Id_Compra_Cuenta', true);
            $table->integer('Id_Compra')->nullable();
            $table->integer('Id_Cuenta_Bancaria');
            $table->integer('Id_Funcionario');
            $table->float('Valor', 50);
            $table->string('Numero_Transaccion', 50)->nullable();
            $table->enum('Estado', ['Cheque', 'Otro', 'Bloqueada'])->default('Bloqueada');
            $table->text('Detalle');
            $table->timestamp('Fecha')->useCurrent();
            $table->integer('Id_Consultor_Apertura_Cuenta')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Compra_Cuenta');
    }
}
