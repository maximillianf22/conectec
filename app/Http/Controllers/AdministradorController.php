<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
class AdministradorController extends Controller
{
    public function index(){
        $user = User::findOrFail(Auth::user()->id);
        $user->tipoUsuario;
        $user->billetera;
        return view('administracion.index')->with([
            "user" => $user,
            "administrador" => "administrador",
        ]);
    }
}
