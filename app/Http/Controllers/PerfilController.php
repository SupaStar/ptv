<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Perfil;
use App\User;

class PerfilController extends Controller
{
    public function getPerfil()
    {
        $usuario=Auth::user();

                return response()->json($usuario);
    }
    public function updatePerfil(Request $request)
    {

        $usuario=Auth::user();
        $usuario->name=$request->nombrep;
        $usuario->lastname=$request->apellido;
        $usuario->username=$request->nombreUsuario;
        $usuario->admin=$request->tipoEmpleado;
        $usuario->email=$request->correo;
        $usuario->save();
        return view('punto-venta.index');
    }
    public function perfil()
    {

        return view("perfil.user-profile");
    }
    public function usuarios()
    {

        return view("perfil.usuarios");
    }
}
