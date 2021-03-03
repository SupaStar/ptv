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
    
//TODO funcion mas vendidos mover a donde se necesite
    public function productos(){
        $ventas = Venta::whereMonth('created_at',Carbon::now()->format('m'))->get();
        $productosTop=[];
        foreach ($ventas as $venta){
            $repeticiones=$venta->nRepeticionesP();
            foreach ($repeticiones as $clave=>$repeticion){
                $columnas= array_column($productosTop, 'id');
                $existe=array_search($clave,$columnas);
                if ($existe==false){
                    $venta=['id'=>$clave,'repeticiones'=>$repeticion];
                    array_push($productosTop,$venta);
                }else{
                    $productosTop[$existe]['repeticiones']+=$repeticion;
                }
            }
        }
        usort($productosTop, function($a, $b) {
            return  $b['repeticiones']<=> $a['repeticiones'];
        });
        $productosTop=array_slice($productosTop,0,10);
        $productosCategoria=[];
        foreach ($productosTop as $producto){
            $prod=Producto::find($producto['id']);
            $prod->categoria;
            array_push($productosCategoria,$prod);
        }
        echo json_encode($productosCategoria);
    }
}
