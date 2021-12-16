<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiroRemitenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Giro_Remitente', function (Blueprint $table) {
            $table->bigInteger('Documento_Remitente')->primary();
            $table->integer('Id_Tipo_Documento')->default(1);
            $table->string('Nombre_Remitente', 100)->nullable();
            $table->string('Telefono_Remitente', 100)->nullable();
            $table->enum('Estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->timestamp('Fecha')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Giro_Remitente');
    }
}
