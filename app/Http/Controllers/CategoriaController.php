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

    public function create(Request $request){
        // return $request->all();
        $categoria = new Categoria();
        $categoria-> nombre = $request -> nombre;
        $categoria -> estado = $request -> estado;
        $categoria->save();

        return view("categorias.registro-categoria");
    }
    public function nuevo(Request $request)
    {
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->save();
        return view("/categorias/registro-categoria");
    }

    public function editap($id)
    {
        $categoria=Categoria::find($id);
        return view("categorias/editar-categoria",compact("categoria",$categoria));
    }
    public function actualizarcategoria(Request $request)
    {
        $categoria = Categoria::find($request->id);
        $categoria->nombre = $request->nombre;
        $categoria->save();

        return view ("categorias/categorias");
    }

    public function encontrar()
    {
        $categoria = Categoria::all();
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
