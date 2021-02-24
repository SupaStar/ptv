<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = "ventas";

    public function productos(){
        return $this->belongsToMany(Producto::class,"ventas_productos","venta_id","producto_id")->withPivot([
            "cantidad",
            "compra",
            "venta"
            ]);
    }
}
