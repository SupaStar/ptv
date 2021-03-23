<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Perfil;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    public function getPerfil()
    {
        $usuario = Auth::user();

        return response()->json($usuario);
    }

    public function updatePerfil(Request $request)
    {

        $usuario = Perfil::find($request->id);
        $usuario->name = $request->nombre;
        $usuario->lastname = $request->apellido;
        $usuario->username = $request->nombreUsuario;
        $usuario->email = $request->correo;
        if (Hash::check($request->contrasenia, $usuario->password)) {

        } else {
            $usuario->password = bcrypt($request->contrasenia);
        }
        $usuario->save();
        if ($request->file() != null) {
            $file = $request->file('imgprueba');
            $nombre = $usuario->id . ("fotoperfil.jpg");
            Storage::disk('public')->put($nombre, \File::get($file));
        }


        return redirect('/usuarios');
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

    public function getUsuarios(Request $request)
    {
        if ($request->filtro == 1) {
            $Usuario = User::all()->where("estado", "=", 1);
            foreach ($Usuario as $user) {
                if ($user->admin == 1) {
                    $user->empleado = "Administrador";
                } else {
                    $user->empleado = "Trabajador";
                }
            }
            foreach ($Usuario as $user) {
                if ($user->estado == 1) {
                    $user->estado = "Activado";
                } elseif ($user->estado == 0) {
                    $user->estado = "Desactivado";
                }
            }
            return response()->json($Usuario);
        } elseif ($request->filtro == 2) {
            $Usuario = User::all()->where("estado", "=", 0);
            foreach ($Usuario as $user) {
                if ($user->admin == 1) {
                    $user->empleado = "Administrador";
                } else {
                    $user->empleado = "Trabajador";
                }
            }
            foreach ($Usuario as $user) {
                if ($user->estado == 1) {
                    $user->estado = "Activado";
                } elseif ($user->estado == 0) {
                    $user->estado = "Desactivado";
                }
            }
            return response()->json($Usuario);
        } else {
            $Usuario = User::all();
            foreach ($Usuario as $user) {
                if ($user->admin == 1) {
                    $user->empleado = "Administrador";
                } else {
                    $user->empleado = "Trabajador";
                }
            }
            foreach ($Usuario as $user) {
                if ($user->estado == 1) {
                    $user->estado = "Activado";
                } elseif ($user->estado == 0) {
                    $user->estado = "Desactivado";
                }
            }
            return response()->json($Usuario);
        }
    }

    public function findu(Request $request)
    {
        $usuario = Perfil::find($request->id);
        return response()->json($usuario);
    }

    public function desactivau(Request $request)
    {
        $usuario = Perfil::find($request->id);
        $usuario->estado = 0;
        $usuario->save();
        return response()->json($usuario);
    }

    public function editap($id)
    {
        $usuario = Perfil::find($id);
        return view("perfil/editar-usuario", compact("usuario", $usuario));
    }

    public function actualizarusuario(Request $request)
    {
        $usuario = Perfil::find($request->id);
        $usuario->name = $request->nombre;
        $usuario->lastname = $request->apellido;
        $usuario->username = $request->nombreUsuario;
        $usuario->admin = $request->tipoEmpleado;
        $usuario->email = $request->correo;
        $usuario->estado = $request->estado;
        if (Hash::check($request->contrasenia, $usuario->password)) {

        } else {
            if($request->contrasenia!=null||$request->contrasenia!="")
            {


            $usuario->password = bcrypt($request->contrasenia);
        }
        }

        $usuario->save();
        if ($request->file() != null) {
            $file = $request->file('imgprueba');
            $nombre = $usuario->id . ("fotoperfil.jpg");
            Storage::disk('public')->put($nombre, \File::get($file));
        }


        return redirect('/usuarios');
    }

    public function registrarusuario(Request $request)
    {
        $usuario = new Perfil();
        $usuario->name = $request->nombre;
        $usuario->lastname = $request->apellido;
        if ($usuariouser = Perfil::all()->where("username", $request->nombreUsuario)->count() >= 1) {
            return redirect('/usuarios')->with("message","OK");
            // return response()->json(["estado"=>false, "detalle"=>"Usuario Repetido"]);
        } else {
            $usuario->username = $request->nombreUsuario;
        }
        $usuario->admin = $request->tipoEmpleado;
        if ($usuariouser = Perfil::all()->where("email", $request->correo)->count() >= 1) {
           return "Usuario ya existe";
            // return response()->json(["estado"=>false, "detalle"=>"Correo ya registrado"]);
        } else {
            $usuario->email = $request->correo;
        }
        $usuario->password = bcrypt($request->contrasenia);
        $usuario->estado = $request->estado;
        $usuario->save();
        if ($file = $request->file('fotoperfil') != null) {
            $file = $request->file('fotoperfil');
            $nombre = $usuario->id . ("fotoperfil.jpg");
            Storage::disk('public')->put($nombre, \File::get($file));
        } else {
            $file = "uploads/fotoperfil/default.png";
            $nombre = $usuario->id . ("fotoperfil.jpg");
            Storage::disk('public')->put($nombre, \File::get($file));
        }

        return response()->json();
    }
}
