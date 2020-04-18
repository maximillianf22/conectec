<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_parametros;
use App\User;
use Auth;
use Session;
use Redirect;

class ValoresConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request, [
            'NOMBRE' => 'required',
            'DESCRIPCION' => 'required',
            ], [
            'NOMBRE.required' => 'El nombre es obligatorio',
            'DESCRIPCION.required' => 'La descripcion es obligatorio',
        ]);

        $configuraciones = tbl_parametros::findOrFail($id);
        $configuraciones->NOMBRE = $request->NOMBRE;
        $configuraciones->DESCRIPCION = $request->DESCRIPCION;
        $configuraciones->update();

        Session::flash('message', 'Actualización exitosa');
        return redirect::to('/administrador/configuraciones/'.$configuraciones->ID_VALOR);
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
