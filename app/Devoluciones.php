<?php


namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Devoluciones extends Model
{
    protected $table = "devoluciones";

    public function productos()
    {
        return $this->belongsToMany(Producto::class, "devoluciones_productos", "devolucion_id", "producto_id")->withPivot([
            "cantidad",
            "motivo"
        ]);
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}