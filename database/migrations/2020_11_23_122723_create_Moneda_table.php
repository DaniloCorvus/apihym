<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonedaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Moneda', function (Blueprint $table) {
            $table->integer('Id_Moneda', true);
            $table->string('Codigo', 10)->nullable();
            $table->string('Nombre', 100)->nullable();
            $table->integer('Id_Pais');
            $table->integer('Orden')->nullable();
            $table->enum('Estado', ['Activa', 'Inactiva'])->default('Activa');
            $table->string('MDefault', 25)->nullable();
            $table->boolean('Compras')->default(0);
            $table->boolean('Transferencia')->default(0);
            $table->boolean('Gasto')->default(0);
            $table->boolean('ServicioExterno')->default(0);
            $table->boolean('CorresponsalBancario')->default(0);
            $table->boolean('Traslado')->default(0);
            $table->boolean('Giro')->default(0);
            $table->boolean('Cambio')->default(0);
            $table->decimal('Monto_Minimo_Diferencia_Transferencia', 20, 4)->default(0.0000);
            $table->decimal('Monto_Maximo_Diferencia_Transferencia', 20, 4)->default(0.0000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Moneda');
    }
}
