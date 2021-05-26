<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevolucionesProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devoluciones_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('venta_id');
            $table->integer('devolucion_id');
            $table->integer('producto_id');
            $table->integer('cantidad');
            $table->integer('motivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devoluciones_productos');
    }
}
