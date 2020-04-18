<?php

namespace App\Http\Controllers\Api\Artista;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\tbl_configuraciones_artistas;
use Hash;

class LoginController extends Controller
{
    /* 
    Codigo de errores
    200 : Ok,
    300 : Vacio,
    400 : No encontrado 
    */

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

    public function store(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if(!empty($email)){
            $cantante = User::where('email',$email)->where('id_perfil', 1)->first();
            if (!empty($cantante)) {
                if (!empty($password)) {
                    if (Hash::check($password, $cantante->password)){
                        switch ($cantante->id_estado) {
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
                                $idArtista = $cantante->id;
                                $token = $this->tokenNotification();
                                $cantante->NOTIFICATION_TOKEN = $token;
                                if ($cantante->save()) {
                                    $dataConfig = tbl_configuraciones_artistas::where('ID_ARTISTA', $idArtista)->first();
                                    $cantante->sitioWeb = $dataConfig->SITIO_WEB == null ? '' : $dataConfig->SITIO_WEB;
                                    $cantante->biografia = $dataConfig->BIOGRAFIA == null ? '' : $dataConfig->BIOGRAFIA;
                                    $cantante->fechaNacimiento = $dataConfig->FECHA_NACIMIENTO == null ? '' : $dataConfig->FECHA_NACIMIENTO;
                                    $message = 'Bienvenido a Conecte Artista';
                                    $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $cantante);
                                    return response()->json($response);
                                }else{
                                    $message = 'Hubo un error en la autenticacion intente mas tarde';
                                    $response = array('state' => 'error', 'message' => $message, 'code' => 300);
                                    return response()->json($response);
                                }
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

    public function editarPerfil(Request $request)
    {
        $idArtista = $request->idArtista;
        $password = $request->clave;
        if(!empty($idArtista)){
            $cantante = User::where('ID',$idArtista)->first();
            if (!empty($cantante)) {
                if (!empty($password)) {
                    if (Hash::check($password, $cantante->password)){
                        $dataConfig = tbl_configuraciones_artistas::where('ID_ARTISTA', $idArtista)->first();
                        if(!empty($request->sitioWeb)){
                            $dataConfig->SITIO_WEB = $request->sitioWeb;
                        }
                        if(!empty($request->fechaNacimiento)){
                            $dataConfig->FECHA_NACIMIENTO = $request->fechaNacimiento;
                        }
                        $cantante->name = $request->nombre;
                        if ($cantante->save()) {
                            $dataConfig->save();
                            $cantante->sitioWeb = $dataConfig->SITIO_WEB;
                            $cantante->fechaNacimiento = $dataConfig->FECHA_NACIMIENTO;
                            $cantante->biografia = $dataConfig->BIOGRAFIA;
                            $message = 'Usuario Actualizado';
                            $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $cantante);
                            return response()->json($response);
                        }
                    }else{
                        $message = 'Contraseña incorrecta';
                        $response = array('state' => 'error', 'message' => $message, 'code' => 300);
                        return response()->json($response);
                    }
                }else{
                    $message = 'Debe enviar la contraseña';
                    $response = array('state' => 'error', 'message' => $message, 'code' => 300);
                    return response()->json($response);
                }
            }else{
                $message = 'Usuario no encotrado';
                $response = array('state' => 'error', 'message' => $message, 'code' => 400);
                return response()->json($response);
            }
        }else{
            $message = 'Debe enviar los valores correctamente';
            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
            return response()->json($response);
        }
    }

    public function agregarBiografia(Request $request){
        $idArtista = $request->idArtista;
        if(!empty($idArtista)){
            $cantante = User::where('ID',$idArtista)->first();
            if (!empty($cantante)) {
                $dataConfig = tbl_configuraciones_artistas::where('ID_ARTISTA', $idArtista)->first();
                $dataConfig->BIOGRAFIA = $request->biografia;
                if ($dataConfig->save()) {
                    $cantante->sitioWeb = $dataConfig->SITIO_WEB;
                    $cantante->fechaNacimiento = $dataConfig->FECHA_NACIMIENTO;
                    $cantante->biografia = $dataConfig->BIOGRAFIA;
                    $message = 'Biografia Actualizada';
                    $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $cantante);
                    return response()->json($response);
                }
            }else{
                $message = 'Usuario no encotrado';
                $response = array('state' => 'error', 'message' => $message, 'code' => 400);
                return response()->json($response);
            }
        }else{
            $message = 'Debe enviar los valores correctamente';
            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
            return response()->json($response);
        }
    }
}
