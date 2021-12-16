<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaldoCuentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Saldo_Cuenta', function (Blueprint $table) {
            $table->integer('Id_Saldo_Cuenta', true);
            $table->integer('Id_Cuenta_Bancaria');
            $table->bigInteger('Saldo')->nullable();
            $table->date('Fecha');
            $table->timestamp('Hora')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Saldo_Cuenta');
    }
}
