<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFuncionarioContactoEmergenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Funcionario_Contacto_Emergencia', function (Blueprint $table) {
            $table->foreign('Identificacion_Funcionario', 'Funcionario_Contacto_Emergencia_ibfk_1')->references('Identificacion_Funcionario')->on('Funcionario')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Funcionario_Contacto_Emergencia', function (Blueprint $table) {
            $table->dropForeign('Funcionario_Contacto_Emergencia_ibfk_1');
        });
    }
}
