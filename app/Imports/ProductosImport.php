<?php

namespace App\Imports;

use App\Producto;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductosImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $bd = Producto::where('nombre', $row['nombre'])->where('descripcion', $row['descripcion'])->first();
        if (!$bd) {
            return new Producto([
                'nombre' => $row['nombre'],
                'compra' => doubleval($row['venta'])/2,
                'venta' => doubleval($row['venta']),
                'stock' => doubleval($row['stock']),
                'fecha_caducidad' => date('Y-m-d',strtotime('1899-12-31+'.(intval($row['caducidad'])-1).' days')),
                'codigo' => $row['codigo'],
                'descripcion' => $row['descripcion'],
                'estado' => 1,
            ]);
        }
    }
}
