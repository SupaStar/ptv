<?php

namespace App\Http\Controllers;

use App\AperturaCaja;
use App\Configuracion;
use App\Correos;
use App\Mail\AbrirCajaMail;
use App\Mail\CajaMail;
use App\Mail\CerrarCajaMail;
use App\Producto;
use App\Reparacion;
use App\Venta;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Nullable;

class PuntoVentaController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $fecha = null;
        $apertura = AperturaCaja::where("fecha_hora_cierre",null)->first();
        if($apertura){
            $fechaN = explode(" ",$apertura->created_at);
            $fecha = $fechaN[0];
        }
        return view("punto-venta.index",["apertura" => $fecha]);
    }

    public function findid(Request $request)
    {
        $id = $request->id;
        $producto = Producto::find($id);
        return response()->json($producto);
    }

    public function eliminacaja(Request $request)
    {
        $id = $request->idcaja;
        $ap = AperturaCaja::find($id);
        $ap->fecha_hora_cierre = null;
        $ap->save();
        return redirect("/");
    }

    public function cobro()
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
        return view("punto-venta.cobrar",compact('productos'));
    }

    public function buscar(Request $request)
    {
        $busqueda = $request->input("busqueda");
        $productos = Producto::where("nombre", "like", "%$busqueda%")->where("stock", ">=", 1)->where("estado", "=", "1")
            ->orWhere("id", $busqueda)->where("stock", ">=", 1)->where("estado", "=", "1")
            ->orWhere('descripcion', 'like', "%$busqueda%")->where("stock", ">=", 1)->where("estado", "=", "1")
            ->orWhere('codigo', 'like', "%$busqueda%")->where("stock", ">=", 1)->orderBy("nombre")->where("estado", "=", "1")->get();
        return response()->json($productos);
        // return view("layouts.resultado-busqueda-modal", compact("busqueda", "productos"));
    }

    public function cobrar(Request $request)
    {
        if (_c("ESTADO_CAJA") == "cerrada")
            return response()->json(["estado" => false, "mensaje" => "La caja está cerrada, debe abrirla para comenzar a vender."]);
        $productos = $request->productos;

        $verificarCierre = AperturaCaja::where("fecha_hora_cierre", null)->get()->count();
        if($verificarCierre > 1)
            return response()->json(["estado" => false, "errores" => ["Ocurrió un error, no se cerro la caja el día $verificarCierre->created_at. ¡Contacta al administrador!"]]);


        try {
            DB::beginTransaction();
            $venta = new Venta();
            $venta->total = $request->total;
            $venta->denominacion = $request->denominacion;
            $venta->cambio = $request->denominacion - $request->total;
            $venta->utilidad = 0;
            $venta->usuario_id = auth()->user()->id;
            $venta->save();
            $utilidad = 0;
            foreach ($productos as $prod) {
                $producto = Producto::find($prod["id"]);
                $utilidad += $prod["cantidad"] * ($prod["venta"] - $producto->compra);
                $venta->productos()->attach($prod["id"], [
                    "cantidad" => $prod["cantidad"],
                    "venta" => $prod["venta"],
                    "compra" => $producto->compra
                ]);
                $producto->stock -= $prod["cantidad"];
                $producto->save();
            }
            $venta->utilidad = $utilidad;
            $venta->save();
            DB::commit();

            return response()->json(["estado" => true]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('PuntoVenta:cobrar ---------- ' . $e->__toString());
            return response()->json(["estado" => false, "mensaje" => "No se pudo registrar el pago, anótelo en la libreta"]);
        }

        return response()->json($request->productos);

    }

    public function cambiarEstadoCaja()
    {
        return view("punto-venta.cambiar-estado-caja");
    }

    public function cambiarEstadoCaja_(Request $request)
    {

        try {
            $v = Validator::make($request->all(), [
                "inicial" => "required"
            ], [
                "inicial.required" => "Debe ingresar una cantidad de dinero inicial."
            ]);

            if ($v->fails())
                return response()->json(["estado" => false, "errores" => $v->errors()->all()]);

            $verificarCierre = AperturaCaja::where("fecha_hora_cierre", null)->first();
            if($verificarCierre)
                return response()->json(["estado" => false, "errores" => ["Ocurrió un error, no se cerro la caja el día $verificarCierre->created_at. ¡Contacta al administrador!"]]);

            $productos = Producto::all();
            $sigSemana = Carbon::now()->addDays(7)->format('Y-m-d');
            $productosCaducos = [];
            foreach ($productos as $producto) {
                if ($producto->fecha_caducidad < $sigSemana) {
                    array_push($productosCaducos, $producto);
                }
            }
            $apertura = new AperturaCaja();
            $apertura->monto_inicio = $request->input("inicial");
            $apertura->observaciones = $request->input("observaciones") == null ? "Ninguna" : $request->input("observaciones");
            $apertura->save();
            $conf = Configuracion::where("clave", "ESTADO_CAJA")->first();
            $conf->valor = "abierta";
            $conf->save();

            Mail::to('emmanuelupt@gmail.com')->send(new AbrirCajaMail($request->input("inicial")));
            return response()->json(["estado" => true, 'detalle' => ['productos_a_caducar' => $productosCaducos]]);
        } catch (Exception $e) {
            return response()->json(["estado" => false, "errores" => ["Ocurrió un error al querer cambiar el estado de la caja."]]);
        }
        // return view("punto-venta.abrir-caja");
    }

    public function cerrarCaja()
    {
        $apertura = AperturaCaja::where("fecha_hora_cierre", null)->first();

        if ($apertura) {

            $fecha = explode(" ",$apertura->created_at);
            $nuevaFecha = date("Y-m-d",strtotime($fecha[0]."+ 1 days"));

            $ventas = Venta::where("created_at", ">=", $apertura->created_at)
                ->where("created_at", "<=", $nuevaFecha)->where('tipo_venta',0)
                ->get();

            $ventasTarjeta = Venta::where("created_at", ">=", $apertura->created_at)
                ->where("created_at", "<=", $nuevaFecha)->where('tipo_venta',1)
                ->get();

            $ventasTotales = 0;
            $ventasTotalesTarjeta = 0;
            $utilidades = 0;
            $utilidadesTarjeta = 0;

            foreach ($ventas as $venta) {
                $ventasTotales += $venta->total;
                $utilidades += $venta->utilidad;
            }

            foreach ($ventasTarjeta as $venta) {
                $porcentajeVentaTotal = (($venta->total * 3.5) / 100);
                $ventasTotalesTarjeta += $venta->total - (($porcentajeVentaTotal * 16) / 100) - $porcentajeVentaTotal;
                $utilidadesTarjeta += $venta->utilidad - (($porcentajeVentaTotal * 16) / 100) - $porcentajeVentaTotal;
            }

            $apertura->ventas_finales = $ventasTotales;
            $apertura->ventas_finales_tarjeta = $ventasTotalesTarjeta;
            $apertura->utilidades = $utilidades;
            $apertura->utilidades_tarjeta = $utilidadesTarjeta;
            $apertura->fecha_hora_cierre = date("Y-m-d H:i:s");
            $apertura->save();

            Mail::to('emmanuelupt@gmail.com')->send(new CerrarCajaMail($ventasTotales,$ventasTotalesTarjeta,$utilidades,$utilidadesTarjeta,$apertura->fecha_hora_cierre));

            //Mail::to('mag750729@gmail.com')->send(new CerrarCajaMail($ventasTotales,$utilidades,$apertura->fecha_hora_cierre));

            session()->flash('estado', "Caja cerrada<br>
                Monto inicial: <b>$ " . number_format($apertura->monto_inicio, 2) . "</b><br>
                Total ventas: <b>$ " . number_format($ventasTotales, 2) . "</b><br>
                Total ventas con tarjeta: <b>$ " . number_format($ventasTotalesTarjeta, 2) . "</b><br>                
                Total en caja: <b>$ " . number_format(($ventasTotales + $apertura->monto_inicio), 2) . "</b>");
        }
        return redirect()->route('punto-venta');
    }

    public function cobrarp(Request $request)

    {
        $verificarCierre = AperturaCaja::where("fecha_hora_cierre", null)->get();
        if(count($verificarCierre) > 1)
            return response()->json(["estado" => false, "errores" => ["Ocurrió un error, hay dos cajas abiertas. ¡Contacta al administrador!"]]);

        if (_c("ESTADO_CAJA") == "cerrada")
            return response()->json(["estado" => false, "mensaje" => "La caja está cerrada, debe abrirla para comenzar a vender."]);
        try {
            DB::beginTransaction();
            $venta = new Venta();
            $venta->total = $request->total;
            $venta->denominacion = $request->denominacion;
            $venta->cambio = $request->denominacion - $request->total;
            $venta->utilidad = 0;
            $venta->tipo_venta = $request->tipo_venta;
            $venta->usuario_id = auth()->user()->id;
            $venta->save();
            $utilidad = 0;
            $productos = $request->producto;
            foreach ($productos as $prod) {
                $producto = Producto::find($prod[0]);
                $producto->stock -= $prod[4];
                $utilidad += $prod[4] * ($prod[3] - $producto->compra);
                $venta->productos()->attach($prod[0], [
                    "cantidad" => $prod[4],
                    "venta" => $prod[3],
                    "compra" => $producto->compra
                ]);
                $producto->save();
            }
            $venta->utilidad = $utilidad;
            $venta->save();
            DB::commit();
            return json_encode($productos);
            return response()->json(["estado" => true]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('PuntoVenta:cobrar ---------- ' . $e->__toString());
            return response()->json(["estado" => false, "mensaje" => "No se pudo registrar el pago, anótelo en la libreta"]);
        }

        return response()->json($request->productos);
    }

    public function perfil()
    {
        return view("punto-venta.user-profile");
    }


    public function corte()
    {
        $apertura = AperturaCaja::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->get();

        return view("punto-venta.corte", compact("apertura", $apertura));
    }


    public function getCorte()
    {
        $apertura = AperturaCaja::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->get();
        return response()->json($apertura);
    }

    public function ventasSemanales()
    {
        return view("punto-venta.ventas-semanal");
    }

}


