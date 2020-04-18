<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\tbl_movimientos;
use App\tbl_billeteras;
use App\Ciudad;
use Auth;
use Redirect;
use Session;

class RecargaController extends Controller
{
    public function responsePayuR(Request $request)
    {
        $transactionState = $request->transactionState;
        $referenceCode = $request->referenceCode;
        $TX_VALUE = $request->TX_VALUE;
        $new_value = number_format($TX_VALUE, 1, '.', '');
        $currency = $request->currency;
        $firma_cadena = env('PAYU_API_KEY') . "~" . env('PAYU_MERCHANT_ID') . "~" . $referenceCode . "~" . $new_value . "~" . $currency . "~" . $transactionState;
        $firmacreada = md5($firma_cadena);

        if ($transactionState == 4 ) {
            $estadoTx = "Transacción aprobada";
        $tipoView = true;
        }else if ($transactionState == 6 ) {
            $estadoTx = "Transacción rechazada";
        $tipoView = false;
        }else if ($transactionState == 104 ) {
            $estadoTx = "Error";
        $tipoView = false;
        }else if ($transactionState == 7 ) {
            $estadoTx = "Transacción pendiente";
        $tipoView = false;
        }else {
            $estadoTx = $request->message;
        }

        $firma = $request->signature;
        if (strtoupper($firma) == strtoupper($firmacreada)) {
        if ($tipoView) {
            Session::flash('message', $estadoTx);
            return redirect::to('/perfil');
        }else{
            Session::flash('message_error', $estadoTx);
            return redirect::to('/perfil');
        }
        }else{
            Session::flash('message_error', 'Error validando firma digital.');
            return redirect::to('/perfil');
        }
    }

    public function confirmationPayuR(Request $request)
    {
        $state_pol = $request->state_pol;
        $reference_sale = $request->reference_sale;
        $value = $request->value;
        $new_value = number_format($value, 1, '.', '');
        $currency = $request->currency;
        $firma_cadena = env('PAYU_API_KEY') . "~" . env('PAYU_MERCHANT_ID') . "~" . $reference_sale . "~" . $new_value . "~" . $currency . "~" . $state_pol;
        $firmacreada = md5($firma_cadena);
        $idUsuario = $request->extra2;
        $firma = $request->sign;
        if (strtoupper($firma) == strtoupper($firmacreada)) {
            $dataUser = User::where('id', $idUsuario)->first();
            if(!empty($dataUser)){
                if ($state_pol == 4 ) {
                    //Transacción aprobada
                    $messagePayu = "Transacción aprobada";
                    try {
                        //Registramos la movimiento
                        $movimiento                        = new tbl_movimientos();
                        $movimiento->ID_CLIENTE            = $idUsuario;
                        $movimiento->ID_TIPO               = 50;
                        $movimiento->ID_ESTADO             = 40;
                        $movimiento->COSTO_TOTAL           = $new_value;
                        $movimiento->PORCENTAJE_PLATAFORMA = 0;
                        $movimiento->COMICION_PLATAFORMA   = 0;
                        $movimiento->PORCENTAJE_ARTISTA    = 0;
                        $movimiento->COMICION_ARTISTA      = 0;
                        if ($movimiento->save()) {
                            $saldo = tbl_billeteras::where('ID_USER', $idUsuario)->first();
                            if (!empty($saldo)) {
                                $saldo->SALDO = $saldo->SALDO + $new_value;
                                $saldo->save();
                            }else{
                                $messagePayu = "Hubo un error al buscar tu billetera, por favor contacte a soporte";
                            }
                        }
                    } catch (\Throwable $th) {
                        throw $th;
                        $messagePayu = $th;
                    }
    
    
                }else if ($state_pol == 7 ) {
                    //Transacción pendiente
    
                    $messagePayu = "Transacción pendiente";
    
                }else if ($state_pol == 6 ) {
                    //Transacción rechazada

                    $messagePayu = "Transacción rechazada";
    
                }else {
   
                    $messagePayu = "Error en la Transaccion";
                }
            }else{
                $messagePayu = "Usuario no encontrado";
            }
        }else{
            $messagePayu = "Las firmas no coinciden";
        }

        return;

        ///////////////////////////////////////////

        // $data = $request->all();
        // $list = Array();
        // foreach ($data as $key => $value) {
        //   $list[] = "$key=$value";
        // }
        // $string = implode("&", $list);
        //
        // $newContacto = new Contacto;
        // $newContacto->nombre = 'PAYU LOCALHOST';
        // $newContacto->email = $request->currency;
        // $newContacto->mensaje = $string;
        // $newContacto->estado = 1;
        // $newContacto->save();

        //////////////////////////////////////////
    }
}
