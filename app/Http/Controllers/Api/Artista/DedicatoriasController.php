<?php

namespace App\Http\Controllers\Api\Artista;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\tbl_solicitudes_de_dedicatorias;
use App\User;
use Storage;

class DedicatoriasController extends Controller
{
    /* 
    Codigo de errores
    200 : Ok,
    300 : Vacio,
    400 : No encontrado 
    */

    public function list(Request $request)
    {
        $idArtista = $request->idArtista;
        if (!empty($idArtista)) {
            $dedicatorias = tbl_solicitudes_de_dedicatorias::where('ID_ARTISTA', $idArtista)
                ->where('ID_ESTADO', 13)->get();
            if (count($dedicatorias) <> 0) {
                $cant = count($dedicatorias);
                $message = 'Lista de dedicatorias';
                $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $dedicatorias,'cant' => $cant);
                return response()->json($response);
            }else{
                $message = 'Aun no tiene dedicatorias pendientes';
                $response = array('state' => 'success', 'message' => $message, 'code' => 200);
                return response()->json($response);
            }
        }else{
            $message = 'Debe enviar el idArtista';
            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
            return response()->json($response);
        }
    }

    public function responder(Request $request)
    {
        
        $video = $request->file('video'); 
        $idArtista = $request->idArtista;
        $idDedicatoria = $request->idDedicatoria;
        if (!empty($video) && !empty($idDedicatoria) && !empty($idArtista)) {
            $nombreVideo = $video->getClientOriginalName();
            $dataArtista = User::where('id', $idArtista)->first();
            if (!empty($dataArtista)) {
                /*--- realizo el proceo de la conversion del nuevo video a exportar ----*/
                /* John jairo August 05 - 2019 : 10:57 AM */
               
               //  return $video;

                //$execQuery = 'ffmpeg -i '+$video+' -i assets/img/LogoConecte.png -filter_complex "overlay=10:10" assets/videos_web/salida03.mp4';
                //$outVideo = shell_exec ("$execQuery 2>&1");

                /*-------*/
                $nombreArtista = $dataArtista->nombre_artistico;
                $nombreCarpeta =  str_replace(' ','_',$nombreArtista.''.$idArtista);
                $dedicatoria = tbl_solicitudes_de_dedicatorias::where('ID', $idDedicatoria)->where('ID_ARTISTA', $idArtista)->first();
                if (!empty($dedicatoria)) {
                
                    $storagePath = Storage::disk('s3')->put('conecte/'.$nombreCarpeta.'/'.$nombreVideo, \File::get($video), 'public');
                    //$storagePathNew = Storage::disk('s3')->put('conecte/'.$nombreCarpeta.'/'.$nombreVideo.'01', 'public');

                    if ($storagePath) {
                        $url = 'https://s3-us-west-1.amazonaws.com/cf-develop-files/conecte/'.$nombreCarpeta.'/'.$nombreVideo;
                        $execQuery = 'ffmpeg -i '.$url.' -i assets/img/LogoConecte.png -filter_complex "overlay=10:40" assets/videos_web/conecte_'.$nombreVideo;
                        $outVideo = shell_exec ("$execQuery 2>&1");
                        $storagePathNew = Storage::disk('s3')->put('conecte/'.$nombreCarpeta.'/conecte_'.$nombreVideo,\File::get('assets/videos_web/conecte_'.$nombreVideo), 'public');
                        $urlNew = 'https://s3-us-west-1.amazonaws.com/cf-develop-files/conecte/'.$nombreCarpeta.'/conecte_'.$nombreVideo;
                        
                        unlink('assets/videos_web/conecte_'.$nombreVideo);
                        Storage::disk('s3')->delete($url);

                        //$execQuery = 'ffmpeg -i '+$video+' -i assets/img/LogoConecte.png -filter_complex "overlay=10:10" assets/videos_web/salida03.mp4';
                        //$outVideo = shell_exec ("$execQuery 2>&1");



                        $dedicatoria->URL_DE_RESPUESTA = $urlNew;
                        $dedicatoria->ID_ESTADO = 15;
                        if ($dedicatoria->save()) {

                            $dataCliente = User::where('id',$dedicatoria->ID_CLIENTE)->first();
                            //Creamos la notificacion Push App Cliente
                            $externalUserIds = $dataCliente->NOTIFICATION_TOKEN;
                            $heading = array("en" => "Conecte");
                            $content = array("en" => "$nombreArtista Te a respondido una dedicatoria, Mirala ahora..!");
                            $data = array("type" => "1", "data" => $dedicatoria);
                            $fields = array(
                                'app_id' => '58b13a5f-797f-4777-9d3f-e4f61fa9deff',
                                'include_external_user_ids' => array("$externalUserIds"),
                                'data' => $data,
                                'contents' => $content,
                                'headings' => $heading
                            );

                            ob_start();

                            $fields = json_encode($fields);
                            print("\nJSON sent:\n");
                            print($fields);

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                            curl_setopt($ch, CURLOPT_HEADER, FALSE);
                            curl_setopt($ch, CURLOPT_POST, TRUE);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

                            curl_exec($ch);
                            curl_close($ch);
                            ob_end_clean();

                            $message = 'Bien hecho, dedicatoria respondida exitosamente';
                            $response = array('state' => 'success', 'message' => $message, 'code' => 200);
                            return response()->json($response);
                        }else{
                            $message = 'Ups.. presentamos problemas, ya lo estamos resolviendo pedimos disculpa contacte a soporte';
                            $response = array('state' => 'error', 'message' => $message, 'code' => 400);
                            return response()->json($response);
                        }
                    }else{
                        $message = 'Ups... Hubo un error, ya estamos trabajando para resolverlo, si el error persiste contacte a soporte.';
                        $response = array('state' => 'error', 'message' => $message, 'code' => 400);
                        return response()->json($response);
                    }
                }else{
                    $message = 'Ups... Hubo un error, ya estamos trabajando para resolverlo, si el error persiste contacte a soporte.';
                    $response = array('state' => 'error', 'message' => $message, 'code' => 400);
                    return response()->json($response);
                }
            }else{
                $message = 'Ups... Hubo un error, ya estamos trabajando para resolverlo, si el error persiste contacte a soporte.';
                $response = array('state' => 'error', 'message' => $message, 'code' => 400);
                return response()->json($response);
            }
        }else{
            $message = 'Debe enviar los valores correctamente';
            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
            return response()->json($response);
        }
 

        /* $urlVideo = $request->urlVideo;
        $idDedicatoria = $request->idDedicatoria;
        $idArtista = $request->idArtista;

        if (!empty($urlVideo) && !empty($idDedicatoria) && !empty($idArtista)) {
            $dedicatoria = tbl_solicitudes_de_dedicatorias::where('ID', $idDedicatoria)->where('ID_ARTISTA', $idArtista)->first();
            if (!empty($dedicatoria)) {
                $dedicatoria->URL_VIDEO = $urlVideo;
                $dedicatoria->ID_ESTADO = 14;
                if ($dedicatoria->save()) {
                    $message = 'Bien hecho, dedicatoria respondida exitosamente';
                    $response = array('state' => 'success', 'message' => $message, 'code' => 200);
                    return response()->json($response);
                }else{
                    $message = 'Ups.. presentamos problemas, ya lo estamos resolviendo pedimos disculpa contacte a soporte';
                    $response = array('state' => 'error', 'message' => $message, 'code' => 400);
                    return response()->json($response);
                }
            }else{
                $message = 'Dedicatoria no encontrada, intente mas tarde';
                $response = array('state' => 'error', 'message' => $message, 'code' => 400);
                return response()->json($response);
            }
        }else{
            $message = 'Debe enviar los valores correctamente';
            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
            return response()->json($response);
        } */

    }

    public function historial(Request $request)
    {
        $idArtista = $request->idArtista;
        if (!empty($idArtista)) {
            $dedicatorias = tbl_solicitudes_de_dedicatorias::where('ID_ARTISTA', $idArtista)
                ->where('ID_ESTADO', 15)->where('VISIBLE_ART', '<>', 0)->get();

            if (count($dedicatorias) <> 0) {
                $message = 'Lista de dedicatorias';
                $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $dedicatorias);
                return response()->json($response);
            }else{
                $message = 'Aun no tiene dedicatorias pendientes';
                $response = array('state' => 'success', 'message' => $message, 'code' => 200);
                return response()->json($response);
            }
        }else{
            $message = 'Debe enviar el idArtista';
            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
            return response()->json($response);
        }
    }

    public function ocultarHistorial(Request $request)
    {
        $idDedicatoria = $request->idDedicatoria;

        $data = tbl_solicitudes_de_dedicatorias::where('ID', $idDedicatoria)->first();

        if (!empty($data)) {
            $data->VISIBLE_ART = 0;
            $data->update();
            $message = 'Historial actualizado';
            $response = array('state' => 'success', 'message' => $message, 'code' => 200);
            return response()->json($response);
        }else{
            $message = 'Ups.. Hubo un error';
            $response = array('state' => 'success', 'message' => $message, 'code' => 300);
            return response()->json($response);
        }
        
    }
}
