<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinatarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Destinatario', function (Blueprint $table) {
            $table->bigInteger('Id_Destinatario')->primary();
            $table->string('Nombre', 200)->nullable();
            $table->enum('Estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->string('Tipo_Documento', 100);
            $table->integer('Id_Pais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Destinatario');
    }
}
