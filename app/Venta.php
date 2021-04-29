<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Venta extends Model
{
    protected $table = "ventas";

    public function productos()
    {
        return $this->belongsToMany(Producto::class, "ventas_productos", "venta_id", "producto_id")->withPivot([
            "cantidad",
            "compra",
            "venta"
        ]);
    }
    public function usuario()
    {
        //return $this->hasOne(User::class, 'usuario_id');
        return $this->hasOne(User::class, 'usuario_id', 'id');
    }

    public function nRepeticionesP()
    {
        $ventas = DB::table('ventas_productos')->where('venta_id', '=', $this->id)->get();
        $nRepeticiones = [];
        foreach ($ventas as $venta) {
            array_push($nRepeticiones, $venta->producto_id);
        }
        return array_count_values($nRepeticiones);
    }
}
