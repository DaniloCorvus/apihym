<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentaBancariaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cuenta_Bancaria', function (Blueprint $table) {
            $table->integer('Id_Cuenta_Bancaria', true);
            $table->string('Numero_Cuenta', 200)->nullable();
            $table->integer('Id_Banco')->nullable();
            $table->string('Nombre_Titular', 200)->nullable();
            $table->bigInteger('Identificacion_Titular')->nullable();
            $table->dateTime('Fecha')->nullable()->useCurrent();
            $table->text('Detalle');
            $table->string('Estado', 100)->default('Activo');
            $table->string('Tipo_Cuenta', 100);
            $table->decimal('Comision_Bancaria', 20);
            $table->integer('Id_Pais');
            $table->string('Tipo', 100)->nullable();
            $table->text('Monto_Inicial')->nullable();
            $table->integer('Id_Moneda');
            $table->enum('Asignada', ['Si', 'No'])->default('No');
            $table->enum('Estado_Apertura', ['Abierta', 'Cerrada', 'Seleccionada'])->default('Cerrada');
            $table->integer('Funcionario_Seleccion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Cuenta_Bancaria');
    }
}
