<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Giro', function (Blueprint $table) {
            $table->integer('Id_Giro', true);
            $table->integer('Documento_Remitente');
            $table->string('Nombre_Remitente', 100);
            $table->string('Telefono_Remitente', 100);
            $table->double('Valor_Recibido', 12, 2);
            $table->double('Valor_Entrega', 12, 2);
            $table->double('Valor_Total', 15, 2);
            $table->string('Comision', 100);
            $table->integer('Documento_Destinatario');
            $table->string('Nombre_Destinatario', 100);
            $table->string('Telefono_Destinatario', 100);
            $table->integer('Identificacion_Funcionario');
            $table->timestamp('Fecha')->useCurrent();
            $table->integer('Id_Oficina');
            $table->integer('Id_Caja');
            $table->text('Detalle');
            $table->string('Estado', 100)->default('Pendiente');
            $table->date('Fecha_Pago')->nullable();
            $table->string('Codigo', 100);
            $table->text('Motivo_Devolucion')->nullable();
            $table->integer('Departamento_Remitente');
            $table->integer('Municipio_Remitente');
            $table->integer('Departamento_Destinatario');
            $table->integer('Municipio_Destinatario');
            $table->integer('Funcionario_Pago')->nullable();
            $table->integer('Caja_Pago')->nullable();
            $table->integer('Id_Moneda')->default(1);
            $table->boolean('Giro_Libre')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Giro');
    }
}
