<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware(["isAdmin"])->except(["index"]);
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
}