<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "productos";
    protected $fillable = ['nombre', 'compra', 'venta', 'stock', 'fecha_caducidad', 'codigo', 'descripcion', 'estado'];

    public function ventas()
    {
        return $this->belongsToMany("ventas_productos", "producto_id", "venta_id");
    }

    public function categoria()
    {
        return $this->belongsToMany('App\Categoria', 'categoria_producto', 'id_producto', 'id_categoria');
    }

    // Scopes
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('precios', function (Builder $builder) {
            $builder->where('productos.compra', "!=", -1)->where("productos.venta", "!=", -1);
        });
    }
}
