<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Producto;
use App\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");

    }

    public function nuevo(Request $request)
    {
        $categoria = new Categoria();
        $categoria->nombre = $request->input('nombre');
        $categoria->save();
        return response()->json($categoria);
    }

    public function editar($id, Request $request)
    {
        $categoria = Categoria::find($id);
        $categoria->nombre = $request->input('nombre');
        $categoria->save();
        return response()->json($categoria);
    }

    public function encontrar($id)
    {
        $categoria = Categoria::find($id);
        return response()->json($categoria);
    }

    public function eliminar($id)
    {
        $categoria = Categoria::find($id);
        $categoria->estado = 0;
        $categoria->save();
        return response()->json($categoria);
    }
    public function categoria()
    {
        return view("categorias.categorias");
    }
    public function registroCategoria()
    {
        return view("categorias.registro-categoria");
    }
    public function getCategorias()
    {
        $categorias=Categoria::all()->where("estado",">",0);
        return response()->json($categorias);
    }
}
