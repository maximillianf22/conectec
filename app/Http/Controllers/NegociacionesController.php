<?php

namespace App\Http\Controllers;

use App\tbl_negociacion_contratacion;
use App\tbl_solicitudes_de_contratacion;
use App\tbl_parametros;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Mail;
use Redirect;
use Session;

class NegociacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'ID_SOLICITUD_DE_CONTRATACION' => 'required',
            'message' => 'required',
        ], [
            'ID_SOLICITUD_DE_CONTRATACION.required' => 'Revice los datos ingresados',
            'message.required' => 'El mensaje es obligatorio',
        ]);

        $contratacion = tbl_solicitudes_de_contratacion::findOrFail($request->ID_SOLICITUD_DE_CONTRATACION);
        $artista = User::findOrFail($contratacion->ID_ARTISTA);
        $cliente = User::findOrFail($contratacion->ID_CLIENTE);
        $nombreArtista = $artista->name;

        $negociacion = new tbl_negociacion_contratacion();
        $negociacion->ID_SOLICITUD_DE_CONTRATACION = $request->ID_SOLICITUD_DE_CONTRATACION;
        $negociacion->ID_USER = Auth::user()->id;
        $negociacion->ID_ARTISTA = $contratacion->ID_ARTISTA;
        $negociacion->ID_CLIENTE = $contratacion->ID_CLIENTE;
        $negociacion->MENSAJE = $request->message;
        $negociacion->save();

        $user = User::findOrFail(Auth::user()->id);
        if($user->id_perfil === 1){
            $contratacion->ID_ESTADO = 35;
            $contratacion->update();
        }
        

        //Creamos la notificacion Push App Cliente
        $externalUserIds = $cliente->NOTIFICATION_TOKEN;
        $heading = array("en" => "Conecte");
        $content = array("en" => "$nombreArtista Tienes un mensaje nuevo");
        $data = array("type" => "2", "data" => $contratacion);
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

        Session::flash('message', 'Mensaje envido exitosamente');
        return Redirect::back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->tipoUsuario;
        $user->billetera;

        $contratacion = tbl_solicitudes_de_contratacion::findOrFail($id);
        $contratacion->formulario;

        $artista = User::findOrFail($contratacion->ID_ARTISTA);

        $negociacion = tbl_negociacion_contratacion::where('ID_SOLICITUD_DE_CONTRATACION', $id)->get();
        $negociacion->each(function ($negociacion) {
            $negociacion->publicadoPor;
            $negociacion->artista;
            $negociacion->cliente;            
        });

        $precio = tbl_parametros::findOrFail(61);


        return view('default.negociacion_contratacion.show')->with([
            "user"                    => $user,
            "artista"                 => $artista,
            "contratacion"            => $contratacion,
            "negociacion"             => $negociacion,
            "precio" => $precio
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
