<?php

use App\Configuracion;
use Illuminate\Database\Seeder;

class AddConfiguracionesGeneralesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuracion::updateOrCreate(["id" => 1, "clave" => "ESTADO_CAJA", "valor" => "cerrada"]);
        // Configuracion::updateOrCreate(["id" => 2, "clave" => "FECHA_HORA_APERTURA", "valor" => ""]);
    }
}
