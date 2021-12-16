<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiarioCuentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Diario_Cuenta', function (Blueprint $table) {
            $table->integer('Id_Diario_Cuenta', true);
            $table->integer('Id_Diario_Consultor');
            $table->integer('Id_Cuenta_Bancaria');
            $table->decimal('Monto_Apertura', 20);
            $table->decimal('Monto_Cierre', 20)->nullable();
            $table->dateTime('Fecha_Registro')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Diario_Cuenta');
    }
}
