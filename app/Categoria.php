<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';

    public function productos()
    {
        return $this->belongsToMany('App\Producto', 'categoria_producto', 'id_categoria', 'id_producto');
    }
}
