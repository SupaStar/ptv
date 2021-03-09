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
        $usuario->save();
                return response()->json($usuario);
    }
    public function perfil()
    {

        return view("perfil.user-profile");
    }
}
