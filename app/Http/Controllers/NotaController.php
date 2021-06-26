<?php

namespace App\Http\Controllers;

use App\Nota;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class NotaController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }


    public function notas (){
        $notas = Nota::all();
        return view("notas.notas",["notas" => $notas]);
    }

    public function agregar (Request $datos){

        $rules = [
            'titulo_nota' => 'required',
            'descripcion_nota' => 'required',
            'prioridad_nota' => 'required'
        ];
        $messages = [
            'required' => 'El atributo :attribute es requerido.',
        ];
        $validator = Validator::make($datos->all(),$rules,$messages);
        if ($validator->fails()) {
            return redirect()->route('notas.mostrar')
                ->withErrors($validator)
                ->withInput();
        }
        DB::beginTransaction();
        try {
            $nota = new Nota();
            $nota->usuario_id = auth()->user()->id;
            $nota->titulo = $datos->titulo_nota;
            $nota->descripcion = $datos->descripcion_nota;
            $nota->estado = 1;
            $nota->prioridad = $datos->prioridad_nota;
            $nota->save();
            if($datos->hasFile('archivo_nota')){
                $archivo = $datos->file('archivo_nota');
                $extencionArchivo = $archivo->guessExtension();
                if(!file_exists('notas')){
                    mkdir('notas');
                }
                $nombreArchivo = $nota->id.".".$extencionArchivo;
                $ruta = public_path('notas/'.$nombreArchivo);
                copy($archivo,$ruta);
                $nota->archivo = 'notas/'.$nombreArchivo;
                $nota->save();
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
            //echo json_encode($e);
            return redirect()->route('notas.mostrar')
                ->withErrors(["errorRegistro" => "No es posible registrar la nota por ¡favor contacta al desarrollador!"])
                ->withInput();
        }
        Session::flash('success', 'ok');
        return redirect()->route('notas.mostrar');

    }

    public function editar (Request $datos){
        $rules = [
            'titulo_editar_nota' => 'required',
            'descripcion_editar_nota' => 'required',
            'estado_editar_nota' => 'required',
            'prioridad_editar_nota' => 'required',
        ];
        $messages = [
            'required' => 'El atributo :attribute es requerido.',
        ];
        $validator = Validator::make($datos->all(),$rules,$messages);
        if ($validator->fails()) {
            return redirect()->route('notas.mostrar')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            $nota = Nota::find($datos->id_editar_nota);
            $nota->usuario_id = auth()->user()->id;
            $nota->titulo = $datos->titulo_editar_nota;
            $nota->descripcion = $datos->descripcion_editar_nota;
            $nota->estado = $datos->estado_editar_nota;
            $nota->prioridad = $datos->prioridad_editar_nota;
            $nota->save();
            if($datos->hasFile('archivo_editar_nota')){
                if(file_exists($nota->archivo)){
                    unlink($nota->archivo);
                }
                $archivo = $datos->file('archivo_editar_nota');
                $extencionArchivo = $archivo->guessExtension();
                if(!file_exists('notas')){
                    mkdir('notas');
                }
                $nombreArchivo = $nota->id.".".$extencionArchivo;
                $ruta = public_path('notas/'.$nombreArchivo);
                copy($archivo,$ruta);
                $nota->archivo = 'notas/'.$nombreArchivo;
                $nota->save();
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
            return redirect()->route('notas.mostrar')
                ->withErrors(["errorRegistro" => "No es posible registrar la nota por ¡favor contacta al desarrollador!"])
                ->withInput();
        }
        Session::flash('success', 'ok');
        return redirect()->route('notas.mostrar');
    }

    public function informacion ($id){

        DB::beginTransaction();
        try {
            $nota = Nota::find($id);
            if($nota)
                return json_encode(["estatus" => "ok", "nota" => $nota]);
            else
                return json_encode(["estatus" => "error", "nota" => ""]);
        }catch (\Exception $e){
            DB::rollback();
            //echo json_encode($e);
            return redirect()->route('notas.mostrar')
                ->withErrors(["errorRegistro" => "No es posible registrar la nota por ¡favor contacta al desarrollador!"])
                ->withInput();
        }
    }

    public function eliminar ($id){

        DB::beginTransaction();
        try {
            $nota = Nota::find($id);
            if($nota){
                $nota->delete();
                if(file_exists($nota->archivo)){
                    unlink($nota->archivo);
                }
                DB::commit();
                return json_encode(["estatus" => "ok", "nota" => ""]);
            }
            else
                return json_encode(["estatus" => "error", "nota" => ""]);
        }catch (\Exception $e){
            DB::rollback();
            //echo json_encode($e);
            return redirect()->route('notas.mostrar')
                ->withErrors(["errorRegistro" => "No es posible registrar la nota por ¡favor contacta al desarrollador!"])
                ->withInput();
        }
    }
}
