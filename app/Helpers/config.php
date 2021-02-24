<?php

use App\Configuracion;

if (!function_exists('_c')) {
    function _c($clave)
    {
        $c = Configuracion::where("clave", $clave)->first();
        if (!$c)
            return null;
        return $c->valor;
    }
}
