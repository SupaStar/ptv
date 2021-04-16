<?php

namespace App\Imports;

use App\Categoria;
use App\CategoriaProducto;
use App\Producto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductosCategoriaImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        $categoria = Categoria::where('nombre', $row['categoria'])->first();
        if (!$categoria) {
            $categoria = new Categoria([
                'nombre' => $row['categoria'],
                'estado' => 1
            ]);
            $categoria->save();
        }
        $producto = Producto::where('nombre', $row['nombre'])->where('descripcion', $row['descripcion'])->first();
        if (!$producto) {
            $producto = new Producto([
                'nombre' => $row['nombre'],
                'compra' => doubleval($row['venta']) / 2,
                'venta' => doubleval($row['venta']),
                'stock' => doubleval($row['stock']),
                'fecha_caducidad' => date('Y-m-d', strtotime('1899-12-31+' . (intval($row['caducidad']) - 1) . ' days')),
                'codigo' => $row['codigo'],
                'descripcion' => $row['descripcion'],
                'estado' => 1,
            ]);
            $producto->save();
        }
        return new CategoriaProducto([
            'id_producto'=>$producto->id,
            'id_categoria'=>$categoria->id
        ]);
    }
}
