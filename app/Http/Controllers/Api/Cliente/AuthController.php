<?php

namespace App\Http\Controllers\Api\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\tbl_billeteras;
use App\tbl_parametros;
use Hash;
use Mail;

class AuthController extends Controller
{

    public function tokenNotification()
    {
        $state = 0;
        do {
        $randCode = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $numToken = 60;
        $token = substr(str_shuffle($randCode), 0, $numToken);

        $dataUser = User::where('NOTIFICATION_TOKEN', $token)->first();
        if (empty($dataUser)) {
            $state = 1;
        }
        } while ($state == 0);

        return($token);
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if(!empty($email)){
            $cliente = User::where('email',$email)->where('id_perfil', 0)->first();
            if (!empty($cliente)) {
                if (!empty($password)) {
                    if (Hash::check($password, $cliente->password)){
                        switch ($cliente->id_estado) {
                            case 10:
                                    $message = 'Esta cuenta aun no sido verificada, revisa tu correo electrónico';
                                    $response = array('state' => 'error', 'message' => $message, 'code' => 300);
                                    return response()->json($response);
                                break;
        
                            case 11:
                                    $message = 'Esta cuenta fue rechazada';
                                    $response = array('state' => 'error', 'message' => $message, 'code' => 300);
                                    return response()->json($response);
                                break;
        
                            case 17:
                                    $message = 'Esta cuenta esta siendo revisada por el administrador';
                                    $response = array('state' => 'error', 'message' => $message, 'code' => 300);
                                    return response()->json($response);
                                break;
        
                            case 19:
                                    $message = 'Esta cuenta fue rechazada contecte con el administrador';
                                    $response = array('state' => 'error', 'message' => $message, 'code' => 300);
                                    return response()->json($response);
                                break;
        
                            default:
                                    $token = $this->tokenNotification();
                                    $cliente->NOTIFICATION_TOKEN = $token;
                                    $cliente->save();
                                    $message = 'Bienvenido a Conecte Artista';
                                    $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $cliente);
                                    return response()->json($response);
                                break;
                        }
                       
                    }else{
                        $message = 'Usuario o contraseña incorrecta';
                        $response = array('state' => 'error', 'message' => $message, 'code' => 300);
                        return response()->json($response);
                    }
                }else{
                    $message = 'Debe enviar la contraseña';
                    $response = array('state' => 'error', 'message' => $message, 'code' => 300);
                    return response()->json($response);
                }
            }else{
                $message = 'Usuario o contraseña incorrecta';
                $response = array('state' => 'error', 'message' => $message, 'code' => 400);
                return response()->json($response);
            }
        }else{
            $message = 'Debe enviar el correo';
            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
            return response()->json($response);
        }
    }

    public function registro(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $nombre = $request->nombre;
        if (!empty($email)) {
            $validar = User::where('email',$email)->first();
            if (empty($validar)) {
                if (!empty($password)) {
                    $msg = tbl_parametros::where('ID', '18')->get();

                    $user = new User();
                    $user->name = $nombre;
                    $user->email = $email;
                    $user->password = bcrypt($password);
                    $user->id_perfil = 0;
                    $user->id_estado = 10;
                    $user->remember_token = str_random(100);
                    $user->confirm_token = str_random(100);
                    $user->save();

                    $billetera = new tbl_billeteras();
                    $billetera->ID_USER = $user->id;
                    $billetera->SALDO = "0";
                    $billetera->SALDO_TOTAL = "0";
                    $billetera->save();

                    $data['name'] = $user->name;
                    $data['email'] = $user->email;
                    $data['confirm_token'] = $user->confirm_token;

                    Mail::send('mail.confirmacion', ['data' => $user, 'msg' => $msg->first()], function ($mail) use ($data) {
                        $mail->subject('Confirma tu cuenta');
                        $mail->to($data['email'], $data['name']);
                    });

                    $message = 'Registro Exitoso, Gracias por ser parte de conecte.com, hemos enviado un correo de confirmacion';
                    $response = array('state' => 'success', 'message' => $message, 'code' => 200);
                    return response()->json($response);

                }else{
                    $message = 'Debe enviar la contraseña';
                    $response = array('state' => 'error', 'message' => $message, 'code' => 300);
                    return response()->json($response);
                }
            }else{
                $message = 'El correo ya se encuentra registrado en nuestra plataforma.';
                $response = array('state' => 'error', 'message' => $message, 'code' => 300);
                return response()->json($response);
            }
        }else{
            $message = 'Debe enviar el correo';
            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
            return response()->json($response);
        }
    }


    public function editarPerfil(Request $request)
    {
        $idCliente = $request->idCliente;
        $dataUser = User::where('id', $idCliente)->first();

        if (!empty($dataUser)) {
            $dataUser->name = $request->nombre;
            if (!empty($request->password)) {
                $dataUser->password = bcrypt($request->password);
            }
            if ($dataUser->save()) {
                $message = 'Usuario actualizado correctamente';
                $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $dataUser);
                return response()->json($response);
            }else{
                $message = 'Hubo un error, por favor intente mas tarde';
                $response = array('state' => 'error', 'message' => $message, 'code' => 300);
                return response()->json($response);
            }
        }else{
            $message = 'Usuario no encotrado';
            $response = array('state' => 'error', 'message' => $message, 'code' => 400);
            return response()->json($response);
        }
    }
}
