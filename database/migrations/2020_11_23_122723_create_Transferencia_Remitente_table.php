<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferenciaRemitenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Transferencia_Remitente', function (Blueprint $table) {
            $table->bigInteger('Id_Transferencia_Remitente')->primary();
            $table->string('Nombre', 100)->nullable();
            $table->string('Telefono', 50);
            $table->enum('Estado', ['Activo', 'Inactivo'])->default('Activo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Transferencia_Remitente');
    }
}
