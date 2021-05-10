<?php

namespace App\Http\Controllers;

use App\ConfiguracionGeneral;
use App\ConfiguracionStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ConfiguracionGeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function configuraciones (){
        $configuraciones = ConfiguracionGeneral::all();
        return view("configuracion-general.configuracion-general",["configuraciones" => $configuraciones]);
    }
    public function agregaCorreo(Request $datos){

        $rules = [
            'correo' => 'required',
            'estado' => 'required'
        ];
        $messages = [
            'required' => 'El atributo :attribute es requerido.',
        ];
        $validator = Validator::make($datos->all(),$rules,$messages);
        if ($validator->fails()) {
            return redirect()->route('configuracionesGenerales')
                ->withErrors($validator)
                ->withInput();
        }
        DB::beginTransaction();
        try {
            $conf = new ConfiguracionGeneral();
            $conf->correo = $datos->correo;
            $conf->estado = $datos->estado;
            $conf->save();
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
            //echo json_encode($e);
            return redirect()->route('configuracionesGenerales')
                ->withErrors(["errorRegistro" => "Error al guardar la información, intenta de nuevo"])
                ->withInput();
        }
        Session::flash('success', 'ok');
        return redirect()->route('configuracionesGenerales');
    }
    public function editaCorreo (Request $datos){
        $rules = [
            'correoEditar' => 'required',
            'estadoEditar' => 'required'
        ];
        $messages = [
            'required' => 'El atributo :attribute es requerido.',
        ];
        $validator = Validator::make($datos->all(),$rules,$messages);
        if ($validator->fails()) {
            return redirect()->route('configuracionesGenerales')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            $info = ConfiguracionGeneral::find($datos->correoId);
            $info->correo = $datos->correoEditar;
            $info->estado = $datos->estadoEditar;
            $info->save();
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
            return redirect()->route('configuracionesGenerales')
                ->withErrors(["errorRegistro" => "Error al editar la información"])
                ->withInput();
        }
        Session::flash('success', 'ok');
        return redirect()->route('configuracionesGenerales');
    }
    public function infoCorreo ($id){
        DB::beginTransaction();
        try {
            $info = ConfiguracionGeneral::find($id);
            if($info)
                return json_encode(["estatus" => "ok", "informacion" => $info]);
            else
                return json_encode(["estatus" => "error", "informacion" => ""]);
        }catch (\Exception $e){
            DB::rollback();
            //echo json_encode($e);
            return redirect()->route('configuracionesGenerales')
                ->withErrors(["errorRegistro" => "Error al mostrar la información"])
                ->withInput();
        }
    }
    public function eliminaCorreo ($id){

        DB::beginTransaction();
        try {
            $info = ConfiguracionGeneral::find($id);
            if($info){
                $info->delete();
                DB::commit();
                return json_encode(["estatus" => "ok", "informacion" => ""]);
            }
            else
                return json_encode(["estatus" => "error", "informacion" => ""]);
        }catch (\Exception $e){
            DB::rollback();
            //echo json_encode($e);
            return redirect()->route('configuracionesGenerales')
                ->withErrors(["errorRegistro" => "No se pudo eliminar la información!"])
                ->withInput();
        }
    }
    public function estado ($id){
        DB::beginTransaction();
        try {
            $info = ConfiguracionGeneral::find($id);
            if($info){
                if($info->estado == 1){
                    $info->estado = 0;
                    $info -> save();
                }
                else{
                    if($info->estado == 0){
                        $info->estado = 1;
                        $info -> save();
                    }
                }
                DB::commit();
                return json_encode(["estatus" => "ok", "informacion" => ""]);
            }
            else
                return json_encode(["estatus" => "error", "informacion" => ""]);
        }catch (\Exception $e){
            DB::rollback();
            return redirect()->route('configuracionesGenerales')
                ->withErrors(["errorRegistro" => "No se pudo editar el estado!"])
                ->withInput();
        }
    }

    public function configuracionesStock (){
        $configuracionStock = ConfiguracionStock::first();
        //echo $configuracionStock;
        if($configuracionStock == null){
            return view("configuracion-general.configuracion-stock", ["estatus"=>"no"]);
        }
        return view("configuracion-general.configuracion-stock", ["estatus"=>"ok", "stockCaducidad" => $configuracionStock]);

    }
    public function agregarStock (Request $datos){
        $rules = [
            'nProductos' => 'required',
            'diasAviso' => 'required'
        ];
        $messages = [
            'required' => 'El atributo :attribute es requerido.',
        ];
        $validator = Validator::make($datos->all(),$rules,$messages);
        if ($validator->fails()) {
            return redirect()->route('configuracionesStock')
                ->withErrors($validator)
                ->withInput();
        }
        DB::beginTransaction();
        try {
            $conf = new ConfiguracionStock();
            $conf->stock = $datos->nProductos;
            $conf->fecha_caducidad = $datos->diasAviso;
            $conf->save();
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
            //echo json_encode($e);
            return redirect()->route('configuracionesStock')
                ->withErrors(["errorRegistro" => "Error al guardar la información, intenta de nuevo"])
                ->withInput();
        }
        Session::flash('success', 'ok');
        return redirect()->route('configuracionesStock');
    }
    public function infoStock ($id){
        DB::beginTransaction();
        try {
            $info = ConfiguracionStock::find($id);
            if($info)
                return json_encode(["estatus" => "ok", "informacion" => $info]);
            else
                return json_encode(["estatus" => "error", "informacion" => ""]);
        }catch (\Exception $e){
            DB::rollback();
            //echo json_encode($e);
            return redirect()->route('configuracionesGenerales')
                ->withErrors(["errorRegistro" => "Error al mostrar la información"])
                ->withInput();
        }
    }
    public function editaStock (Request $datos){
        $rules = [
            'productosTerminar' => 'required',
        ];
        $messages = [
            'required' => 'El atributo :attribute es requerido.',
        ];
        $validator = Validator::make($datos->all(),$rules,$messages);
        if ($validator->fails()) {
            return redirect()->route('configuracionesStock')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            $info = ConfiguracionStock::find($datos->stockId);
            $info->stock = $datos->productosTerminar;
            $info->save();
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
            return redirect()->route('configuracionesStock')
                ->withErrors(["errorRegistro" => "Error al editar la información"])
                ->withInput();
        }
        Session::flash('success', 'ok');
        return redirect()->route('configuracionesStock');
    }
    public function editaCaducidad (Request $datos){
        $rules = [
            'diasAviso' => 'required',
        ];
        $messages = [
            'required' => 'El atributo :attribute es requerido.',
        ];
        $validator = Validator::make($datos->all(),$rules,$messages);
        if ($validator->fails()) {
            return redirect()->route('configuracionesStock')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            $info = ConfiguracionStock::find($datos->caducidadId);
            $info->fecha_caducidad = $datos->diasAviso;
            $info->save();
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
            return redirect()->route('configuracionesStock')
                ->withErrors(["errorRegistro" => "Error al editar la información"])
                ->withInput();
        }
        Session::flash('success', 'ok');
        return redirect()->route('configuracionesStock');
    }


}

