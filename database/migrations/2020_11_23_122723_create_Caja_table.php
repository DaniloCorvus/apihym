<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Caja', function (Blueprint $table) {
            $table->integer('Id_Caja', true);
            $table->integer('Id_Oficina')->nullable();
            $table->string('Nombre', 200)->nullable();
            $table->mediumText('Detalle');
            $table->enum('Estado', ['Activa', 'Inactiva'])->default('Activa');
            $table->string('MAC', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Caja');
    }
}
