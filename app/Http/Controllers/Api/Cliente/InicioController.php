<?php

namespace App\Http\Controllers\Api\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\tbl_parametros;
use App\User;
use DB;

class InicioController extends Controller
{
    /* 
    Codigo de errores
    200 : Ok,
    300 : Vacio,
    400 : No encontrado 
    */

    public function listGeneros()
    {
        $generos = tbl_parametros::where('ID_VALOR', '1')
            ->where('ID','<>',60)->get();
        if (!empty($generos)) {
            $message = 'Lista de generos';
            $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $generos);
            return response()->json($response);
        }else{
            $message = 'Ups... Hubo un error, ya estamos trabajando para resolverlo, si el error persiste contacte a soporte.';
            $response = array('state' => 'error', 'message' => $message, 'code' => 400);
            return response()->json($response);
        }
    }

    public function listGenerosCele()
    {
        $generos = tbl_parametros::where('ID_VALOR', '14')->get();
        if (!empty($generos)) {
            $message = 'Lista de generos Celebridades';
            $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $generos);
            return response()->json($response);
        }else{
            $message = 'Ups... Hubo un error, ya estamos trabajando para resolverlo, si el error persiste contacte a soporte.';
            $response = array('state' => 'error', 'message' => $message, 'code' => 400);
            return response()->json($response);
        }
    }

    public function listArtista()
    {
        $artistas = DB::table('categorias_generos')->get();
        if (!empty($artistas)) {
            $listArtista = array();
            $listCelebridades = array();
            foreach ($artistas as $key) {
                if ($key->id_valor == 1) {
                    $listArtista[] = $key;
                }else{
                    $listCelebridades[] = $key;
                }
            }
            $message = 'Lista de artista';
            $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $listArtista, 'listCelebrida' => $listCelebridades);
            return response()->json($response);
        }else{
            $message = 'Ups... Hubo un error, ya estamos trabajando para resolverlo, si el error persiste contacte a soporte.';
            $response = array('state' => 'error', 'message' => $message, 'code' => 400);
            return response()->json($response);
        }
    }

    public function artistaXgeneros(Request $request)
    {
        $idGenero = $request->idGenero;
        if (!empty($idGenero)) {

            $dataArtista = User::where('id_genero', $idGenero)->get();
            if (count($dataArtista) <> 0) {
                $message = 'Lista de artista';
                $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $dataArtista);
                return response()->json($response);
            }else{
                $message = 'En estos momentos no hay artista en esta categoria';
                $response = array('state' => 'success', 'message' => $message, 'code' => 400);
                return response()->json($response);
            }
        }else{
            $message = 'Debe enviar los valores correctamente';
            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
            return response()->json($response);
        }
    }

    public function search(Request $request)
    {
        $search = $request->search;
        if (!empty($search)) {
            $artistas = User::where('id_perfil', '1')
                ->where('name', 'like', '%' . $search . '%')->get();
            if (count($artistas) <> 0) {
                return $artistas;
            }else{
                $message = 'no hubo resultados con esa búsqueda';
                $response = array('state' => 'success', 'message' => $message, 'code' => 400);
                return response()->json($response);
            }
        }else{
            $message = 'Debe enviar los valores correctamente';
            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
            return response()->json($response);
        }
    }
}
