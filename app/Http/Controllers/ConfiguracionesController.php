<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_billeteras;
use App\tbl_parametros;
use App\tbl_genero;
use App\tbl_valores;
use App\User;
use Auth;
use Session;
use Redirect;

class ConfiguracionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->tipoUsuario;
        $user->billetera;

        //Celebridades
        $configuraciones = tbl_valores::where('ID_ESTADO', '0')
            ->whereIn('ID', [1, 4, 11, 12])
            ->get();

        return view('administracion.configuraciones.index')->with([
            "configuraciones" => $configuraciones,
            "user" => $user,
            "configuracion" => "configuracion",
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
        if ($request->type == 1) {
            //CREAR GENEROS
            $genero = tbl_parametros::where('NOMBRE', $request->NOMBRE)->first();
            if (empty($genero)) {
                $newValores = new tbl_parametros();
                $newValores->ID_VALOR = 1;
                $newValores->NOMBRE = $request->NOMBRE;
                $newValores->DESCRIPCION = $request->DESCRIPCION;
                $newValores->ID_ESTADO = 0;
                if ($newValores->save()) {
                    
                    $slug = $newValores->NOMBRE;
                    $replace = array(" ", ",", ".", "\"", "á", "é", "í", "ó", "ú", "/");
                    $newCaracteres = array("-", "", "", "", "a", "e", "i", "o", "u", "");
                    $slug = str_replace($replace, $newCaracteres, $slug);

                    $newGeneros = new tbl_genero();
                    $newGeneros->idparametro = $newValores->ID;
                    $newGeneros->nombreGenero = $newValores->NOMBRE;
                    $newGeneros->slug = $slug;
                    $newGeneros->descripcionGenero = $newValores->DESCRIPCION;
                    $newGeneros->idState = 1;
                    if (!empty($request->imagen)) {
                        $file = $request->file('imagen');
                        $imagen = getimagesize($file);
                        $ancho = $imagen[0];
                        $alto = $imagen[1];
                        if ($ancho == 350 || $alto == 350) {
                            $name = $newGeneros->nombreGenero. '.' . $file->getClientOriginalExtension();
                            $file->move(public_path() . '/assets/img/generos/', $name);
                            $newGeneros->imagenDefault = $name;
                        }else{
                            Session::flash('message_error', 'La imagen debe ser de 350x350');
                            return Redirect::back();
                        }
                    }
                    if ($newGeneros->save()) {
                        Session::flash('message', 'Genero creado correctamente');
                        return redirect::to('/administrador/configuraciones/1'); 
                    }
                }
            }else{
                Session::flash('message_error', 'Este nombre de genero ya se encuentra registrado');
                return redirect::to('/administrador/configuraciones/1'); 
            }
            
        }else if($request->type == 14){
            $newValores = new tbl_parametros();
            $newValores->ID_VALOR = 14;
            $newValores->NOMBRE = $request->NOMBRE;
            $newValores->DESCRIPCION = $request->DESCRIPCION;
            $newValores->ID_ESTADO = 0;
            if($newValores->save()){
                Session::flash('message', 'Celebridad creada correctamente');
                return redirect::to('/administrador/configuraciones/14');
            }
        }
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

        $configuracion = tbl_valores::findOrFail($id);
        $parametros = tbl_parametros::where('ID_VALOR',$id)->orderBy('ID', 'DESC')->get();
       
        
        return view('administracion.configuraciones.show')->with([
            "configuraciones" => $configuracion,
            "parametros" => $parametros,
            "user" => $user,
            "configuracion" => "configuracion",
            "ID" => $id
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
        $this->validate($request, [
            'NOMBRE' => 'required',
            ], [
            'NOMBRE.required' => 'El nombre es obligatorio',
        ]);

        $configuraciones = tbl_valores::findOrFail($id);
        $configuraciones->NOMBRE = $request->NOMBRE;
        $configuraciones->update();

        Session::flash('message', 'Actualizaciòn exitosa');
        return redirect::to('/administrador/configuraciones');
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
