<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Producto;
use App\Venta;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();

        return view("productos.index", compact("productos"));
    }
    public function productos()
    {
        $productos = Producto::orderBy("estado","DESC")->get();
        foreach($productos as $producto)
        {
            if($producto->estado==1){
                $producto->estado="Activo";
            }
            else{
                $producto->estado="Inactivo";

            }
        }

        return response()->json($productos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        // return $request->all();
        $productos = new Producto();
        $productos-> nombre = $request -> nombre;
        $productos -> compra = $request -> compra;
        $productos -> venta = $request -> venta;
        $productos -> stock = $request -> stock;
        $productos -> fecha_caducidad = $request -> fecha_caducidad;
        $productos -> codigo = $request -> codigo;
        $productos -> descripcion = $request -> descripcion;
        $productos->save();

        return view("productos.registro-productos");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->venta = $request->venta;
        $producto->compra = $request->compra;
        if($request->stock==0){
            $producto->stock = $request->stock;
            $producto->estado = 0;
        }
        else
        {
            $producto->stock = $request->stock;
            $producto->estado = 1;
        }
        $producto->fecha_caducidad = $request->fecha_caducidad;
        $producto->descripcion = $request->descripcion;
        $producto->codigo = $request->codigo;
        $producto->save();


        return view ("productos/registro-productos");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Producto::destroy($id);
        return redirect()->route("productos.index")->with("estado", "Producto eliminado correctamente");
    }

    public function pendientes()
    {
        $productos = Producto::withoutGlobalScopes(["precios"])
            ->where("compra", -1)
            ->orWhere("venta", -1)->get();

        return view("productos.index", compact("productos"));
    }

    public function editarPrecio(Request $request)
    {
        try {
            $prod = Producto::withoutGlobalScopes(["precios"])->find($request->id);
            if ($request->tipo == "venta")
                $prod->venta = $request->precio;
            else
                $prod->compra = $request->precio;

            $prod->save();

            return response()->json(["estado" => true]);
        } catch (Exception $th) {
            return response()->json(["estado" => false]);
        }

    }

    public function editarNombre(Request $request)
    {
        try {
            $prod = Producto::withoutGlobalScopes(["precios"])->find($request->id);
            $prod->nombre = $request->nombre;
            $prod->save();

            return response()->json(["estado" => true]);
        } catch (Exception $th) {
            return response()->json(["estado" => false]);
        }

    }

    public function editarStock(Request $request)
    {
        try {
            $prod = Producto::withoutGlobalScopes(["precios"])->find($request->id);
            $prod->stock = $request->stock;
            $prod->save();

            return response()->json(["estado" => true]);
        } catch (Exception $th) {
            return response()->json(["estado" => false]);
        }

    }

    public function editarFechaC(Request $request)
    {
        try {
            $prod = Producto::withoutGlobalScopes(["precios"])->find($request->id);
            $prod->fecha_caducidad = $request->fechaC;
            $prod->save();

            return response()->json(["estado" => true]);
        } catch (Exception $th) {
            return response()->json(["estado" => false]);
        }

    }

    public function editarCodigo(Request $request)
    {
        try {
            $prod = Producto::withoutGlobalScopes(["precios"])->find($request->id);
            $prod->codigo = $request->codigo;
            $prod->save();

            return response()->json(["estado" => true]);
        } catch (Exception $th) {
            return response()->json(["estado" => false]);
        }

    }

    public function editarDescripcion(Request $request)
    {
        try {
            $prod = Producto::withoutGlobalScopes(["precios"])->find($request->id);
            $prod->descripcion = $request->descripcion;
            $prod->save();

            return response()->json(["estado" => true]);
        } catch (Exception $th) {
            return response()->json(["estado" => false]);
        }

    }
    public function productosMasVendidos(){
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

        return json_encode($productosCategoria);
    }
    public function getProductos()
    {
        return view("productos.productos");
    }
    public function registro()
    {
        return view("productos.registro-productos");
    }
    public function editap($id)
    {
        $producto=Producto::find($id);
        return view("productos/edita-productos",compact("producto",$producto));
    }
    public function findp(Request $request)
    {
        $producto=Producto::find($request->id);
        return response()->json($producto);
    }
    public function desactivap(Request $request)
    {
        $producto=Producto::find($request->id);

        $producto->estado=0;
        $producto->save();
        return response()->json($producto);
    }
    public function actualizarproducto(Request $request)
    {
        $producto=Producto::find($request->id);
        $producto->nombre = $request->nombre;
        $producto->venta = $request->venta;
        $producto->compra = $request->compra;
        if($request->stock==0){
            $producto->stock = $request->stock;
            $producto->estado = 0;
        }
        else
        {
            $producto->stock = $request->stock;
            $producto->estado = $request->estado;
        }
        $producto->fecha_caducidad = $request->fecha_caducidad;
        $producto->descripcion = $request->descripcion;
        $producto->codigo = $request->codigo;
        $producto->save();
        return view ("productos/productos");
    }



}


