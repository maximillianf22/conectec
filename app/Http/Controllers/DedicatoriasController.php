<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\tbl_parametros;
use DB;
use App\tbl_solicitudes_de_dedicatorias;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class DedicatoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->tipoUsuario;
        $user->billetera;

        $nombre = trim($request->get('NOMBRE'));
        $estado = trim($request->get('ESTADO'));

        if ($request) {
            $dedicatorias = 
                    DB::table('tbl_solicitudes_de_dedicatorias')   
                    ->select(['tbl_solicitudes_de_dedicatorias.*'])        
                    ->join('users', 'tbl_solicitudes_de_dedicatorias.ID_CLIENTE', '=', 'users.id')
                    ->where('users.name', 'like', '%' . $nombre . '%')
                    ->where('tbl_solicitudes_de_dedicatorias.ID_ESTADO', 'like', '%' . $estado . '%')
                    ->orderBy('tbl_solicitudes_de_dedicatorias.ID', 'DESC')
                    ->pluck('ID')
                    ->toArray();

            $dedicatorias = tbl_solicitudes_de_dedicatorias::whereIn('ID', $dedicatorias)            
                    ->paginate(15);

        }

        $estados = tbl_parametros::where('ID_VALOR','3')
            ->pluck('NOMBRE', 'ID');

        return view('administracion.dedicatorias.index')->with([
            "user"        => $user,
            "nombre" => $nombre,
            "estado" => $estado,
			"estados" => $estados,			
			"dedicatorias" => $dedicatorias,			
			"dedicatoriasPage" => "dedicatorias",
		]);
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
        //
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
        $dedicatoria = tbl_solicitudes_de_dedicatorias::findOrFail($id);
        $dedicatoria->ID_ESTADO = $request->get('ESTADO');
        $dedicatoria->update();

        Session::flash('message', 'Dedicatoria actulizada satisfactoria');
        return Redirect::back();
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
}
