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
    public function agregarusuarios()
    {

        return view("perfil.agregarusuario");
    }
    public function getUsuarios()
    {
        $Usuario=User::all();
        foreach ($Usuario as $user)
        {
            if($user->admin==1)
            {
                $user->empleado="Administrador";
            }
            elseif ($user->admin==0){
                $user->empleado="Trabajador";
            }
        }
        return response()->json($Usuario);
    }

    public function registro (){
        return view("auth.register");
    }
    public function create(Request $request){
        // return $request->all();

        $usuario = new User();
        $usuario->admin=$request->tipoEmpleado;
        $usuario->name=$request->nombre;
        $usuario->email=$request->correo;
        $password1 = $request-> password1;
        $password2 = $request-> password2;
        if($password1 != $password2){
            return view("registro",["estatus" => "¡Las contraseñas son diferentes!"]);
        }
        else{
            $usuario -> password = bcrypt($password1);
        }
        $usuario -> lastname = $request -> apellido;
        $usuario->username=$request->nombreUsuario;
        $usuario->save();
        return view('auth.register');

    }
}
