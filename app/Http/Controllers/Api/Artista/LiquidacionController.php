<?php

namespace App\Http\Controllers\Api\Artista;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\tbl_movimientos;
use App\tbl_solicitudes_de_liquidacion;
use App\tbl_billeteras;
use Hash;

class LiquidacionController extends Controller
{
    /* 
    Codigo de errores
    200 : Ok,
    300 : Vacio,
    400 : No encontrado 
    */
    public function liquidar(Request $request)
    {
        $idArtista = $request->idArtista;
        $cantidad = $request->cantidad;
        $clave = $request->clave;
        if (!empty($idArtista) && !empty($cantidad) && !empty($clave) ) {
            $dataArtista = User::where('id',$idArtista)->where('id_perfil', 1)->first();
            if (!empty($dataArtista)) {
                if (Hash::check($clave, $dataArtista->password)){
                    try {

                        $balance = 0;
                        $retirosPendientes = tbl_movimientos::where('ID_ARTISTA', $idArtista)
                            ->where('ID_ESTADO', 42)
                            ->where('ID_TIPO', 39)
                            ->get();

                        foreach ($retirosPendientes as $item) {
                            $balance += $item->COSTO_TOTAL;
                        }

                        $billetera = tbl_billeteras::where('ID_USER', $idArtista)->get();

                        $totalDisponibles = $billetera->first()->SALDO;

                        $balance = $totalDisponibles - $balance;

                        if($balance < $cantidad){
                            $message = 'Hubo un error al momento de retirar, por favor si el error persiste contacte a soporte';
                            $response = array('state' => 'error', 'message' => $message, 'code' => 300);
                            return response()->json($response);
                        }

                        //Registramos la movimiento 
                        $movimiento = new tbl_movimientos();
                        $movimiento->ID_ARTISTA = $idArtista;
                        $movimiento->ID_CLIENTE = $idArtista;
                        $movimiento->ID_TIPO = 39;
                        $movimiento->ID_ESTADO = 42;
                        $movimiento->COSTO_TOTAL = $cantidad;
                        $movimiento->PORCENTAJE_PLATAFORMA = '0';
                        $movimiento->COMICION_PLATAFORMA = '0';
                        $movimiento->PORCENTAJE_ARTISTA = '0';
                        $movimiento->COMICION_ARTISTA = '0';
                        $movimiento->save();
    
                        $liquidacion = new tbl_solicitudes_de_liquidacion;
                        $liquidacion->ID_ARTISTA = $idArtista;
                        $liquidacion->CANTIDAD = $cantidad;
                        $liquidacion->ID_MOVIMIENTO = $movimiento->ID;
                        $liquidacion->ID_ESTADO = 42;
                        $liquidacion->save();
    
                        $message = 'Retiro exitoso, por favor espere que el administrador acepte su solicitud de retiro, se le confirmara por correo.';
                        $response = array('state' => 'success', 'message' => $message, 'code' => 200);
                        return response()->json($response);
    
                    } catch (\PDOException $e) {
                        $message = 'Hubo un error al momento de retirar, por favor si el error persiste contacte a soporte';
                        $response = array('state' => 'error', 'message' => $message, 'code' => 300);
                        return response()->json($response);
                    }
                }else{
                    $message = 'Contraseña incorrecta, por favor digita bien tu contraseña y vuelve a intentarlo';
                    $response = array('state' => 'error', 'message' => $message, 'code' => 300);
                    return response()->json($response);
                }
            }else{
                $message = 'Este usuario no se encuentra en nuestra base de datos o no es un artista.';
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
