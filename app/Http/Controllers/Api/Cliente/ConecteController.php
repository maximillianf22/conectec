<?php

namespace App\Http\Controllers\Api\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\tbl_solicitudes_de_dedicatorias;
use App\tbl_solicitudes_de_contratacion;
use App\tbl_configuraciones_artistas;
use App\tbl_negociacion_contratacion;
use App\tbl_movimientos;
use App\tbl_billeteras;
use App\tbl_parametros;
use App\tbl_slide;
use App\User;
use Mail;
use DB;

class ConecteController extends Controller
{
    //TOKEN DE CONTRATACION
    public function tokenContratacion()
    {
        $state = 0;
        do {
            $randCode = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $numToken = 60;
            $token = substr(str_shuffle($randCode), 0, $numToken);

            $dataContratacion = tbl_solicitudes_de_contratacion::where('TOKEN_CONTRATACION', $token)->first();
            if (empty($dataContratacion)) {
                $state = 1;
            }
        } while ($state == 0);

        return($token);
    }


    public function list(Request $request)
    {
        $idCliente = $request->idCliente;
        if (!empty($idCliente)) {
            $pendientes = DB::table('api_pendientes')->where('ID_CLIENTE', $idCliente)->get();
            if (!empty($pendientes)) {
                $message = 'Lista Pendientes';
                $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $pendientes);
                return response()->json($response);
            }else{
                $message = 'Aun no tienes pendientes';
                $response = array('state' => 'success', 'message' => $message, 'code' => 400);
                return response()->json($response);
            }
        }else{
            $message = 'Debe enviar los valores correctamente';
            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
            return response()->json($response);
        }
        
    }

    public function listFinalizado(Request $request)
    {
        $idCliente = $request->idCliente;
        if (!empty($idCliente)) {
            $historial = DB::table('api_historial')->where('ID_CLIENTE', $idCliente)->get();
            if (!empty($historial)) {
                $message = 'Lista de Conecte';
                $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $historial);
                return response()->json($response);
            }else{
                $message = 'Lista Conecte';
                $response = array('state' => 'success', 'message' => $message, 'code' => 400);
                return response()->json($response);
            }
        }else{
            $message = 'Debe enviar los valores correctamente';
            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
            return response()->json($response);
        }
    }

    //Dedicatoria
    public function solicitar(Request $request)
    {
        //Variables
        $idCliente = $request->idCliente;
        $idArtista = $request->idArtista;
        $deParte = $request->deParte;
        $dirigidoA = $request->dirigidoA;
        $mensaje = $request->mensaje;

        if (!empty($idCliente)) {
            $cliente = User::findOrFail($idCliente);
            $dedicatorias = tbl_solicitudes_de_dedicatorias::where('ID_CLIENTE', $idCliente)
                ->where('ID_ARTISTA',$idArtista)
                ->whereIn('ID_ESTADO', [12, 13])
                ->get();
            if (count($dedicatorias) > 0) {
                $message = 'Actualmete tienes una solicitud de dedicatoria en proceso';
                $response = array('state' => 'error', 'message' => $message, 'code' => 300);
                return response()->json($response);
            }

            //Información del artista
            $artista = User::findOrFail($idArtista);
            //Conocer el costo que tiene una dedicatoria
            $configArtista = tbl_configuraciones_artistas::where('ID_ARTISTA', $idArtista)->first();
            //Billetera del artista
            $billeteraArtista = tbl_billeteras::where('ID_USER', $idArtista)->first();
            //Billetera del administrador
            $billeteraAdmin = tbl_billeteras::where('ID_USER', 1)->first();
            //Conocer cuanto tiene el cliente en la billetera
            $billetera = tbl_billeteras::where('ID_USER', $idCliente)->first();
            
            //validamos si cliente tiene suficiente dinero para pagar la licitacion
            //validamos si cliente tiene suficiente dinero para pagar la licitacion
            if ($billetera->SALDO >= $configArtista->PRECIO_DEDICATORIA) {

                //Registramos la movimiento
                $movimiento                        = new tbl_movimientos();
                $movimiento->ID_ARTISTA            = $idArtista;
                $movimiento->ID_CLIENTE            = $idCliente;
                $movimiento->ID_TIPO               = 31;
                $movimiento->ID_ESTADO             = 40;
                $movimiento->COSTO_TOTAL           = $configArtista->PRECIO_DEDICATORIA;
                $movimiento->PORCENTAJE_PLATAFORMA = $configArtista->COMICION_DECICATORIAS;
                $movimiento->COMICION_PLATAFORMA   = ($configArtista->COMICION_DECICATORIAS / 100) * $configArtista->PRECIO_DEDICATORIA;
                $movimiento->PORCENTAJE_ARTISTA    = (100 - $configArtista->COMICION_DECICATORIAS);
                $movimiento->COMICION_ARTISTA      = $configArtista->PRECIO_DEDICATORIA - (($configArtista->COMICION_DECICATORIAS / 100) * $configArtista->PRECIO_DEDICATORIA);
                $movimiento->save();

                //Registramos la solicitud
                $dedicatoria                    = new tbl_solicitudes_de_dedicatorias();
                $dedicatoria->ID_ARTISTA        = $idArtista;
                $dedicatoria->ID_CLIENTE        = $idCliente;
                $dedicatoria->ID_ESTADO         = 13;
                $dedicatoria->DE_PARTE_DE       = $deParte;
                $dedicatoria->DIRIGIDO_A        = $dirigidoA;
                $dedicatoria->MENSAJE           = $mensaje;
                $dedicatoria->COSTO_DEDICATORIA = $configArtista->PRECIO_DEDICATORIA;
                $dedicatoria->ID_MOVIMIENTO     = $movimiento->ID;
                $dedicatoria->save();
                
                //Actulizamos la billetera
                $billetera->SALDO = ($billetera->SALDO - $configArtista->PRECIO_DEDICATORIA);
                $billetera->update();

                //Acreditamos el porcentaje de ganacia al artista
                $billeteraArtista->SALDO = $billeteraArtista->SALDO + $movimiento->COMICION_ARTISTA;
                $billeteraArtista->SALDO_TOTAL = $billeteraArtista->SALDO_TOTAL + $billeteraArtista->SALDO;
                $billeteraArtista->update();

                //Acreditamos el porcentaje de ganacia al administrador
                $billeteraAdmin->SALDO       = $billeteraAdmin->SALDO + $movimiento->COMICION_PLATAFORMA;
                $billeteraAdmin->SALDO_TOTAL = $billeteraAdmin->SALDO_TOTAL + $billeteraAdmin->SALDO;
                $billeteraAdmin->update();

                $msg = tbl_parametros::where('ID', '38')->get();

                $data['nameArtista'] = $artista->name;
                $data['nameCliente'] = $cliente->name;
                $data['msg'] = $mensaje;
                $data['email'] = $artista->email;

                Mail::send('mail.dedicatoria', ['data' => $data, 'msg' => $msg->first()], function ($mail) use ($data) {
                    $mail->subject('Nueva solicitud de dedicatoria');
                    $mail->to($data['email'], $data['nameArtista']);
                });


                $message = 'Dedicatoria creada con exito';
                $response = array('state' => 'success', 'message' => $message, 'code' => 200);
                return response()->json($response);

            }else{
                $message = 'No hemos podido enviar tu solicitud ya que no cuentas con fondos suficientes';
                $response = array('state' => 'success', 'message' => $message, 'code' => 400);
                return response()->json($response);
            }
        }else{
            $message = 'Debe enviar los valores correctamente';
            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
            return response()->json($response);
        }
    }

    //Contratacion
    public function contratar(Request $request)
    {
        //variables
        $idCliente = $request->idCliente;
        $idArtista = $request->idArtista;
        $pais = $request->pais;
        $ciudad = $request->ciudad;
        $direccion = $request->direccion;
        $name = $request->nombre;
        $telefono = $request->telefono;
        $desde = $request->fecha1;
        $hasta = $request->fecha2;
        $hora = $request->hora;
        $mensaje = $request->mensaje; 

        if (!empty($idCliente)) {
            $cliente = User::findOrFail($idCliente);

            $contratacion = tbl_solicitudes_de_contratacion::where('ID_CLIENTE', $idCliente)
                ->whereIn('ID_ESTADO', [33, 34, 35, 46, 47])
                ->get();

            if (count($contratacion) > 0) {
                $message = 'Actualmente tiene una solicitud de contratación';
                $response = array('state' => 'error', 'message' => $message, 'code' => 300);
                return response()->json($response);
            }

            $token = $this->tokenContratacion();

            $solicitud = new tbl_solicitudes_de_contratacion();
            $solicitud->ID_ARTISTA = $idArtista;
            $solicitud->ID_CLIENTE = $idCliente;
            $solicitud->ID_ESTADO = 33;
            $solicitud->CIUDAD = $ciudad;
            $solicitud->PAIS = $pais;
            $solicitud->DIRECCION = $direccion;
            $solicitud->NOMBRES = $name;
            $solicitud->TELEFONO = $telefono;
            $solicitud->DESDE = $desde;
            $solicitud->HASTA = $hasta;
            $solicitud->HORA = $hora;
            $solicitud->TOKEN_CONTRATACION = $token;
            $solicitud->MENSAJE = $mensaje;
            $solicitud->save();

            $artista = User::findOrFail($idArtista);

            $msg = tbl_parametros::where('ID', '43')->get();

            $data['nameArtista'] = $artista->name;
            $data['nameCliente'] = $cliente->name;
            $data['msg'] = $mensaje;
            $data['email'] = $artista->email;

            Mail::send('mail.contratacion', ['data' => $data, 'msg' => $msg->first()], function ($mail) use ($data) {
                $mail->subject('Nueva solicitud de contratación');
                $mail->to($data['email'], $data['nameArtista']);
            });


            $message = 'Contratacion realizada correctamente';
            $response = array('state' => 'success', 'message' => $message, 'code' => 200);
            return response()->json($response);
        }else{
            $message = 'Debe enviar los valores correctamente';
            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
            return response()->json($response);
        }
    }

    public function listContratacion(Request $request)
    {
        $idContratacion = $request->idContratacion;
        if (!empty($idContratacion)) {
            $datosMessage = tbl_negociacion_contratacion::where('ID_SOLICITUD_DE_CONTRATACION', $idContratacion)->get();
            if (count($datosMessage) <> 0) {
                $message = 'Lista de mensajes';
                $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $datosMessage);
                return response()->json($response);
            }else{
                $message = 'Aun no hay mensajes en esta contratacion..';
                $response = array('state' => 'error', 'message' => $message, 'code' => 400);
                return response()->json($response);
            }
        }else{
            $message = 'Debe enviar los valores correctamente';
            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
            return response()->json($response);
        }
    }

    //Mensaje de contratacion
    public function sendMensaje(Request $request)
    {
        $idContratacion = $request->idContratacion;
        $message = $request->message;
        $idCliente = $request->idCliente;
        $idArtista = $request->idArtista;

        if (!empty($idContratacion) && !empty($message) && !empty($idCliente) && !empty($idArtista)) {
            $newSendMessage = new tbl_negociacion_contratacion;
            $newSendMessage->ID_SOLICITUD_DE_CONTRATACION = $idContratacion;
            $newSendMessage->ID_USER = $idCliente;
            $newSendMessage->ID_CLIENTE = $idCliente;
            $newSendMessage->ID_ARTISTA = $idArtista;
            $newSendMessage->MENSAJE = $message;
            if ($newSendMessage->save()) {
                $message = 'Mensaje enviado con exito';
                $response = array('state' => 'success', 'message' => $message, 'code' => 200);
                return response()->json($response);
            }else{
                $message = 'Ups.. Hubo un error intente mas tarde..!';
                $response = array('state' => 'error', 'message' => $message, 'code' => 400);
                return response()->json($response);
            }
        }else{
            $message = 'Debe enviar los valores correctamente';
            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
            return response()->json($response);
        }

    }

    public function consultarEstado(Request $request)
    {
        $idContratacion = $request->idContratacion;
        if (!empty($idContratacion)) {
            $data = tbl_solicitudes_de_contratacion::where('ID', $idContratacion)->first();
            if ($data->ID_ESTADO == 46) {
                $message = 'Listo para pagar';
                $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => 'true');
                return response()->json($response);
            }else{
                $message = 'Upss.. aun no se encuentra habilitado';
                $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => 'false');
                return response()->json($response);
            }
        }else{
            $message = 'Debe enviar los valores correctamente';
            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
            return response()->json($response);
        }
        
    }

    public function sliders()
    {
        $sliders = tbl_slide::get();

        return json_encode($sliders);
    }
}
