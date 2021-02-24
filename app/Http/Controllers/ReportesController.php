<?php

namespace App\Http\Controllers;

use App\AperturaCaja;
use App\Venta;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function ventas()
    {
        return view("reportes.ventas");
    }
    public function ventasTiempo()
    {
        return view("reportes.ventas-tiempo");
    }
    public function buscarPorSemana(Request $request)
    {
        $ventas = Venta::where("created_at", ">=", $request->startDate . " 00:00:00")
            ->where("created_at", "<=", $request->endDate . " 23:59:59")
            ->orderBy("created_at", "desc")
            ->with("productos")
            ->get();
        return response()->json($ventas);
    }
    public function buscarPorMes(Request $request)
    {
        $ventas = AperturaCaja::where("fecha_hora_cierre", ">=", $request->startDate . " 00:00:00")
            ->where("fecha_hora_cierre", "<=", $request->endDate . " 23:59:59")
            ->orderBy("created_at", "desc")
            ->get();
        return response()->json($ventas);
    }
}
