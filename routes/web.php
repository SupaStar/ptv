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
Route::get("productos-prueba", "ProductosController@productosMasVendidos");
Route::post("productos-registro", "ProductosController@create")->name("productos-registro");
Route::post("categorias-registro", "CategoriasController@create")->name("categorias-registro");
Route::get("/registro", "PerfilController@registro")->name("registro");
Route::get("/", "PuntoVentaController@index")->name("punto-venta");
Route::get("/getCorte", "PuntoVentaController@getCorte")->name("getCorte");
Route::get("/ventasSemanales", "PuntoVentaController@ventasSemanales")->name("ventasSemanales");
Route::get("/categorias", "CategoriaController@categoria")->name("categoria");
Route::get("/getcategorias", "CategoriaController@getCategorias");
Route::get("/registroCategoria", "CategoriaController@registroCategoria")->name("registroCategoria");
Route::post("/nuevaCategoria", "CategoriaController@nuevo");
Route::get("/getVentashoy", "VentasController@getVentashoy")->name("getVentashoy");
Route::get("/ventashoy", "VentasController@ventashoy");
Route::get("/getVentassemana", "VentasController@getVentassemana")->name("getVentassemana");
Route::get("/productos", "ProductosController@getProductos")->name("productos");
Route::get("/registrarproducto", "ProductosController@registro")->name("registro");
Route::get("/usuarios", "PerfilController@usuarios")->name("usuarios");
Route::get("/getusuarios", "PerfilController@getUsuarios")->name("Obtener usuarios");
Route::get("/agregarusuario", "PerfilController@agregarusuarios")->name("Agregar usuario");
Route::get("/getPerfil", "PerfilController@getPerfil")->name("perfil");
Route::get("/masvendidos", "ProductosController@productosMasVendidos");
Route::post("/eliminacaja", "PuntoVentaController@eliminacaja");

Route::get("/perfil", "PerfilController@perfil")->name("perfil");
Route::post("actualizarperfil", "PerfilController@updatePerfil")->name("Actualizar Perfil");
Route::get("/corte", "PuntoVentaController@corte")->name("corte");
Route::get("/cobrar", "PuntoVentaController@cobro")->name("Cobrar");
Route::get("/cambiar-estado-caja", "PuntoVentaController@cambiarEstadoCaja")->name("cambiar-estado-caja");
Route::post("/cambiar-estado-cajas", "PuntoVentaController@cambiarEstadoCaja_")->name("do-cambiar-estado-caja");
Route::get("/cerrar-caja", "PuntoVentaController@cerrarCaja")->name("cerrar-caja");
Route::get("surtimiento", "SurtimientoController@index")->name("surtimiento");
Route::get("/ventaproductos", "VentasController@ventasproducto")->name("surtimiento");
Route::post("surtimiento-procesar", "SurtimientoController@procesar")->name("surtimiento-procesar");
Route::post("surtimiento-guardar", "SurtimientoController@guardar")->name("surtimiento-guardar");

Route::get('productos-pendientes', 'ProductosController@pendientes')->name("productos.pendientes");
Route::put('productos-editar-precio', 'ProductosController@editarPrecio')->name("productos.editar-precio");
Route::put('productos-editar-nombre', 'ProductosController@editarNombre')->name("productos.editar-nombre");
Route::put('productos-editar-stock', 'ProductosController@editarStock')->name("productos.editar-stock");

Route::post("cobrar", "PuntoVentaController@cobrar")->name("cobrar");
Route::post('/findid', 'PuntoVentaController@findid');
Route::post('/findproductoid', 'ProductosController@findp');
Route::post('/findusuarioid', 'PerfilController@findu');
Route::post('/findcatid', 'CategoriaController@findc');
Route::post('/desactivarproducto', 'ProductosController@desactivap');
Route::post('/desactivarusuario', 'PerfilController@desactivau');
Route::post('/desactivarcategoria', 'CategoriaController@desactivac');

Route::post('actualizarproducto', 'ProductosController@actualizarproducto');
Route::post('registrarproducto', 'ProductosController@store');
Route::post('actualizarcategoria', 'CategoriaController@actualizarcategoria');
Route::post('actualizarusuario', 'PerfilController@actualizarusuario');

Route::post('cobrarp/', 'PuntoVentaController@cobrarp');
Route::post('registrarusuario', 'PerfilController@registrarusuario');
Route::get('/obtenerproductos', 'ProductosController@productos');
Route::get('/obtenercategoria', 'CategoriaController@encontrar');
Route::get('/editarproducto/{id}', 'ProductosController@editap');
Route::get('/editarcategoria/{id}', 'CategoriaController@editap');
Route::get('/editarusuario/{id}', 'PerfilController@editap');
Route::get('/obtenerventas', 'VentasController@getVentashoy');
Route::get('/obtenerventasApertura', 'VentasController@getVentasApertura');
Route::get('/detallesVenta/{id}', 'VentasController@detallesVenta')->name('buscar.venta.id');

Route::resource('reparaciones', 'ReparacionesController')->except("show");
Route::get("reparaciones/{id?}", "ReparacionesController@show")->name("reparaciones.show");
Route::get("reparaciones/abonar/{id?}", "ReparacionesController@abonar")->name("reparaciones.abonar");
Route::get("reparaciones/entregar/{id?}", "ReparacionesController@entregar")->name("reparaciones.entregar");
Route::post("reparaciones/realizar-abono/{id?}", "ReparacionesController@realizarAbono")->name("reparaciones.realizarAbono");

Route::get('ventas-hoy', "ReportesController@ventas")->name("ventas.reporte");
Route::get('ventasgeneral', "VentasController@ventasgeneral");
Route::get('ventasgenerales', "VentasController@ventasgenerales");
Route::get('ventassemana', "VentasController@ventassemana");
Route::post('ventasfecha', "VentasController@fechaventas");
Route::get('ventas-historico', "ReportesController@ventasTiempo")->name("ventas-history.reporte");
Route::get('ventas/{id?}', "VentasController@show")->name("ventas.show");
Route::post('ventas-reportar', "ReportesController@buscarPorSemana")->name("ventas.reportar");
Route::post('ventas-tiempo-reportar', "ReportesController@buscarPorMes")->name("ventas-tiempo.reportar");
Route::get('/logout',function (){
   \Illuminate\Support\Facades\Auth::logout();
   return redirect()->route('punto-venta');
});

// -- Devoluciones
Route::get("/devolucion", "VentasController@devolucion")->name("devolucion");
Route::get("/devolucion/{id}", "VentasController@crearDevolucion")->name("crear.devolucion");
Route::post("/agregar-producto-devolucion", "VentasController@agregarProductoDevolucion")->name("agregar.producto.devolucion");

// -- Notas
Route::get('prueba/', "NotaController@prueba")->name("notas.prueba");
Route::get('productosmalos/', "NotaController@productosErroneos")->name("notas.malas");
Route::get('misnotas/', "NotaController@notas")->name("notas.mostrar");
Route::get('misnotas/detalles/{id?}', "NotaController@informacion")->name("notas.informacion");
Route::get('misnotas/eliminar/{id?}', "NotaController@eliminar")->name("notas.informacion");
Route::post('agregar-nota', "NotaController@agregar")->name("notas.agregar");
Route::post('editar-nota', "NotaController@editar")->name("notas.editar");


// Modales
Route::post("/buscar", "PuntoVentaController@buscar")->name("buscar");

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

//Ruta para Modal de Detalles