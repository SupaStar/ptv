<?php

namespace App\Http\Controllers;

use App\Imports\ProductosCategoriaImport;
use App\Imports\ProductosImport;
use App\Producto;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ApiController extends Controller
{
    public function llenarproductos(){
        $xd=Excel::import(new ProductosImport, request()->file('excel'));
        echo json_encode($xd);
    }
    public function llenarCategoriaproductos(){
        $xd=Excel::import(new ProductosCategoriaImport, request()->file('excel'));
        echo json_encode($xd);
    }

    public  function mostrarProductos(){
        $productos = Producto::all();
        echo json_encode($productos);
    }


}
