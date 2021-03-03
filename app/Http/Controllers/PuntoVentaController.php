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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PuntoVentaController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware(["isAdmin"])->except(["index", "buscar", "cobrar"]);
    }

    public function index()
    {
        return view("punto-venta.index1");
    }
    public function index1()
    {
        return view("punto-venta.index");
    }

    public function buscar(Request $request)
    {
        $busqueda = $request->input("busqueda");
        $productos = Producto::where("nombre", "like", "%$busqueda%")
            ->orWhere("id", $busqueda)
            ->orWhere('descripcion', 'like', "%$busqueda%")
            ->orWhere('codigo', 'like', "%$busqueda%")->orderBy("nombre")->get();
        return view("layouts.resultado-busqueda-modal", compact("busqueda", "productos"));
    }

    public function cobrar(Request $request)
    {
        if (_c("ESTADO_CAJA") == "cerrada")
            return response()->json(["estado" => false, "mensaje" => "La caja está cerrada, debe abrirla para comenzar a vender."]);
        $productos = $request->productos;

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
            //Mail::to('obednoe22yt@gmail.com')->send(new AbrirCajaMail($request->input("inicial"),$apertura->observaciones));
            return response()->json(["estado" => true, 'detalle' => ['productos_a_caducar'=>$productosCaducos]]);
        } catch (Exception $e) {
            return response()->json(["estado" => true, "errores" => ["Ocurrió un error al querer cambiar el estado de la caja."]]);
        }
        // return view("punto-venta.abrir-caja");
    }

    public function cerrarCaja()
    {

        $apertura = AperturaCaja::where("fecha_hora_cierre", null)->first();
        if ($apertura) {
            $ventas = Venta::where("created_at", ">=", $apertura->created_at)
                ->where("created_at", "<=", date("Y-m-d H:i:s"))
                ->get();
            $reparaciones = Reparacion::where("fecha_entrega", ">=", $apertura->created_at->format("Y-m-d"))
                ->where("estado", "Entregado")
                ->get();
            $ventasTotales = 0;
            $utilidades = 0;
            foreach ($ventas as $venta) {
                $ventasTotales += $venta->total;
                $utilidades += $venta->utilidad;
            }
            $reparacionesTotal = 0;
            foreach ($reparaciones as $reparacion) {
                $reparacionesTotal += $reparacion->costo == -1 ? 0 : $reparacion->costo;
                $reparacion->estado = "Reportado";
                $reparacion->save();
            }
            $apertura->ventas_finales = $ventasTotales;
            $apertura->utilidades = $utilidades;
            $apertura->reparaciones_finales = $reparacionesTotal;
            $apertura->fecha_hora_cierre = date("Y-m-d H:i:s");
            $apertura->save();
            $conf = Configuracion::where("clave", "ESTADO_CAJA")->first();
            $conf->valor = "cerrada";
            //Mail::to('obednoe22yt@gmail.com')->send(new CerrarCajaMail($ventasTotales,$utilidades,$reparacionesTotal,$apertura->fecha_hora_cierre));
            $conf->save();
            session()->flash('estado', "Caja cerrada<br>
                Monto inicial: <b>$ " . number_format($apertura->monto_inicio, 2) . "</b><br>
                Total ventas: <b>$ " . number_format($ventasTotales, 2) . "</b><br>
                Total reparaciones: <b>$ " . number_format($reparacionesTotal, 2) . "</b><br>
                Total en caja: <b>$ " . number_format(($ventasTotales + $reparacionesTotal + $apertura->monto_inicio), 2) . "</b>");
        }
        return redirect()->route("punto-venta");
    }
}
