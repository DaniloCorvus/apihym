<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinatarioCuentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Destinatario_Cuenta', function (Blueprint $table) {
            $table->integer('Id_Destinatario_Cuenta', true);
            $table->integer('Id_Destinatario')->nullable();
            $table->integer('Id_Banco')->nullable();
            $table->string('Numero_Cuenta', 50)->nullable();
            $table->integer('Id_Pais')->nullable();
            $table->integer('Id_Tipo_Cuenta')->nullable();
            $table->enum('Estado', ['Activa', 'Inactiva'])->default('Activa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Destinatario_Cuenta');
    }
}
