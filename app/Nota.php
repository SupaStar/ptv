<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = "notas";
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
