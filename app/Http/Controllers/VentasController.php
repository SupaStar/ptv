<?php

namespace App\Http\Controllers;

use App\AperturaCaja;
use App\CategoriaProducto;
use App\Perfil;
use App\Producto;
use App\User;
use App\Venta;
use App\VentaProducto;
use Carbon\Carbon;
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
            $venta->usuario = User::find($venta->usuario_id)->first();
            return json_encode(["estatus" => "succes", "venta" => $venta]);
        }else{
            return json_encode(["estatus" => "error", "venta" => "No hay información"]);
        }
    }

}
