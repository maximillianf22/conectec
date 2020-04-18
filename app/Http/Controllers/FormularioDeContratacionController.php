<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_formulario_de_pago_contratacion;
use App\tbl_solicitudes_de_contratacion;
use Mail;
use Redirect;
use Session;

class FormularioDeContratacionController extends Controller
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
        
        $this->validate($request, [
            'ID_SOLICITUD_DE_CONTRATACION' => 'required',
            'PRECIO' => 'required',
        ], [
            'ID_SOLICITUD_DE_CONTRATACION.required' => 'Revice los datos ingresados',
            'PRECIO.required' => 'El precio es requerido',
        ]);

        $negociacion = new tbl_formulario_de_pago_contratacion();
        $negociacion->ID_SOLICITUD_DE_CONTRATACION = $request->ID_SOLICITUD_DE_CONTRATACION;
        $negociacion->PRECIO = $request->PRECIO;
        $negociacion->save();

        $contratacion = tbl_solicitudes_de_contratacion::findOrFail($negociacion->ID_SOLICITUD_DE_CONTRATACION);
        $contratacion->ID_ESTADO = 46;
        $contratacion->update();
        

        Session::flash('message', 'Formulario de pago habilitado exitosamente');
        return Redirect::back();
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
            'TIPO' => 'required',
        ], [
            'TIPO.required' => 'Datos obligatorios',
        ]); 
        //$contratacion->formulario;

        if ($request->TIPO === '0') {

            $this->validate($request, [
                'PRECIO' => 'required',
            ], [
                'PRECIO.required' => 'El precio es requerido',
            ]);

            $negociacion = tbl_formulario_de_pago_contratacion::findOrFail($id);    
            $negociacion->PRECIO = $request->PRECIO;
            $negociacion->update();
    
    
            Session::flash('message', 'Formulario de pago actulizado exitosamente');
            return Redirect::back();
        }elseif ($request->TIPO === '1') {
            $negociacion = tbl_formulario_de_pago_contratacion::findOrFail($id);        
            $contratacion = tbl_solicitudes_de_contratacion::findOrFail($negociacion->ID_SOLICITUD_DE_CONTRATACION);
            $contratacion->ID_ESTADO = 49;
            $contratacion->update();

            Session::flash('message', 'Contrato finalizado exitosamente');
            return Redirect::back();

        }elseif ($request->TIPO === '2') {
            $contratacion = tbl_solicitudes_de_contratacion::findOrFail($id);
            $contratacion->ID_ESTADO = 48;
            $contratacion->update();

            Session::flash('message', 'Contrato cancelado exitosamente');
            return Redirect::back();

        }elseif ($request->TIPO === '3') {
            $negociacion = tbl_formulario_de_pago_contratacion::findOrFail($id);        
            $contratacion = tbl_solicitudes_de_contratacion::findOrFail($negociacion->ID_SOLICITUD_DE_CONTRATACION);
            $contratacion->ID_ESTADO = 47;
            $contratacion->update();

            Session::flash('message', 'Contrato activado exitosamente');
            return Redirect::back();

        }elseif ($request->TIPO === '4') {           
            $contratacion = tbl_solicitudes_de_contratacion::findOrFail($id);      
            $negociacion = tbl_formulario_de_pago_contratacion::where('ID_SOLICITUD_DE_CONTRATACION',$contratacion->ID)->get();
            if(empty($contratacion->ID_MOVIMIENTO)){
                if(count($negociacion) > 0){
                    $contratacion->ID_ESTADO = 46;
                    $contratacion->update();
                }else{
                    $contratacion->ID_ESTADO = 35;
                    $contratacion->update();
                }
            }else{
                $contratacion->ID_ESTADO = 47;
                $contratacion->update();
            }
            

            Session::flash('message', 'Contrato activado exitosamente');
            return Redirect::back();

        }

       


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
