<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonoCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Abono_Compra', function (Blueprint $table) {
            $table->integer('Id_Abono_Compra', true);
            $table->integer('Id_Compra_Cuenta');
            $table->float('Abono', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Abono_Compra');
    }
}
