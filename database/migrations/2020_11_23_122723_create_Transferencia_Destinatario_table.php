<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferenciaDestinatarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Transferencia_Destinatario', function (Blueprint $table) {
            $table->integer('Id_Transferencia_Destinatario', true);
            $table->string('Numero_Documento_Destino', 100)->nullable();
            $table->integer('Id_Destinatario_Cuenta')->nullable();
            $table->text('Valor_Transferencia_Bolivar')->nullable();
            $table->integer('Id_Transferencia');
            $table->integer('Id_Recibo')->nullable();
            $table->integer('Id_Moneda');
            $table->float('Valor_Transferencia', 20)->comment('Valor en moneda extranjera');
            $table->enum('Estado', ['Pendiente', 'Pagada', 'Anulada'])->default('Pendiente');
            $table->enum('Estado_Consultor', ['Abierta', 'Cerrada'])->default('Cerrada');
            $table->integer('Funcionario_Opera')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Transferencia_Destinatario');
    }
}
