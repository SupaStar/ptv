<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\CategoriaProducto;
use App\Perfil;
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
    public function productos(Request $request)
    {
        if($request->filtro==1)
        {
            $productos=Producto::orderBy("estado","DESC")->where("estado","=",1)->whereDate("fecha_caducidad",">=",Carbon::now()->format('Y-m-d'))->whereDate("fecha_caducidad","<=",Carbon::now()->addDays(15)->format('Y-m-d'))->get();
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

        }elseif($request->filtro==2)
        {
            $productos=Producto::orderBy("estado","DESC")->where("stock","<=",10)->get();
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

        }elseif($request->filtro==3)
        {
            $productos=Producto::orderBy("estado","DESC")->where("stock","=",0)->get();
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

        }elseif($request->filtro==4)
        {
            $productos=Producto::orderBy("estado","DESC")->where("estado","=",0)->get();
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
        elseif($request->filtro==5)
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
        else
        {
        $productos = Producto::orderBy("estado","DESC")->where("estado","=",1)->where("stock",">",0)->get();
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
        if($request -> fecha_caducidad<=\Carbon\Carbon::now()->format("Y-m-d")){
            return response()->json(["estado"=>false, "detalle"=>"Producto Caducado o pronto a caducar"]);

        }
        else {
            $productos->fecha_caducidad = $request->fecha_caducidad;
        }
        if ($usuariouser = Producto::all()->where("codigo", $request -> codigo)->count() >= 1) {

             return response()->json(["estado"=>false, "detalle"=>"Usuario Repetido"]);
        } else {

            $productos -> codigo = $request -> codigo;
        }

        $productos -> descripcion = $request -> descripcion;
        $productos->save();

        return redirect("/productos");
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
        $categoriaproducto= new CategoriaProducto();
        $producto->nombre = $request->nombre;
        $producto->venta = $request->venta;
        $producto->compra = $request->compra;
        if($request->stock<1){
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
        $categoriaproducto->id_producto=$producto->id;
        $categoriaproducto->id_categoria=$request->idcategoria;
        $categoriaproducto->save();
        return redirect("/productos");
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

        //return response()->json_decode($productosTop);
        //return ($productosTop);

        $productosTop=array_slice($productosTop,0,10);
        $productosCategoria=[];
        foreach ($productosTop as $producto){
            $prod=Producto::select(['nombre'])->where("id", $producto['id'])->get();
            $p = $prod.";".$producto['repeticiones'];
            //$p=[$prod,$producto['repeticiones']];
            array_push($productosCategoria,$p);
        }

        return response()->json($productosCategoria);

    }
    public function getProductos()
    {
        return view("productos.productos");
    }
    public function registro()
    {
        $categoria=Categoria::all();
        return view("productos.registro-productos",compact("categoria",$categoria));
    }
    public function editap($id)
    {
        $producto=Producto::find($id);
        $categoriaproducto=CategoriaProducto::where("id_producto","=",$id)->get();
        $categoria=Categoria::all();



        return view("productos/edita-productos")->with(compact("producto",$producto))->with(compact("categoria",$categoria))->with("categoriap",$categoriaproducto);
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

        $categoriaproducto=CategoriaProducto::where("id_producto","=",$request->id)->first();

        $producto->nombre = $request -> nombre;
        $producto->venta = $request->venta;
        $producto->compra = $request->compra;
        if($request->stock<1){
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
        if($categoriaproducto==null)
        {
            $categoriaproductos= new CategoriaProducto();
            $categoriaproductos->id_producto=$producto->id;
            $categoriaproductos->id_categoria=$request->idcategoria;
            $categoriaproductos->save();
        }
        else {
            $categoriaproducto->id_producto = $request->id;
            $categoriaproducto->id_categoria = $request->idcategoria;
            $categoriaproducto->save();
        }
        return redirect("/productos");
    }



}


