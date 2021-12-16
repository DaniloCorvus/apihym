<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerceroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tercero', function (Blueprint $table) {
            $table->integer('Id_Tercero')->default(0)->primary();
            $table->string('Nombre', 200)->nullable();
            $table->string('Direccion', 200)->nullable();
            $table->string('Telefono', 100)->nullable();
            $table->string('Celular', 15)->nullable();
            $table->string('Correo', 100)->nullable();
            $table->date('Tercero_Desde')->nullable();
            $table->string('Destacado', 2)->nullable();
            $table->string('Credito', 2)->nullable();
            $table->bigInteger('Cupo')->nullable();
            $table->bigInteger('Cupo_Disponible');
            $table->text('Detalle')->nullable();
            $table->integer('Id_Departamento')->nullable();
            $table->integer('Id_Municipio')->nullable();
            $table->integer('Id_Tipo_Documento')->nullable();
            $table->string('Barrio', 20)->nullable();
            $table->integer('Id_Grupo_Tercero')->nullable()->default(0);
            $table->enum('Tipo_Tercero', ['Cliente', 'Proveedor']);
            $table->enum('Estado', ['Activo', 'Inactivo'])->default('Activo');
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
        Schema::dropIfExists('Tercero');
    }
}
