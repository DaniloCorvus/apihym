<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajeroPrincipalOficinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cajero_Principal_Oficina', function (Blueprint $table) {
            $table->bigInteger('Id', true);
            $table->bigInteger('Cajero_Principal_Id');
            $table->bigInteger('Oficina_Id');
            $table->timestamp('Created_At')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Cajero_Principal_Oficina');
    }
}
