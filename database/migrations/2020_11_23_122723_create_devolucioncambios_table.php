<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevolucioncambiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Devolucion_Cambios', function (Blueprint $table) {
            $table->integer('id', true);
            $table->dateTime('hora');
            $table->text('observacion')->nullable();
            $table->integer('motivodevolucioncambios_id');
            $table->bigInteger('cambio_id');
            $table->decimal('valor_entregado', 50, 0);
            $table->decimal('valor_recibido', 50, 0);
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Devolucion_Cambios');
    }
}
