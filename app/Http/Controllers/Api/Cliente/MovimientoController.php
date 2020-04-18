<?php

namespace App\Http\Controllers\Api\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\tbl_movimientos;
use App\User;
use App\tbl_billeteras;

class MovimientoController extends Controller
{
    /* 
    Codigo de errores
    200 : Ok,
    300 : Vacio,
    400 : No encontrado 
    */

    public function listMovimiento(Request $request)
    {
        $idCliente = $request->idCliente;
        if (!empty($idCliente)) {
            $movimientos = tbl_movimientos::where('ID_CLIENTE', $idCliente)->where('VISIBLE', 1)->get();
            if (count($movimientos) <> 0) {

                foreach ($movimientos as $key => $listMOV) {
                    $idArtista = $listMOV->ID_ARTISTA;
                    $dataArt = User::where('id', $idArtista)->first();
                    $listMOV->dataART = $dataArt;
                }

                $message = 'Lista de movimientos';
                $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $movimientos);
                return response()->json($response);
            }else{
                $message = 'Aun no tienes movimientos';
                $response = array('state' => 'error', 'message' => $message, 'code' => 400);
                return response()->json($response);
            }
        }else{
            $message = 'Debe enviar los valores correctamente';
            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
            return response()->json($response);
        }
    }

    public function saldo(Request $request)
    {
        $idCliente = $request->idCliente;
        
        if (!empty($idCliente)) {
            $saldo = tbl_billeteras::where('ID_USER', $idCliente)->first(['SALDO','SALDO_TOTAL']);
            if (!empty($saldo)) {
                $listDedicatorias = tbl_movimientos::where('ID_CLIENTE', $idCliente)
                ->where('ID_TIPO', 31)
                ->get();
                $countMov = count($listDedicatorias);
                $listContratacion = tbl_movimientos::where('ID_CLIENTE', $idCliente)
                    ->where('ID_TIPO', 32)
                    ->get();
                $countContratacion = count($listContratacion);                
                $saldo->dedicatorias = $countMov;
                $saldo->contratacion = $countContratacion;

                $message = 'Saldo Cliente';
                $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $saldo);
                return response()->json($response);
            }else{
                $message = 'Hubo un error ya estamos trabajando para resolverlo, si el error persiste por favor contacte a soporte';
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
