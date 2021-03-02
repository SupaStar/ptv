<?php

namespace App\Http\Controllers;

use App\CategoriaProducto;
use Illuminate\Http\Request;

class CategoriaProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware(["isAdmin"])->except(["index"]);
    }

    public function nuevo(Request $request)
    {
        $categoriaP = new CategoriaProducto();
        $categoriaP->id_producto = $request->input('id_producto');
        $categoriaP->id_categoria = $request->input('id_categoria');
        $categoriaP->save();
        return response()->json($categoriaP);
    }

    public function editar($id, Request $request)
    {
        $categoriaP = CategoriaProducto::find($id);
        $categoriaP->id_producto = $request->input('id_producto');
        $categoriaP->id_categoria = $request->input('id_categoria');
        $categoriaP->save();
        return response()->json($categoriaP);
    }

    public function encontrar($id)
    {
        $categoriaP = CategoriaProducto::find($id);
        return response()->json($categoriaP);
    }

    public function eliminar($id)
    {
        $categoriaP = CategoriaProducto::find($id);
        return response()->json($categoriaP);
    }
}
