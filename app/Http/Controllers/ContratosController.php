<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_solicitudes_de_contratacion;
use App\tbl_formulario_de_pago_contratacion;
use App\tbl_movimientos;
use Mail;
use Redirect;
use Session;
use App\tbl_configuraciones_artistas;
use App\tbl_billeteras;
use Auth;
use Illuminate\Support\Facades\Input;

class ContratosController extends Controller
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

        //Información del contrato
        $contratacion = tbl_solicitudes_de_contratacion::findOrFail($id);

        //Buscamos el procentajhe de ganacia de la plataforma
        $configArtista = tbl_configuraciones_artistas::where('ID_ARTISTA', $contratacion->ID_ARTISTA)->get();
        $configArtista = $configArtista->first();

        //Información del formulario de pago
        $formulario = tbl_formulario_de_pago_contratacion::where('ID_SOLICITUD_DE_CONTRATACION',$id)->get();
        $formulario = $formulario->first();

        //Billetera del artista
        $billeteraArtista = tbl_billeteras::where('ID_USER', $contratacion->ID_ARTISTA)->get();
        $billeteraArtista = $billeteraArtista->first();

        //Billetera del administrador
        $billeteraAdmin = tbl_billeteras::where('ID_USER', 1)->get();
        $billeteraAdmin = $billeteraAdmin->first();

        //Conocer cuanto tiene el cliente en la billetera
        $billetera = tbl_billeteras::where('ID_USER', Auth::user()->id)->get();
        $billetera = $billetera->first();

        //validamos si cliente tiene suficiente dinero para pagar la licitacion
        if ($billetera->SALDO >= $formulario->PRECIO) {
            
            //Registramos la movimiento
            $movimiento                        = new tbl_movimientos();
            $movimiento->ID_ARTISTA            = $contratacion->ID_ARTISTA;
            $movimiento->ID_CLIENTE            = $contratacion->ID_CLIENTE;
            $movimiento->ID_TIPO               = 32;
            $movimiento->ID_ESTADO             = 40;
            $movimiento->COSTO_TOTAL           = $formulario->PRECIO;
            $movimiento->PORCENTAJE_PLATAFORMA = $configArtista->COMICION_CONTRATOS;
            $movimiento->COMICION_PLATAFORMA   = ($configArtista->COMICION_CONTRATOS / 100) * $formulario->PRECIO;
            $movimiento->PORCENTAJE_ARTISTA    = (100 - $configArtista->COMICION_CONTRATOS);
            $movimiento->COMICION_ARTISTA      = $formulario->PRECIO - (($configArtista->COMICION_CONTRATOS / 100) * $formulario->PRECIO);
            $movimiento->save();


            //Actulizamos la billetera
            $billetera = tbl_billeteras::where('ID_USER', Auth::user()->id)->get();
            $billetera = $billetera->first();
            $billetera->SALDO = ($billetera->SALDO - $formulario->PRECIO);
            $billetera->update();

            //Acreditamos el porcentaje de ganacia al artista
            $billeteraArtista->SALDO = $billeteraArtista->SALDO + $movimiento->COMICION_ARTISTA;
            $billeteraArtista->SALDO_TOTAL = $billeteraArtista->SALDO_TOTAL + $billeteraArtista->SALDO;
            $billeteraArtista->update();

            //Acreditamos el porcentaje de ganacia al administrador
            $billeteraAdmin->SALDO       = $billeteraAdmin->SALDO + $movimiento->COMICION_PLATAFORMA;
            $billeteraAdmin->SALDO_TOTAL = $billeteraAdmin->SALDO_TOTAL + $billeteraAdmin->SALDO;
            $billeteraAdmin->update();

            $formulario = tbl_formulario_de_pago_contratacion::where('ID_SOLICITUD_DE_CONTRATACION',$id)->get();
            $formulario = $formulario->first();

            $contratacion = tbl_solicitudes_de_contratacion::findOrFail($id);
            $contratacion->ID_ESTADO = 47;
            $contratacion->COSTO = $formulario->PRECIO;
            $contratacion->ID_MOVIMIENTO = $movimiento->ID;
            $contratacion->update();

            Session::flash('message', 'Pago relizado con exito');
            return Redirect::back();
        }else{
            Session::flash('message_error', 'Fondos insuficientes');
            return redirect::to('artista/' . $request->nombre_artistico);
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
       //Información del contrato
       $contratacion = tbl_solicitudes_de_contratacion::findOrFail($id);
       $contratacion->ID_ESTADO = 48;
       $contratacion->update();

       Session::flash('message', 'Contrato cancelado');
       return Redirect::back();
    }
}
