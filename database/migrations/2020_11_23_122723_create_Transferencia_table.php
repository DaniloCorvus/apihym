<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Transferencia', function (Blueprint $table) {
            $table->integer('Id_Transferencia', true);
            $table->string('Codigo', 45);
            $table->timestamp('Fecha')->useCurrent();
            $table->string('Forma_Pago', 45);
            $table->string('Tipo_Transferencia', 45);
            $table->string('Moneda_Origen', 45)->default('Pesos');
            $table->string('Moneda_Destino', 45)->default('Bolivares');
            $table->string('Documento_Origen', 45)->nullable();
            $table->text('Observacion_Transferencia');
            $table->enum('Estado', ['Activa', 'Pagada', 'Anulada', ''])->default('Activa');
            $table->string('Id_Cuenta_Bancaria', 100)->nullable();
            $table->string('Identificacion_Funcionario', 100)->nullable();
            $table->text('Cantidad_Recibida')->nullable()->comment('Valor en pesos');
            $table->text('Cantidad_Transferida')->nullable()->comment('Valor en moneda extranjera');
            $table->bigInteger('Cantidad_Recibida_Bolsa_Bolivares')->comment('Aqui se guarda el monto de la bolsa de bolivares usados para una transferencia de credito, en caso de que se use bolsa');
            $table->text('Motivo_Anulacion')->nullable();
            $table->integer('Id_Caja')->nullable();
            $table->integer('Id_Oficina')->nullable();
            $table->double('Tasa_Cambio');
            $table->enum('Tipo_Origen', ['Tercero', 'Remitente'])->nullable()->default('Remitente');
            $table->enum('Tipo_Destino', ['Destinatario', 'Tercero'])->default('Destinatario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Transferencia');
    }
}
