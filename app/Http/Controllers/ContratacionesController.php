<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\tbl_parametros;
use App\tbl_solicitudes_de_contratacion;
use DB;
use App\tbl_negociacion_contratacion;

class ContratacionesController extends Controller
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
            $contrataciones = 
                    DB::table('tbl_solicitudes_de_contratacion')   
                    ->select(['tbl_solicitudes_de_contratacion.*'])        
                    ->join('users', 'tbl_solicitudes_de_contratacion.ID_CLIENTE', '=', 'users.id')
                    ->where('users.name', 'like', '%' . $nombre . '%')
                    ->where('tbl_solicitudes_de_contratacion.ID_ESTADO', 'like', '%' . $estado . '%')
                    ->pluck('ID')
                    ->toArray();

            $contrataciones = tbl_solicitudes_de_contratacion::whereIn('ID', $contrataciones)       
                ->orderBy('ID','DESC')     
                ->paginate(15);
        }

        $estados = tbl_parametros::where('ID_VALOR','8')
            ->pluck('NOMBRE', 'ID');

        return view('administracion.contrataciones.index')->with([
            "user"        => $user,
            "nombre" => $nombre,
            "estado" => $estado,
            "estados" => $estados,			
            "contrataciones" => $contrataciones,			
            "contratacionesPage" => "contrataciones",
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
        $user = User::findOrFail(Auth::user()->id);
        $user->tipoUsuario;
        $user->billetera;

        $contratacion = tbl_solicitudes_de_contratacion::findOrFail($id);

        $negociacion = tbl_negociacion_contratacion::where('ID_SOLICITUD_DE_CONTRATACION', $id)->get();
        $negociacion->each(function ($negociacion) {
            $negociacion->publicadoPor;
            $negociacion->artista;
            $negociacion->cliente;            
        });

        return view('administracion.contrataciones.show')->with([
            "user"        => $user,			
            "contratacion" => $contratacion,			
            "negociacion" => $negociacion,			
            "contratacionesPage" => "contrataciones",
        ]);
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
}
