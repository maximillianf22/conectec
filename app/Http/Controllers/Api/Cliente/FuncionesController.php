<?php

namespace App\Http\Controllers\Api\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\tbl_movimientos;
use App\User;
use App\tbl_solicitudes_de_dedicatorias;
use App\tbl_solicitudes_de_contratacion;
use App\Pais;
use App\Departamento;
use App\Ciudad;

class FuncionesController extends Controller
{
    public function borrarHistorial(Request $request)
    {
        $tipo = $request->tipo;
        $ID = $request->ID;

        if ($tipo == 1) {
            //Dedicatoria
            $data = tbl_solicitudes_de_dedicatorias::where('ID', $ID)->first();
            $data->VISIBLE = 0;
            $data->update();
        }else{
            //CONTRATACIÓN
            $data = tbl_solicitudes_de_contratacion::where('ID', $ID)->first();
            $data->VISIBLE = 0;
            $data->update();
        }

        $message = 'Historial actualizado';
        $response = array('state' => 'success', 'message' => $message, 'code' => 200);
        return response()->json($response);
    }

    public function borrarMovimiento(Request $request)
    {
        $idMov = $request->idMov;

        $data = tbl_movimientos::where('ID', $idMov)->first();
        if (!empty($data)) {
            $data->VISIBLE = 0;
            $data->update();
        }

        $message = 'Movimientos actualizados';
        $response = array('state' => 'success', 'message' => $message, 'code' => 200);
        return response()->json($response);
    }

    public function actualizarFoto(Request $request){
        $idCliente = $request->idCliente;

        $dataUser = User::where('id', $idCliente)->first();

        if (!empty($dataUser)) {
            $message = 'Actualizando';
            $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $dataUser);
            return response()->json($response);
        }else{
            $message = 'Usuario no encotrado';
            $response = array('state' => 'error', 'message' => $message, 'code' => 400);
            return response()->json($response);
        }
    }

    public function updateImagen(Request $request)
    {
        
        $idCliente = $request->idCliente;
        $img = $request->file('imagen'); 

        $dataUser = User::where('id',$idCliente)->first();

        if (!empty($dataUser)) {
            $nombreIMG = $img->getClientOriginalName();
            $img->move(public_path() . '/assets/img/clientes/', $nombreIMG);
            $dataUser->foto_perfil = $nombreIMG;
            $dataUser->update();

            $message = 'Imagen actualizando';
            $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $dataUser);
            return response()->json($response);
        }else{
            $message = 'Usuario no encotrado';
            $response = array('state' => 'error', 'message' => $message, 'code' => 400);
            return response()->json($response);
        }
    }

    public function listaPais()
    {
        $pais = Pais::get();
        return $pais;
    }

    public function listaCiudad($idPais)
    {
        $dataDpm = Departamento::where('idPais', $idPais)->get(['idDepartamento']);
        $dataTotal = array();
        if (count($dataDpm) == 0) {
            $message = 'No hay ciudad';
            $response = array('state' => 'error', 'message' => $message, 'code' => 400);
            return response()->json($response);
        }else{
            foreach ($dataDpm as $key) {
                $idDepartamento = $key->idDepartamento;
                $dataCiudad = ciudad::where('idDepartamento', $idDepartamento)->first(['idCiudad', 'nombreCiudad']);
                $dataTotal[] = $dataCiudad;
            }
            $message = 'Lista ciudad';
            $response = array('state' => 'success', 'message' => $message, 'code' => 200, 'data' => $dataTotal);
            return response()->json($response);
        }
    }
}
