<?php

namespace App\Http\Controllers;

use App\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta = Venta::find($id);
        $produ = [];
        foreach($venta->productos as $p){
            array_push($produ, [
                "nombre" => $p->nombre,
                "venta" => $p->pivot->venta,
                "cantidad" => $p->pivot->cantidad,
            ]);
        }
        return response()->json(["productos" =>$produ, "total" =>$venta->total]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getVentashoy()
    {
       $ventas=Venta::whereDate("created_at","=",Carbon::now()->format('Y-m-d'))->get();

        return response()->json($ventas);
    }
    public function getVentassemana()
    {
       $ventas=Venta::whereDate("created_at",">=",Carbon::now()->subDays(7))->get();
        return response()->json($ventas);
    }
    public function ventasproducto()
    {
        $ventas=Venta::whereDate("created_at","=",Carbon::now()->format('Y-m-d'))->get();

        return response()->json($ventas);
    }

}
