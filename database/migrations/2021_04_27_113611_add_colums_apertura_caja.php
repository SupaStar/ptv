<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumsAperturaCaja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aperturas_caja', function (Blueprint $table) {
            $table->decimal("ventas_finales_tarjeta")->nullable()->after('ventas_finales');
            $table->decimal("utilidades_tarjeta")->nullable()->after('utilidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
