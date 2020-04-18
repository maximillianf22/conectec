<?php

namespace App\Http\Controllers\Api\Artista;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\tbl_movimientos;
use App\tbl_parametros;
use App\tbl_billeteras;

class MovimientosController extends Controller
{
    /* 
    Codigo de errores
    200 : Ok,
    300 : Vacio,
    400 : No encontrado 
    */

    public function listMov(Request $request)
    {
        $idArtista = $request->idArtista;
        if (!empty($idArtista)) {
            $movimientos = tbl_movimientos::where('ID_ARTISTA', $idArtista)->orderBy('ID', 'DESC')->get();
            if (!empty($movimientos)) {
                $data = array();
                foreach ($movimientos as $list) {
                    $tipo = tbl_parametros::where('ID',$list->ID_TIPO)->first();
                    $tipoEstado = tbl_parametros::where('ID',$list->ID_ESTADO)->first();
                    $list->tipoMov = $tipo->NOMBRE;
                    $list->estado = $tipoEstado->NOMBRE;
                    $data[] = $list;
                }
                $saldo = tbl_billeteras::where('ID_USER', $idArtista)->first(['SALDO','SALDO_TOTAL']);
                if (!empty($saldo)) {
                    $message = 'Bien hecho';
                    $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $data, 'saldo' => $saldo);
                    return response()->json($response);
                }else{
                    $message = 'Aun no tienes saldo';
                    $response = array('state' => 'error', 'message' => $message, 'code' => 400);
                    return response()->json($response);
                }
            }else{
                $message = 'Aun no tiene movimientos';
                $response = array('state' => 'success', 'message' => $message, 'code' => 200);
                return response()->json($response);
            }
        }else{
            $message = 'Debe enviar los datos correctos';
            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
            return response()->json($response);
        }
    }
}
