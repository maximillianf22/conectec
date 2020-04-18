<?php

namespace App\Http\Controllers\Api\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\tbl_solicitudes_de_contratacion;
use App\tbl_formulario_de_pago_contratacion;
use App\tbl_configuraciones_artistas;
use App\tbl_billeteras;
use App\tbl_movimientos;
use App\PagosPayu;
use Session;
use Redirect;
use App\User;

class PagosController extends Controller
{

    public function pagarContrato($token,$parametro)
    {
        //parametro = id de la contratacion
        if (!empty($token)) {
            if (!empty($parametro)) {
                $contratacion = tbl_solicitudes_de_contratacion::where('ID', $parametro)->where('TOKEN_CONTRATACION',$token)->first();
                if (!empty($contratacion)) {
                    if ($contratacion->ID_ESTADO == 46) {
                        $valorContratacion = tbl_formulario_de_pago_contratacion::where('ID_SOLICITUD_DE_CONTRATACION', $parametro)->first();
                        $idCliente = $contratacion->ID_CLIENTE;
                        $dataUser = User::where('id',$idCliente)->first();
                        return view('pagarContrato',compact('contratacion','dataUser','valorContratacion'));
                    }else{
                        return view('errorPagos');
                    }
                }else{
                    return view('errorPagos');
                }

            }else{
                return view('errorPagos');
            }
        }else{
            return view('errorPagos');
        }
    }

    public function pagarMovimiento(Request $request)
    {
        //Crear movimiento
        $idContratacion = $request->parametro;
        //Información del contrato
        $contratacion = tbl_solicitudes_de_contratacion::findOrFail($idContratacion);

        if ($contratacion->ID_ESTADO == 40) {
            $state = 1;
            $message = "No puedes pagar 2 veces una contratacion";
            $data = array("state" => $state,'mensaje' => $message);
            return json_encode($data);
        }else{
            //Buscamos el procentajhe de ganacia de la plataforma
            $configArtista = tbl_configuraciones_artistas::where('ID_ARTISTA', $contratacion->ID_ARTISTA)->first();

            //Información del formulario de pago
            $formulario = tbl_formulario_de_pago_contratacion::where('ID_SOLICITUD_DE_CONTRATACION',$idContratacion)->first();

            if ($contratacion->ID_MOVIMIENTO <> null) {
                $state = 1;
                $valorTotal = $formulario->PRECIO;
                $idMov = $contratacion->ID_MOVIMIENTO;
                $data = array("state" => $state,'valor' => $valorTotal, 'idMov' => $idMov);
                return json_encode($data);
            }else{
                //Registramos la movimiento
                $movimiento                        = new tbl_movimientos();
                $movimiento->ID_ARTISTA            = $contratacion->ID_ARTISTA;
                $movimiento->ID_CLIENTE            = $contratacion->ID_CLIENTE;
                $movimiento->ID_TIPO               = 32;
                $movimiento->ID_ESTADO             = 62;
                $movimiento->MTDO_PAGO             = 1;//PAYU 2//Cartera
                $movimiento->COSTO_TOTAL           = $formulario->PRECIO;
                $movimiento->PORCENTAJE_PLATAFORMA = $configArtista->COMICION_CONTRATOS;
                $movimiento->COMICION_PLATAFORMA   = ($configArtista->COMICION_CONTRATOS / 100) * $formulario->PRECIO;
                $movimiento->PORCENTAJE_ARTISTA    = (100 - $configArtista->COMICION_CONTRATOS);
                $movimiento->COMICION_ARTISTA      = $formulario->PRECIO - (($configArtista->COMICION_CONTRATOS / 100) * $formulario->PRECIO);
                $movimiento->save();

                $contratacion = tbl_solicitudes_de_contratacion::findOrFail($idContratacion);
                $contratacion->COSTO = $formulario->PRECIO;
                $contratacion->ID_MOVIMIENTO = $movimiento->ID;
                $contratacion->ID_ESTADO = 46;
                $contratacion->update();

                $state = 1;
                $valorTotal = $formulario->PRECIO;
                $idMov = $movimiento->ID;
                $data = array("state" => $state,'valor' => $valorTotal, 'idMov' => $idMov);
                return json_encode($data);
            }

            
        }
    }

