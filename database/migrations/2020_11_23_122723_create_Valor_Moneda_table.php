<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorMonedaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Valor_Moneda', function (Blueprint $table) {
            $table->integer('Id_Valor_Moneda', true);
            $table->integer('Id_Moneda');
            $table->decimal('Min_Venta_Efectivo', 50, 0)->default(0);
            $table->decimal('Max_Venta_Efectivo', 50)->default(0.00);
            $table->decimal('Sugerido_Venta_Efectivo', 50)->default(0.00);
            $table->decimal('Min_Compra_Efectivo', 50)->default(0.00);
            $table->decimal('Max_Compra_Efectivo', 50)->default(0.00);
            $table->decimal('Sugerido_Compra_Efectivo', 50)->default(0.00);
            $table->decimal('Min_Venta_Transferencia', 50)->default(0.00);
            $table->decimal('Max_Venta_Transferencia', 50)->default(0.00);
            $table->decimal('Sugerido_Venta_Transferencia', 50)->default(0.00);
            $table->decimal('Costo_Transferencia', 50)->default(0.00);
            $table->decimal('Comision_Efectivo_Transferencia', 50)->default(0.00);
            $table->decimal('Pagar_Comision_Desde', 50)->default(0.00);
            $table->decimal('Min_No_Cobro_Transferencia', 50)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Valor_Moneda');
    }
}
