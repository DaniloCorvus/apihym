<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokenPermisoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Token_Permiso', function (Blueprint $table) {
            $table->integer('Id_Token_Permiso', true);
            $table->string('Token', 10);
            $table->integer('Consumido_Por');
            $table->string('Usado_Para', 30)->nullable();
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
        Schema::dropIfExists('Token_Permiso');
    }
}
