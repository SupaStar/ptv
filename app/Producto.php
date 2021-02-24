<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "productos";

    protected $hidden = ["compra"];

    public function ventas(){
        return $this->belongsToMany("ventas_productos","producto_id","venta_id");
    }

    // Scopes
    protected static function boot(){
        parent::boot();
        static::addGlobalScope('precios', function (Builder $builder) {
            $builder->where('productos.compra', "!=", -1)->where("productos.venta","!=",-1);
        });
    }
}