    public function responsePayu(Request $request)
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
                return redirect::to('contrato/pagar/respuesta');
            }else{
                Session::flash('message_error', $estadoTx);
                return redirect::to('contrato/pagar/respuesta');
            }
        }else{
            Session::flash('message_error', 'Error validando firma digital.');
            return redirect::to('contrato/pagar/respuesta');
        }
    }

    public function respuestaPago()
    {
        return view('respuestaPagos');
    }

    public function confirmationPayu(Request $request)
    {
        $state_pol = $request->state_pol;
        $reference_sale = $request->reference_sale;
        $value = $request->value;
        $new_value = number_format($value, 1, '.', '');
        $currency = $request->currency;
        $firma_cadena = env('PAYU_API_KEY') . "~" . env('PAYU_MERCHANT_ID') . "~" . $reference_sale . "~" . $new_value . "~" . $currency . "~" . $state_pol;
        $firmacreada = md5($firma_cadena);

        $idContratacion = $request->extra1;
        $idMovimiento = $request->extra3;
        $firma = $request->sign;
        $messagePayu = "En espera";

        if (strtoupper($firma) == strtoupper($firmacreada)) {
            $contratacion = tbl_solicitudes_de_contratacion::findOrFail($idContratacion);
            if ($contratacion->ID_ESTADO <> 47) {
                if (!empty($contratacion)) {
                    $dataMov = tbl_movimientos::where('ID',$idMovimiento)->first();
                    if ($state_pol == 4 ) {
                        //Transacción aprobada
    
                        //Actualizamos el estado a pagado en contratacion
                        $contratacion->ID_ESTADO = 47;
                        $contratacion->update();
                        //Actualizamos el estado del movimiento
                        $dataMov->ID_ESTADO = 40;
                        $dataMov->update();
    
                        //Billetera del artista
                        $billeteraArtista = tbl_billeteras::where('ID_USER', $contratacion->ID_ARTISTA)->first();
    
                        //Billetera del administrador
                        $billeteraAdmin = tbl_billeteras::where('ID_USER', 28)->first();
    
                        //Acreditamos el porcentaje de ganacia al artista
                        $billeteraArtista->SALDO = $billeteraArtista->SALDO + $dataMov->COMICION_ARTISTA;
                        $billeteraArtista->SALDO_TOTAL = $billeteraArtista->SALDO_TOTAL + $billeteraArtista->SALDO;
                        $billeteraArtista->update();
    
                        //Acreditamos el porcentaje de ganacia al administrador
                        $billeteraAdmin->SALDO       = $billeteraAdmin->SALDO + $dataMov->COMICION_PLATAFORMA;
                        $billeteraAdmin->SALDO_TOTAL = $billeteraAdmin->SALDO_TOTAL + $billeteraAdmin->SALDO;
                        $billeteraAdmin->update();
    
                        $messagePayu = "Transacción aprobada";
    
                    }else if($state_pol == 7){
                        //Transacción pendiente
    
                        //Actualizamos el estado del movimiento
                        $dataMov->ID_ESTADO = 63;
                        $dataMov->update();
    
                        $messagePayu = "Transacción pendiente";
    
                    }else if ($state_pol == 6 ) {
                        //Transacción rechazada
                        
                        //Actualizamos el estado del movimiento
                        $dataMov->ID_ESTADO = 41;
                        $dataMov->update();
    
                        $messagePayu = "Transacción rechazada";
    
                    }else {
                        //Actualizamos el estado del movimiento
                        $dataMov->ID_ESTADO = 41;
                        $dataMov->update();
                
                        $messagePayu = "Error en la Transaccion";
                    }
                }else{
                    $messagePayu = "La contratacion no existe";
                }
            }else{
                $messagePayu = "Ya esta contratacion esta pagada";
            }
        }else{
            $messagePayu = "Las firmas no coinciden";
        }

        $newPagoPayu = new PagosPayu;
        $newPagoPayu->codePedido = empty($request->extra2) ? null : $request->extra2;
        $newPagoPayu->messagePayu = empty($messagePayu) ? null : $messagePayu;
        $newPagoPayu->response_code_pol = empty($request->response_code_pol) ? null : $request->response_code_pol;
        $newPagoPayu->phone = empty($request->phone) ? null : $request->phone;
        $newPagoPayu->additional_value = empty($request->additional_value) ? null : $request->additional_value;
        $newPagoPayu->test = empty($request->test) ? null : $request->test;
        $newPagoPayu->transaction_date = empty($request->transaction_date) ? null : $request->transaction_date;
        $newPagoPayu->cc_number = empty($request->cc_number) ? null : $request->cc_number;
        $newPagoPayu->cc_holder = empty($request->cc_holder) ? null : $request->cc_holder;
        $newPagoPayu->error_code_bank = empty($request->error_code_bank) ? null : $request->error_code_bank;
        $newPagoPayu->billing_country = empty($request->billing_country) ? null : $request->billing_country;
        $newPagoPayu->bank_referenced_name = empty($request->bank_referenced_name) ? null : $request->bank_referenced_name;
        $newPagoPayu->description = empty($request->description) ? null : $request->description;
        $newPagoPayu->administrative_fee_tax = empty($request->administrative_fee_tax) ? null : $request->administrative_fee_tax;
        $newPagoPayu->value = empty($request->value) ? null : $request->value;
        $newPagoPayu->administrative_fee = empty($request->administrative_fee) ? null : $request->administrative_fee;
        $newPagoPayu->payment_method_type = empty($request->payment_method_type) ? null : $request->payment_method_type;
        $newPagoPayu->office_phone = empty($request->office_phone) ? null : $request->office_phone;
        $newPagoPayu->email_buyer = empty($request->email_buyer) ? null : $request->email_buyer;
        $newPagoPayu->response_message_pol = empty($request->response_message_pol) ? null : $request->response_message_pol;
        $newPagoPayu->error_message_bank = empty($request->error_message_bank) ? null : $request->error_message_bank;
        $newPagoPayu->shipping_city = empty($request->shipping_city) ? null : $request->shipping_city;
        $newPagoPayu->transaction_id = empty($request->transaction_id) ? null : $request->transaction_id;
        $newPagoPayu->sign = empty($request->sign) ? null : $request->sign;
        $newPagoPayu->tax = empty($request->tax) ? null : $request->tax;
        $newPagoPayu->transaction_bank_id = empty($request->transaction_bank_id) ? null : $request->transaction_bank_id;
        $newPagoPayu->payment_method = empty($request->payment_method) ? null : $request->payment_method;
        $newPagoPayu->billing_address = empty($request->billing_address) ? null : $request->billing_address;
        $newPagoPayu->payment_method_name = empty($request->payment_method_name) ? null : $request->payment_method_name;
        $newPagoPayu->pse_bank = empty($request->pse_bank) ? null : $request->pse_bank;
        $newPagoPayu->state_pol = empty($request->state_pol) ? null : $request->state_pol;
        $newPagoPayu->date = empty($request->date) ? null : $request->date;
        $newPagoPayu->nickname_buyer = empty($request->nickname_buyer) ? null : $request->nickname_buyer;
        $newPagoPayu->reference_pol = empty($request->reference_pol) ? null : $request->reference_pol;
        $newPagoPayu->currency = empty($request->currency) ? null : $request->currency;
        $newPagoPayu->risk = empty($request->risk) ? null : $request->risk;
        $newPagoPayu->shipping_address = empty($request->shipping_address) ? null : $request->shipping_address;
        $newPagoPayu->bank_id = empty($request->bank_id) ? null : $request->bank_id;
        $newPagoPayu->payment_request_state = empty($request->payment_request_state) ? null : $request->payment_request_state;
        $newPagoPayu->customer_number = empty($request->customer_number) ? null : $request->customer_number;
        $newPagoPayu->administrative_fee_base = empty($request->administrative_fee_base) ? null : $request->administrative_fee_base;
        $newPagoPayu->attempts = empty($request->attempts) ? null : $request->attempts;
        $newPagoPayu->merchant_id = empty($request->merchant_id) ? null : $request->merchant_id;
        $newPagoPayu->exchange_rate = empty($request->exchange_rate) ? null : $request->exchange_rate;
        $newPagoPayu->shipping_country = empty($request->shipping_country) ? null : $request->shipping_country;
        $newPagoPayu->installments_number = empty($request->installments_number) ? null : $request->installments_number;
        $newPagoPayu->franchise = empty($request->franchise) ? null : $request->franchise;
        $newPagoPayu->payment_method_id = empty($request->payment_method_id) ? null : $request->payment_method_id;
        $newPagoPayu->extra1 = empty($request->extra1) ? null : $request->extra1;
        $newPagoPayu->antifraudMerchantId = empty($request->antifraudMerchantId) ? null : $request->antifraudMerchantId;
        $newPagoPayu->extra3 = empty($request->extra3) ? null : $request->extra3;
        $newPagoPayu->commision_pol_currency = empty($request->commision_pol_currency) ? null : $request->commision_pol_currency;
        $newPagoPayu->nickname_seller = empty($request->nickname_seller) ? null : $request->nickname_seller;
        $newPagoPayu->ip = empty($request->ip) ? null : $request->ip;
        $newPagoPayu->commision_pol = empty($request->commision_pol) ? null : $request->commision_pol;
        $newPagoPayu->airline_code = empty($request->airline_code) ? null : $request->airline_code;
        $newPagoPayu->billing_city = empty($request->billing_city) ? null : $request->billing_city;
        $newPagoPayu->pse_reference1 = empty($request->pse_reference1) ? null : $request->pse_reference1;
        $newPagoPayu->cus = empty($request->cus) ? null : $request->cus;
        $newPagoPayu->reference_sale = empty($request->reference_sale) ? null : $request->reference_sale;
        $newPagoPayu->authorization_code = empty($request->authorization_code) ? null : $request->authorization_code;
        $newPagoPayu->pse_reference3 = empty($request->pse_reference3) ? null : $request->pse_reference3;
        $newPagoPayu->pse_reference2 = empty($request->pse_reference2) ? null : $request->pse_reference2;
        $newPagoPayu->save();
        return;

    }
}
