<?php

namespace App\Http\Controllers;

use App\AperturaCaja;
use App\CategoriaProducto;
use App\Perfil;
use App\Producto;
use App\User;
use App\Venta;
use App\Venta_Producto;
use App\VentaProducto;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta = Venta::find($id);
        $produ = [];
        foreach ($venta->productos as $p) {
            array_push($produ, [
                "nombre" => $p->nombre,
                "venta" => $p->pivot->venta,
                "cantidad" => $p->pivot->cantidad,
            ]);
        }
        return response()->json(["productos" => $produ, "total" => $venta->total]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

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
        //
    }

    public function getVentasApertura()
    {
        $apertura = AperturaCaja::where("fecha_hora_cierre", null)->first();
        $fecha = explode(" ",$apertura->created_at);
        $nuevaFecha = date("Y-m-d",strtotime($fecha[0]."+ 1 days"));

        $ventas = Venta::whereDate("created_at", "=",$fecha[0])->get();
        foreach ($ventas as $venta) {
            $venta->productos;
            $venta->tipo_venta=$venta->tipo_venta==0?"Efectivo":"Pago con tarjeta";
            $usuario = User::all()->where('id', '=', $venta->usuario_id);
            foreach ($usuario as $us) {
                $venta->usuario = $us->name;
            }
        }

        return response()->json($ventas);
    }

    public function getVentashoy()
    {
        $ventas = Venta::whereDate("created_at", "=", Carbon::now()->format('Y-m-d'))->get();
        foreach ($ventas as $venta) {
            $venta->productos;
            $venta->tipo_venta=$venta->tipo_venta==0?"Efectivo":"Pago con tarjeta";
            $usuario = User::all()->where('id', '=', $venta->usuario_id);
            foreach ($usuario as $us) {
                $venta->usuario = $us->name;
            }
        }

        return response()->json($ventas);
    }

    public function getVentassemana()
    {
        $ventas = Venta::whereDate("created_at", ">=", Carbon::now()->subDays(7))->get();
        foreach ($ventas as $venta) {
            $venta->cp = DB::table('ventas_productos')->where('venta_id', '=', $venta->id)->get();
            $venta->usuarios = Perfil::find($venta->usuario_id);
            foreach ($venta->cp as $cp) {
                $cp->producto = Producto::find($cp->producto_id);
            }
        }
        return response()->json($ventas);
    }

    public function ventasproducto()
    {
        $ventas = Venta::whereDate("created_at", "=", Carbon::now()->format('Y-m-d'))->get();

        return response()->json($ventas);
    }

    public function ventashoy()
    {
        return view("Ventas/ventas-hoy");
    }

    public function ventassemana()
    {

        return view("/Ventas/ventas-semana");
    }

    public function ventasmes()
    {
        $ventas = Venta::whereDate("created_at", "=", Carbon::now()->format('Y-m-d'))->get();

        return response()->json($ventas);
    }

    public function ventasgeneral()
    {
        return view("/Ventas/ventas-general");
    }

    public function ventasgenerales()
    {
        $ventas = Venta::whereDate("created_at", "<=", Carbon::now()->format('Y-m-d'))->get();
        foreach ($ventas as $venta) {
            $venta->cp = DB::table('ventas_productos')->where('venta_id', '=', $venta->id)->get();
            $venta->usuarios = Perfil::find($venta->usuario_id);
            $venta->tipo_venta=$venta->tipo_venta==0?"Efectivo":"Pago con tarjeta";
            foreach ($venta->cp as $cp) {
                $cp->producto = Producto::find($cp->producto_id);
            }
        }

        return response()->json($ventas);
    }

    public function fechaventas(Request $request)
    {
        $ventas = Venta::whereDate("created_at", "<=", $request->final)->whereDate("created_at", ">=", $request->inicio)->get();
        foreach ($ventas as $venta) {
            $venta->usuarios = Perfil::find($venta->usuario_id);
        }

        return response()->json($ventas);
    }

    public function detallesVenta($idVenta){
        $venta = Venta::find($idVenta);
        if($venta){
            $venta->productos;
            $venta->usuario = User::find($venta->usuario_id);
            $venta->tipo_venta=$venta->tipo_venta==0?"Efectivo":"Pago con tarjeta";
            return json_encode(["estatus" => "succes", "venta" => $venta]);
        }else{
            return json_encode(["estatus" => "error", "venta" => "No hay información"]);
        }
    }

    public function devolucion(){

        $ventas = Venta::whereDate("created_at", "=", Carbon::now()->format('Y-m-d'))->get();
        foreach ($ventas as $venta) {
            $venta->productos;
            $venta->tipo_venta=$venta->tipo_venta==0?"Efectivo":"Pago con tarjeta";
        }
        return view("ventas/devolucion",["ventas" => $ventas]);

    }

    public function crearDevolucion($id){
        $venta = Venta::find($id);
        if(!$venta)
            return redirect()->route('devolucion');

        $venta->tipo_venta=$venta->tipo_venta==0?"Efectivo":"Pago con tarjeta";
        $venta->productos();
        $venta->usuario;

       return view("ventas/devoluciones",['venta' => $venta]);
    }

    public function agregarProductoDevolucion(Request $datos){
        if(!$datos->codigo || !$datos->ventaId)
            return response()->json(["estatus" => "error", "mensaje" => "Información incompleta"]);

        $producto = Producto::where('codigo',$datos->codigo)->first();
        if(!$producto)
            return response()->json(["estatus" => "error", "mensaje" => "No se encontró el producto"]);

        $venta = Venta::find($datos->ventaId);
        if(!$venta)
            return response()->json(["estatus" => "error", "mensaje" => "No se encontró la venta"]);

        if(isset($datos->cantidad)){
            if($datos->cantidad <= 0 || $datos->cantidad == '' || $datos->cantidad == null)
            return response()->json(["estatus" => "error", "mensaje" => "No se encontró la venta"]);

            if($producto->stock < $datos->cantidad)
                return response()->json(["estatus" => "error", "mensaje" => "No se cuenta con esa cantidad de productos en stock"]);
        }

        $ventaProducto = Venta_Producto::where('venta_id',$venta->id)->where('producto_id',$producto->id)->first();
        $informacionVenta = [];
        try {
            if($ventaProducto){
                DB::beginTransaction();
                $ventaProducto->compra = $producto->compra;
                $ventaProducto->venta = $producto->venta;
                if(isset($datos->cantidad))
                    $ventaProducto->cantidad = $datos->cantidad;
                else
                    $ventaProducto->cantidad = $ventaProducto->cantidad + 1;
                $ventaProducto->save();

                $informacionVenta["producto"] = $producto;
                $informacionVenta["precioVenta"] = $producto->venta;
                $informacionVenta["cantidad"] = $ventaProducto->cantidad;
                $informacionVenta["subtotal"] = $ventaProducto->cantidad * $ventaProducto->venta;
                $informacionVenta["tipo"] = "modificacion";

                DB::commit();
                return response()->json(["estatus" => "ok", "mensaje" => "Se actualizó la cantidad correctamente", "detalles" => $informacionVenta]);
            }
        }catch (\Exception $e){
            DB::rollback();
            return response()->json(["estatus" => "error", "mensaje" => "Ocurrio un error inesperado consulta al desarrolador"]);
        }
        try {
            if(!$ventaProducto){
                DB::beginTransaction();
                $ventaProducto = new Venta_Producto();
                $ventaProducto->venta_id = $venta->id;
                $ventaProducto->producto_id = $producto->id;
                $ventaProducto->compra = $producto->compra;
                $ventaProducto->venta = $producto->venta;
                $ventaProducto->cantidad = 1;
                $ventaProducto->save();
                DB::commit();

                $informacionVenta["producto"] = $producto;
                $informacionVenta["precioVenta"] = $producto->venta;
                $informacionVenta["cantidad"] = $ventaProducto->cantidad;
                $informacionVenta["subtotal"] = $ventaProducto->cantidad * $ventaProducto->venta;
                $informacionVenta["tipo"] = "agregado";

                return response()->json(["estatus" => "ok", "mensaje" => "Se agregó corectamente el producto", "detalles" => $informacionVenta]);
            }
        }catch (\Exception $e){
            DB::rollback();
            return response()->json(["estatus" => "error", "mensaje" => "Ocurrio un error inesperado consulta al desarrolador"]);
        }
    }

    public function eliminarProductoDevolucion(Request $datos){

        if(!$datos->productoId)
            return response()->json(["estatus" => "error", "mensaje" => "Ocurrio un error, no se pasó el parametro producto"]);

        if(!$datos->ventaId)
            return response()->json(["estatus" => "error", "mensaje" => "Ocurrio un error, no se pasó el parametro venta"]);

        $producto = Producto::find($datos->productoId);
        if(!$producto)
            return response()->json(["estatus" => "error", "mensaje" => "Ocurrio un error, no se encontró el producto"]);

        $venta = Venta::find($datos->ventaId);
        if(!$venta)
            return response()->json(["estatus" => "error", "mensaje" => "Ocurrio un error, no se encontró la venta"]);

        $ventaProducto = Venta_Producto::where('venta_id',$venta->id)->where('producto_id',$producto->id)->first();
        if(!$ventaProducto)
            return response()->json(["estatus" => "error", "mensaje" => "Ocurrio un error, no es posible encontrar el producto en la venta"]);

        try {
            DB::beginTransaction();
            $ventaProducto->delete();
            $producto->stock = $producto->stock + $ventaProducto->cantidad;
            $producto->save();
            DB::commit();
            return response()->json(["estatus" => "ok", "mensaje" => "Se elimino correctamente el producto"]);
        }catch (\Exception $e){
            DB::rollback();
            return response()->json(["estatus" => "error", "mensaje" => "Ocurrio un error inesperado consulta al desarrolador"]);
        }

    }
}
