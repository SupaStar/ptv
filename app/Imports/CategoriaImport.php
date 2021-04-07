<?php

namespace App\Imports;

use App\Categoria;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoriaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $bd=Categoria::where('nombre',$row['categoria'])->first();
        if(!$bd){
            return new Categoria([
                'nombre'=>$row['categoria']
            ]);
        }
        return $bd;
    }
}
