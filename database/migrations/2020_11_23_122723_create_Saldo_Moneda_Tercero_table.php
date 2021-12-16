<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaldoMonedaTerceroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Saldo_Moneda_Tercero', function (Blueprint $table) {
            $table->integer('Id_Saldo_Moneda', true);
            $table->integer('Id_Tercero_Credito');
            $table->integer('Id_Moneda');
            $table->decimal('Valor_Bolsa', 20, 4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Saldo_Moneda_Tercero');
    }
}
