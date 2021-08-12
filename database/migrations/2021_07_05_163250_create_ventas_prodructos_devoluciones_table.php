<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasProdructosDevolucionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_prodructos_devoluciones', function (Blueprint $table) {
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
        Schema::dropIfExists('ventas_prodructos_devoluciones');
    }
}
