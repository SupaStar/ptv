<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\AperturaCaja;
use App\Configuracion;
use App\Reparacion;
use App\Venta;
if (env('APP_FORCE_HTTPS', false)) {
    URL::forceScheme('https');
}
Route::get("/", "PuntoVentaController@index")->name("punto-venta");
Route::get("/getCorte", "PuntoVentaController@getCorte")->name("getCorte");
Route::get("/getVentashoy", "VentasController@getVentashoy")->name("getVentashoy");
Route::get("/getVentassemana", "VentasController@getVentassemana")->name("getVentassemana");
Route::get("/productos", "ProductosController@getProductos")->name("productos");
Route::get("/getPerfil", "PerfilController@getPerfil")->name("perfil");
Route::get("/registro", "ProductosController@registro")->name("registro");
Route::get("/perfil", "PerfilController@perfil")->name("perfil");
Route::get("/corte", "PuntoVentaController@corte")->name("corte");
Route::get("/cobrar", "PuntoVentaController@cobro")->name("Cobrar");
Route::get("/cambiar-estado-caja", "PuntoVentaController@cambiarEstadoCaja")->name("cambiar-estado-caja");
Route::post("/cambiar-estado-cajas", "PuntoVentaController@cambiarEstadoCaja_")->name("do-cambiar-estado-caja");
Route::get("/cerrar-caja", "PuntoVentaController@cerrarCaja")->name("cerrar-caja");
Route::get("surtimiento", "SurtimientoController@index")->name("surtimiento");
Route::post("surtimiento-procesar", "SurtimientoController@procesar")->name("surtimiento-procesar");
Route::post("surtimiento-guardar", "SurtimientoController@guardar")->name("surtimiento-guardar");

Route::get('productos-pendientes', 'ProductosController@pendientes')->name("productos.pendientes");
Route::put('productos-editar-precio', 'ProductosController@editarPrecio')->name("productos.editar-precio");
Route::put('productos-editar-nombre', 'ProductosController@editarNombre')->name("productos.editar-nombre");
Route::put('productos-editar-stock', 'ProductosController@editarStock')->name("productos.editar-stock");
Route::post("cobrar", "PuntoVentaController@cobrar")->name("cobrar");
Route::post('findid/', 'PuntoVentaController@findid');
Route::post('cobrarp/', 'PuntoVentaController@cobrarp');
Route::get('/obtenerproductos', 'ProductosController@productos');

Route::resource('reparaciones', 'ReparacionesController')->except("show");
Route::get("reparaciones/{id?}", "ReparacionesController@show")->name("reparaciones.show");
Route::get("reparaciones/abonar/{id?}", "ReparacionesController@abonar")->name("reparaciones.abonar");
Route::get("reparaciones/entregar/{id?}", "ReparacionesController@entregar")->name("reparaciones.entregar");
Route::post("reparaciones/realizar-abono/{id?}", "ReparacionesController@realizarAbono")->name("reparaciones.realizarAbono");

Route::get('ventas-hoy', "ReportesController@ventas")->name("ventas.reporte");
Route::get('ventas-historico', "ReportesController@ventasTiempo")->name("ventas-history.reporte");
Route::get('ventas/{id?}', "VentasController@show")->name("ventas.show");
Route::post('ventas-reportar', "ReportesController@buscarPorSemana")->name("ventas.reportar");
Route::post('ventas-tiempo-reportar', "ReportesController@buscarPorMes")->name("ventas-tiempo.reportar");

// Modales
Route::post("buscar", "PuntoVentaController@buscar")->name("buscar");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get("t", function () {

    return;
    $primerCierre = AperturaCaja::min("created_at");
    $primerVenta = Venta::min("created_at");
    if ($primerCierre == null)
        $primerCierre = date("Y-m-d H:i:s");

    $realDates = range(strtotime($primerVenta), strtotime($primerCierre), 86400);
    $dates = array_map(function ($x) {
        return date('Y-m-d', $x);
    }, $realDates);
    $r = [];
    foreach ($dates as $date) {
        $apertura = new AperturaCaja();

        $ventas = Venta::where("created_at", ">=", $date . " 00:00:00")
            ->where("created_at", "<=", $date . " 23:59:59")
            ->get();
        $reparaciones = Reparacion::where("fecha_entrega", "=", $date)
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
            $reparacionesTotal += ($reparacion->costo == "-1" ? 0 : $reparacion->costo);
            $reparacion->estado = "Reportado";
            $reparacion->save();
        }
        $apertura->monto_inicio = 0;
        $apertura->ventas_finales = $ventasTotales;
        $apertura->utilidades = $utilidades;
        $apertura->reparaciones_finales = $reparacionesTotal;
        $apertura->fecha_hora_cierre = $date . " 23:59:59";
        $apertura->save();
        // array_push($r, $apertura);
    }
    // return response()->json($r);
});
