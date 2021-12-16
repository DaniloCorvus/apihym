<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOficinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Oficina', function (Blueprint $table) {
            $table->integer('Id_Oficina', true);
            $table->string('Nombre', 200);
            $table->string('Telefono', 200);
            $table->string('Celular', 200);
            $table->string('Correo', 200);
            $table->string('Direccion', 200);
            $table->integer('Id_Municipio');
            $table->integer('Limite_Transferencia');
            $table->string('Nombre_Establecimiento', 200);
            $table->string('Lema', 200);
            $table->string('Pie_Pagina', 200);
            $table->enum('Estado', ['Activa', 'Inactiva'])->default('Activa');
            $table->timestamp('Creado')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Oficina');
    }
}
