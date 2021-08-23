<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasProductosDevolucionesTable extends Migration
{
    /**
     * Run the migrations.php
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_productos_devoluciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("venta_id")->index();
            $table->integer("producto_id")->index();
            $table->integer("cantidad");
            $table->decimal("compra");
            $table->decimal("venta");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas_productos_devoluciones');
    }
}
