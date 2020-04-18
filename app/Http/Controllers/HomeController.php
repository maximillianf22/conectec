<?php

namespace App\Http\Controllers;

use App\tbl_billeteras;
use App\tbl_configuraciones_artistas;
use App\tbl_movimientos;
use App\tbl_parametros;
use App\tbl_solicitudes_de_contratacion;
use App\tbl_solicitudes_de_dedicatorias;
use App\User,App\tbl_slide;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use DB;
use Redirect;
use Session;
use App\tbl_evento,App\tbl_listado_genero;
use App\tbl_genero, App\artistas_celebridade;

class HomeController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index(){
        //-- Celebridades
       

        $Generos_ = tbl_genero::where('idState',1)->get();

        $titulos = tbl_parametros::where('ID_VALOR','11')->get();
        $redesSociales = tbl_parametros::where('ID_VALOR','12')->get();

        $precio = tbl_parametros::findOrFail(61);

        return view('default.index')->with([
            "redesSociales" => $redesSociales,
            "Genero"=> $Generos_,
        ]);

    }

    public function music(){
        //-- Musica 
        $Artistasfilter = artistas_celebridade::get()->take(8);
        $Artistas = artistas_celebridade::get();
       // return $Artistas;
        $Generos_ = tbl_genero::where('idState',1)->get();
        $Slider_ = tbl_slide::where('idState',1)->get();
        $titulos = tbl_parametros::where('ID_VALOR','11')->get();
        $redesSociales = tbl_parametros::where('ID_VALOR','12')->get();
        $precio = tbl_parametros::findOrFail(61);
        return view('default.musica',compact('Generos_','Slider_','redesSociales','Artistas','Artistasfilter'));
    }

    public function explorer(){
        //-- Musica
        $events_ = tbl_evento::where('idState',1)->get();
        $redesSociales = tbl_parametros::where('ID_VALOR','12')->get();
        return view('default.explorar.index')->with([
            "eventos"=> $events_,
            "redesSociales" => $redesSociales,
        ]);
    }

    public function videoConverter(){
        return view('default.videos.convertidor');
    }

    public function favorites(){  
        
        $Artistas = artistas_celebridade::orderBy('name','Asc')->get()->random(4);
        $Listado_generos_ = tbl_listado_genero::where('idState',1)->get();
        $TopFive = artistas_celebridade::where('dedicatorias','>',0)->orderBy('dedicatorias','DESC')->get()->take(5);
        $titulos = tbl_parametros::where('ID_VALOR','11')->get();
        $redesSociales = tbl_parametros::where('ID_VALOR','12')->get();
        $precio = tbl_parametros::findOrFail(61);
        return view('default.top.index')->with([
            "listado_genero" => $Listado_generos_,
            "Artistas" => $Artistas,
            "titulos" => $titulos,
            "redesSociales" => $redesSociales,
            "precio" => $precio,
            "TopFive"=> $TopFive,
        ]);
    }
    
    public function filtroGenero(Request $request){
        if(!empty($request->nameGenero_)){
            $Artistas = artistas_celebridade::where('id_genero',$request->nameGenero_)
            ->where('nombre_artistico', 'LIKE', '%'.$request->nombreArtista.'%')
            ->orderBy('nombre_artistico',$request->orderBy_)->get();
        }else{
            $Artistas = artistas_celebridade::where('nombre_artistico', 'LIKE', '%'.$request->nombreArtista.'%')
            ->orderBy('nombre_artistico',$request->orderBy_)->get(); 
        }
        

        return view('default.top.filterSearch')->with([
            "Artistas" => $Artistas
        ]);
    }

    public function generos($idGenero_){
        $Artistasfilter = artistas_celebridade::where('id_Genero',$idGenero_)->get();
        $Artistas = artistas_celebridade::get();
        $Slider_ = tbl_slide::where('idState',1)->get();
        $Generos_ = tbl_genero::where('idState',1)->get();
        $NameGenero_= tbl_genero::where('idState',1)->where('idparametro',$idGenero_)->first(['nombreGenero']);
        $titulos = tbl_parametros::where('ID_VALOR','11')->get();
        $redesSociales = tbl_parametros::where('ID_VALOR','12')->get();
        $precio = tbl_parametros::findOrFail(61);
        return view('default.generos.filterGenero',compact('Generos_','Slider_','NameGenero_','redesSociales','Artistas','Artistasfilter'));
    }

    public function profile($name){
        //-- Musica 
        $Profile = artistas_celebridade::where('nombre_artistico',$name)->first();
        if(!empty($Profile)){
            $details = tbl_configuraciones_artistas::where('ID_ARTISTA', $Profile->id)->first();
            $events_ = tbl_evento::where('idState',1)->get();

            $titulos = tbl_parametros::where('ID_VALOR','11')->get();
            $redesSociales = tbl_parametros::where('ID_VALOR','12')->get();
            $precio = tbl_parametros::findOrFail(61);
            return view('default.artist_profile.index')->with([
                "Profile" => $Profile,
                "eventos"=> $events_,
                "titulos" => $titulos,
                "redesSociales" => $redesSociales,
                "precio" => $precio,
                "details" => $details
            ]);
        }else{
            return back();
        }
    }
    
    public function profile_campaigns($name){
        //-- Musica 
        $Profile = artistas_celebridade::where('nombre_artistico',$name)->first();
        if(!empty($Profile)){
            $titulos = tbl_parametros::where('ID_VALOR','11')->get();
            $redesSociales = tbl_parametros::where('ID_VALOR','12')->get();
            $precio = tbl_parametros::findOrFail(61);
            return view('default.artist_profile.campaigns')->with([
                "Profile" => $Profile,
                "titulos" => $titulos,
                "redesSociales" => $redesSociales,
                "precio" => $precio,
            ]);
        }else{
            return back();
        }
    }

    public function welcome(Request $request){
        if ($request) {
            $query = trim($request->get('query'));

            //$genero = trim($request->get('genero'));

            //Artistas para ti
            $artistas = artistas_celebridade::where('nombre_artistico', 'LIKE', '%' .$query. '%')
                ->orderBy('name','ASC')
                ->take(4)
                ->get();

            //Generos
            $generos = tbl_parametros::where('ID_VALOR', '1')
                ->where('ID','<>',60)
                ->get();
            $generoscelebridades = tbl_parametros::where('ID_VALOR', '14')
                ->where('ID','<>',60)
                ->get();
            
            $artistasGeneros = User::where('id_perfil', '1')
                ->where('name', 'like', '%' . $query . '%')
                ->where('id_genero', $generos->first()->ID)
                ->take(8)
                ->get();

            //Celebridades
            $tipocelebridad = tbl_parametros::where('ID_VALOR', '14')
            ->where('ID','<>',60)
            ->get();
            // dd($tipocelebridad);

            $celebridades = artistas_celebridade::where('nombre_artistico', 'LIKE', '%' .$query. '%')
                ->orderBy('name','ASC')
                ->take(4)
                ->get();
                

            if (Auth::user()) {
                $user = User::findOrFail(Auth::user()->id);
                $user->tipoUsuario;
                $user->billetera;
            } else {
                $user = "";
            }
        }

        $precio = tbl_parametros::findOrFail(61);

        return view('default.welcome')->with([
            "artistas" => $artistas,
            "generos" => $generos,
            "generoscelebridades" => $generoscelebridades,
            "celebridades" => $celebridades,
            "tipocelebridad"=> $tipocelebridad,
            "query" => $query,
            "artistasGeneros" => $artistasGeneros,
            "user" => $user,
            "precio" => $precio,
            "welcome" => "welcome",
        ]);

    }

    public function artista($name){
        //Informaciòn del artista
        $Profile = artistas_celebridade::where('nombre_artistico',$name)->first();
        $artista = User::where('id', $Profile->id)->first();
        $artista->configuraciones;
        $artista->posts;
        $artista->peticiones;
        if (Auth::user()) {
            $user = User::findOrFail(Auth::user()->id);
            $user->tipoUsuario;
            $user->billetera;
        } else {
            $user = "";
        }
        $redesSociales = tbl_parametros::where('ID_VALOR','12')->get();
        $precio = tbl_parametros::findOrFail(61);
        return view('default.artista')->with([
            "perfil" => $Profile ,
            "artista" => $artista,
            "user" => $user,
            "redesSociales" => $redesSociales,
            "precio" => $precio,
        ]);

        return view('default.artista');
    }

    public function profile_dedication($name){
        //-- Musica 
        $Profile = artistas_celebridade::where('nombre_artistico',$name)->first();
        $titulos = tbl_parametros::where('ID_VALOR','11')->get();
        $redesSociales = tbl_parametros::where('ID_VALOR','12')->get();
        $precio = tbl_parametros::findOrFail(61);
        return view('default.artist_profile.dedication')->with([
            "Profile" => $Profile,
            "titulos" => $titulos,
            "redesSociales" => $redesSociales,
            "precio" => $precio,
        ]);
    }


    public function pedirDedicatoria(Request $request){

        $this->validate($request, [
            'ID_ARTISTA' => 'required',
            'DE_PARTE_DE' => 'required',
            'DIRIGIDO_A' => 'required',
            'MENSAJE' => 'required',
        ], [
            'ID_ARTISTA.required' => 'Verifique la información ingresada e intente nuevamente',
            'DE_PARTE_DE.required' => 'El campo de parte de es obligatorio',
            'DIRIGIDO_A.required' => 'El campo dirigido a es obligatorio',
            'MENSAJE.required' => 'El campo mensaje es obligatorio',
        ]);

        if ((int) $request->ID_ARTISTA === Auth::user()->id) {
            Session::flash('message_error', 'Lo sentimos, pero no se puede auto enviar una dedicatoria');
            return redirect::to('artista/' . $request->nombre_artistico);
        }

        /*
            $dedicatorias = tbl_solicitudes_de_dedicatorias::where('ID_CLIENTE', Auth::user()->id)
            ->whereIn('ID_ESTADO', [12, 13])
            ->get();
        */
        $dedicatorias = tbl_solicitudes_de_dedicatorias::where('ID_CLIENTE', Auth::user()->id)
        ->where('ID_ARTISTA',$request->ID_ARTISTA)
        ->whereIn('ID_ESTADO', [12, 13])
        ->get();


        //Información del artista
        $artista = User::findOrFail($request->ID_ARTISTA);

        if (count($dedicatorias) > 0) {
            Session::flash('message_error', 'Actualmete tienes una solicitud de dedicatoria en proceso');
            return redirect::to('artista/' . $artista->nombre_artistico);
        }

        //Conocer el costo que tiene una dedicatoria
        $configArtista = tbl_configuraciones_artistas::where('ID_ARTISTA', $request->ID_ARTISTA)->get();
        $configArtista = $configArtista->first();

        //Billetera del artista
        $billeteraArtista = tbl_billeteras::where('ID_USER', $artista->id)->get();
        $billeteraArtista = $billeteraArtista->first();
        

        //Billetera del administrador
        $billeteraAdmin = tbl_billeteras::where('ID_USER', 1)->get();
        $billeteraAdmin = $billeteraAdmin->first();

        //Conocer cuanto tiene el cliente en la billetera
        $billetera = tbl_billeteras::where('ID_USER', Auth::user()->id)->get();
        $billetera = $billetera->first();

        //validamos si cliente tiene suficiente dinero para pagar la licitacion
        if ($billetera->SALDO >= $configArtista->PRECIO_DEDICATORIA) {

            //Registramos la movimiento
            $movimiento                        = new tbl_movimientos();
            $movimiento->ID_ARTISTA            = $request->ID_ARTISTA;
            $movimiento->ID_CLIENTE            = Auth::user()->id;
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
            $dedicatoria->ID_ARTISTA        = $request->ID_ARTISTA;
            $dedicatoria->ID_CLIENTE        = Auth::user()->id;
            $dedicatoria->ID_ESTADO         = 13;
            $dedicatoria->DE_PARTE_DE       = $request->DE_PARTE_DE;
            $dedicatoria->DIRIGIDO_A        = $request->DIRIGIDO_A;
            $dedicatoria->MENSAJE           = $request->MENSAJE;
            $dedicatoria->COSTO_DEDICATORIA = $configArtista->PRECIO_DEDICATORIA;
            $dedicatoria->ID_MOVIMIENTO     = $movimiento->ID;
            $dedicatoria->save();

            //Actulizamos la billetera
            $billetera        = tbl_billeteras::findOrFail($billetera->ID);
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
            $data['nameCliente'] = Auth::user()->name;
            $data['msg'] = $request->MENSAJE;
            $data['email'] = $artista->email;

            Mail::send('mail.dedicatoria', ['data' => $data, 'msg' => $msg->first()], function ($mail) use ($data) {
                $mail->subject('Nueva solicitud de dedicatoria');
                $mail->to($data['email'], $data['nameArtista']);
            });

            //Creamos la notificacion Push App
            $externalUserIds = $artista->NOTIFICATION_TOKEN;
            $heading = array("en" => "Conecte Artisa");
            $content = array("en" => "Tienes una nueva solicitud");
            $data = array("type" => "1", "data" => $dedicatoria);
            $fields = array(
              'app_id' => '57065a04-a63b-4563-be64-8b9f2cf2a268',
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

            /*=======================================================================*/

            Session::flash('message', 'Solicitud enviada satisfactoriamente, una vez respodida se notificara por correo electronico');
            return redirect::to('artista/' . $artista->nombre_artistico);

        } else {
            Session::flash('message_error', 'No hemos podido enviar tu solicitud ya que no cuentas con fondos suficientes');
            return redirect::to('artista/' . $artista->nombre_artistico);
        }

    }

    public function solicitarContratacion(Request $request)
    {
        /*
        $this->validate($request, [
            'ID_ARTISTA' => 'required',
            'CIUDAD' => 'required|string',
            'PAIS' => 'required|string',
            'DIRECCION' => 'required|string',
            'NAME' => 'required|string',
            'TELEFONO' => 'required|integer',
            'DESDE' => 'required|date',
            'HASTA' => 'required|date',
            'HORA' => 'required',
        ], [
            'ID_ARTISTA.required' => 'Verifique la información ingresada e intente nuevamente',
            'CIUDAD.required' => 'Verifique los campos ingresados e intente nuevamente',
            'PAIS.required' => 'Verifique los campos ingresados e intente nuevamente',
            'DIRECCION.required' => 'Verifique los campos ingresados e intente nuevamente',
            'NAME.required' => 'Verifique los campos ingresados e intente nuevamente',
            'TELEFONO.required' => 'Verifique los campos ingresados e intente nuevamente',
            'DESDE.required' => 'Verifique los campos ingresados e intente nuevamente',
            'HASTA.required' => 'Verifique los campos ingresados e intente nuevamente',
            'HORA.required' => 'Verifique los campos ingresados e intente nuevamente',
        ]);
        */
        $this->validate($request, [
            'ID_ARTISTA' => 'required',
            'NAME' => 'required|string',
            'TELEFONO' => 'required|integer',
            'email_contratante' => 'required|string',
            'MENSAJE' => 'required|string',
            'FECHA1' => 'required',
            'FECHA2' => 'required',
            'HORA' => 'required'
        ], [
            'ID_ARTISTA.required' => 'Verifique la información ingresada e intente nuevamente',
            'NAME.required' => 'Verifique los campos ingresados e intente nuevamente (Nombre y Apellidos)',
            'TELEFONO.required' => 'Verifique los campos ingresados e intente nuevamente (Telefono)',
            'email_contratante.required' => 'Verifique los campos ingresados e intente nuevamente (Email)',
            'MENSAJE.required' => 'Verifique los campos ingresados e intente nuevamente (Descripcion Mensaje)',
            'FECHA1.required' => 'Verifique los campos ingresados e intente nuevamente (Fechas)',
            'FECHA2.required' => 'Verifique los campos ingresados e intente nuevamente (Fechas)',
            'HORA.required' => 'Verifique los campos ingresados e intente nuevamente (Hora)',
        ]);

        if ((int) $request->ID_ARTISTA === Auth::user()->id) {
            Session::flash('message_error', 'Lo sentimos, pero no se puede auto contratar');
            return redirect::to('artista/' . $request->nombre_artistico);
        }

        $contratacion = tbl_solicitudes_de_contratacion::where('ID_CLIENTE', Auth::user()->id)
            ->where('ID_ARTISTA',$request->ID_ARTISTA)
            ->whereIn('ID_ESTADO', [33, 34, 35, 46, 47])
            ->get();

        if (count($contratacion) > 0) {
            Session::flash('message_error', 'Actualmente tiene una solicitud de contratación');
            return redirect::to('artista/' . $request->nombre_artistico);
        }

        $solicitud = new tbl_solicitudes_de_contratacion();
        $solicitud->ID_ARTISTA = $request->ID_ARTISTA;
        $solicitud->ID_CLIENTE = Auth::user()->id;
        $solicitud->ID_ESTADO = 33;
        $solicitud->CIUDAD = '';
        $solicitud->PAIS = '';
        $solicitud->DIRECCION = '';
        /*
            $solicitud->CIUDAD = $request->CIUDAD;
            $solicitud->PAIS = $request->PAIS;
            $solicitud->DIRECCION = $request->DIRECCION;
        */
        $solicitud->NOMBRES = $request->NAME;
        $solicitud->TELEFONO = $request->TELEFONO;
        $solicitud->EMAIL = $request->email_contratante;
        $solicitud->DESDE = '';
        $solicitud->HASTA = '';
        $solicitud->HORA = '';
        
        $solicitud->DESDE = $request->FECHA1;
        $solicitud->HASTA = $request->FECHA2;
        $solicitud->HORA = $request->HORA;
       
        $solicitud->MENSAJE = $request->MENSAJE;
        $solicitud->save();

        $artista = User::findOrFail($request->ID_ARTISTA);

        $msg = tbl_parametros::where('ID', '43')->get();

        $data['nameArtista'] = $artista->name;
        $data['nameCliente'] = Auth::user()->name;
        $data['msg'] = $request->MENSAJE;
        $data['email'] = $artista->email;

        Mail::send('mail.contratacion', ['data' => $data, 'msg' => $msg->first()], function ($mail) use ($data) {
            $mail->subject('Nueva solicitud de contratación');
            $mail->to($data['email'], $data['nameArtista']);
        });

        Session::flash('message', 'Solicitud enviada satisfactoriamente, una vez respodida se notificara por correo electronico');
        return redirect::to('artista/' . $artista->nombre_artistico);

    }

    public function listarArtitasGeneros(Request $request)
    {
        if ($request) {
            $query = trim($request->get('genero'));

            $artistas = User::where('id_perfil', '1')
                ->where('id_genero', $query)
                ->take(8)
                ->get();

            return $artistas;

        }
    }

    public function misMovimientos()
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->tipoUsuario;
        $user->billetera;

        if ($user->id_perfil === 0) {
            $movimientos = tbl_movimientos::where('ID_CLIENTE', Auth::user()->id)
                ->orderBy('ID', 'DESC')
                ->paginate(15);
        } else if ($user->id_perfil === 1) {
            $movimientos = tbl_movimientos::where('ID_ARTISTA', Auth::user()->id)
                ->orderBy('ID', 'DESC')
                ->paginate(15);
               
        }

        $movimientos->each(function ($movimientos) {
            $movimientos->tipoMovimiento;
        });

        $precio = tbl_parametros::findOrFail(61);

        return view('default.misMovimientos')->with([
            "user" => $user,
            "movimientos" => $movimientos,
            "precio" => $precio,
            "misMovimientos" => "misMovimientos",
        ]);
    }

    public function perfil()
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->tipoUsuario;
        $user->billetera;
        $user->peticiones;
        $user->contrataciones;
        $user->posts;
        $user->configuraciones;

        $balance = 0;
        $generos = 0;

        $precio = tbl_parametros::findOrFail(61);

        if ($user->id_perfil === 0) {

            $movimientos = tbl_movimientos::where('ID_CLIENTE', Auth::user()->id)
                ->where('ID_ESTADO', 42)
                ->get();

            $totalDisponibles = 0;//$user->billetera()->first()->SALDO;

        } else if ($user->id_perfil === 1) {

            $movimientos = tbl_movimientos::where('ID_ARTISTA', Auth::user()->id)
                ->orderBy('ID','Desc')
                ->take(7)
                ->get();

            $movimientosBalance = tbl_movimientos::where('ID_ARTISTA', Auth::user()->id)
                ->where('ID_ESTADO', 42)
                ->where('ID_TIPO', 39)
                ->get();

            foreach ($movimientosBalance as $item) {
                $balance += $item->COSTO_TOTAL;
            }

            $totalDisponibles = 0;
            $balance = $totalDisponibles - $balance;
            $generos = tbl_parametros::where('ID_VALOR', 1)->get();
            
        }
        if ($user->id_perfil === 2) {
            $movimientos = tbl_movimientos::where('ID_CLIENTE', Auth::user()->id)
                ->where('ID_ESTADO', 42)
                ->get();

            $totalDisponibles = $user->billetera()->first()->SALDO;
        }
        $movimientos->each(function ($movimientos) {
            $movimientos->tipoMovimiento;
            $movimientos->userArtista;
            $movimientos->userCliente;
            $movimientos->estado;
        });


        return view('default.perfil')->with([
            "user" => $user,
            "movimientos" => $movimientos,
            "totalDisponibles" => $totalDisponibles,
            "balance" => $balance,
            "generos" => $generos,
            "precio" => $precio,
            "miPerfil" => "miPerfil",
        ]);
    }

    public function actulizarCliente(Request $request)
    {

        $this->validate($request, [
            'TIPO' => 'required',
        ]);

        if ($request->TIPO === '1') {
            $this->validate($request, [
                'NAME' => 'required',
                'FOTO_PERFIL' => 'image|mimes:jpeg,png,jpg,svg',
            ], [
                'name.required' => 'El nombre es requerido',
                'ESTADO.required' => 'El estado es requerido'
            ]);

            $user = User::findOrFail(Auth::user()->id);
            $user->name = $request->NAME;
                        
            if ($request->hasFile('FOTO_PERFIL')) {
                $file = Input::file('FOTO_PERFIL');
                $name = Auth::user()->id . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/assets/img/clientes/', $name);
                $user->foto_perfil = $name;
            }
            $user->update();

        }elseif ($request->TIPO === '2') {
            $this->validate($request, [
                'password' => 'required|min:6|confirmed',
            ], [
                'passwordConfirmation.same' => 'La contraseña no coinciden',
                'passwordConfirmation.required' => 'La contraseña no coinciden',
            ]);

            $user = User::findOrFail(Auth::user()->id);
            $user->password = bcrypt($request->password);
            $user->update();    
        }


        Session::flash('message', 'Información actualizada satisfactoriamente');
        return Redirect::back();

    }

    public function actulizarArtista(Request $request)
    {
        $this->validate($request, [
            'TIPO' => 'required',
        ]);

        if ($request->TIPO === '0') {

            $this->validate($request, [
                'NAME' => 'required',
                'GENERO' => 'required',
                'FOTO_PERFIL' => 'image|mimes:jpg,jpeg,png,jpg,svg',
                'FOTO_PORTADA' => 'image|mimes:jpg,jpeg,png,jpg,svg',
            ]);

            $user = User::findOrFail(Auth::user()->id);
            $user->name = $request->NAME;
            $user->nombre_artistico = $request->NAMEART;


            if ($request->hasFile('FOTO_PERFIL')) {
                $file = Input::file('FOTO_PERFIL');
                $imagen = getimagesize($file);
                $ancho = $imagen[0];
                $alto = $imagen[1];
                if ($ancho == 350 || $alto == 350) {
                    $name = $id . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . '/assets/img/artistas/', $name);
                    $user->foto_perfil = $name;
                }else{
                    Session::flash('message_error', 'La imagen debe ser de 350x350');
                    return Redirect::back();
                }
            }

            if ($request->hasFile('FOTO_PORTADA')) {
                $file = Input::file('FOTO_PORTADA');
                $imagen = getimagesize($file);
                $ancho = $imagen[0];
                $alto = $imagen[1];
                if ($ancho == 1440 || $alto == 600) {
                    $extencion = 'jpg';
                    $name = 'cover-'.$user->nombre_artistico.'.'.$extencion;
                    $file->move(public_path() . '/assets/img/artist_profile/', $name);
                    $user->cover_perfil = $name;
                }else{
                    Session::flash('message_error', 'La imagen debe ser de 1440x600');
                    return Redirect::back();
                }
            }

            $user->id_genero = $request->GENERO;
            $user->update();

        } elseif ($request->TIPO === '1') {

            $this->validate($request, [
                'PRECIO_DEDICATORIA' => 'required',
                'ACEPTO_SOLICITUDES_DE_DEDICATORIAS' => 'required',
                'ACEPTO_CONTRATOS' => 'required',
            ]);

            $configuracion = tbl_configuraciones_artistas::where('ID_ARTISTA', Auth::user()->id)->get();
            $configuracion = $configuracion->first();
            $configuracion->PRECIO_DEDICATORIA = $request->PRECIO_DEDICATORIA;
            $configuracion->ACEPTO_SOLICITUDES_DE_DEDICATORIAS = $request->ACEPTO_SOLICITUDES_DE_DEDICATORIAS;
            $configuracion->ACEPTO_CONTRATOS = $request->ACEPTO_CONTRATOS;
            $configuracion->update();

        } elseif ($request->TIPO === '2') {
            $this->validate($request, [
                'password' => 'required|min:6|confirmed',
            ], [
                'passwordConfirmation.same' => 'La contraseña no coinciden',
                'passwordConfirmation.required' => 'La contraseña no coinciden',
            ]);

            $user = User::findOrFail(Auth::user()->id);
            $user->password = bcrypt($request->password);
            $user->update();
        }

        Session::flash('message', 'Información actulizada satisfactoriamente');
        return Redirect::back();

    }

    public function verRespuesta($id)
    {

        $user = User::findOrFail(Auth::user()->id);
        $user->tipoUsuario;
        $user->billetera;

        $precio = tbl_parametros::findOrFail(61);

        $dedicatoria = tbl_solicitudes_de_dedicatorias::findOrFail($id);

        return view('default.verRespuesta')->with([
            "dedicatoria" => $dedicatoria,
            "precio" => $precio,
            "user" => $user,
        ]);
    }

    public function miHistorial()
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->tipoUsuario;
        $user->billetera;

        $precio = tbl_parametros::findOrFail(61);

        if ($user->id_perfil == 0) {
            
            $historialDeDedicatorias = tbl_solicitudes_de_dedicatorias::where('ID_CLIENTE', Auth::user()->id)
                ->whereIn('ID_ESTADO', [14, 15, 16])
                ->get();

            $historialDeDedicatorias->each(function ($historialDeDedicatorias) {
                $historialDeDedicatorias->artista;
            });

            $historialDeContratacion = tbl_solicitudes_de_contratacion::where('ID_CLIENTE', Auth::user()->id)
                ->whereIn('ID_ESTADO', [48, 49])
                ->get();

            $historialDeContratacion->each(function ($historialDeContratacion) {
                $historialDeContratacion->artista;
                $historialDeContratacion->estado;
                $historialDeContratacion->estado;
            });
        } elseif ($user->id_perfil == 1) {  
            $historialDeDedicatorias = tbl_solicitudes_de_dedicatorias::where('ID_ARTISTA', Auth::user()->id)
                ->whereIn('ID_ESTADO', [14, 15, 16])
                ->get();

            $historialDeDedicatorias->each(function ($historialDeDedicatorias) {
                $historialDeDedicatorias->artista;
                $historialDeDedicatorias->cliente;

            });

            $historialDeContratacion = tbl_solicitudes_de_contratacion::where('ID_ARTISTA', Auth::user()->id)
                ->whereIn('ID_ESTADO', [48, 49])
                ->get();

            $historialDeContratacion->each(function ($historialDeContratacion) {
                $historialDeContratacion->artista;
                $historialDeContratacion->cliente;
                $historialDeContratacion->estado;
            });
        }


        return view('default.miHistorial')->with([
            "historialDeDedicatorias" => $historialDeDedicatorias,
            "historialDeContratacion" => $historialDeContratacion,
            "user" => $user,
            "precio" => $precio,
            "miHistorial" => "miHistorial",
        ]);
    }

    public function misPedientes()
    {

        $user = User::findOrFail(Auth::user()->id);
        $user->tipoUsuario;
        $user->billetera;


        $precio = tbl_parametros::findOrFail(61);

        if ($user->id_perfil == 0) {
            $historialDeDedicatorias = tbl_solicitudes_de_dedicatorias::where('ID_CLIENTE', Auth::user()->id)
                ->whereIn('ID_ESTADO', [12, 13, 51])
                ->get();

            $historialDeDedicatorias->each(function ($historialDeDedicatorias) {
                $historialDeDedicatorias->artista;
            });

            $historialDeContratacion = tbl_solicitudes_de_contratacion::where('ID_CLIENTE', Auth::user()->id)
                ->whereIn('ID_ESTADO', [33, 34, 35, 46, 47])
                ->get();

            $historialDeContratacion->each(function ($historialDeContratacion) {
                $historialDeContratacion->artista;
                $historialDeContratacion->estado;
                $historialDeContratacion->estado;
            });

        } elseif ($user->id_perfil == 1) {
            $historialDeDedicatorias = tbl_solicitudes_de_dedicatorias::where('ID_ARTISTA', Auth::user()->id)
                ->where('ID_ESTADO', '13')
                ->get();

            $historialDeDedicatorias->each(function ($historialDeDedicatorias) {
                $historialDeDedicatorias->artista;
                $historialDeDedicatorias->cliente;

            });

            $historialDeContratacion = tbl_solicitudes_de_contratacion::where('ID_ARTISTA', Auth::user()->id)
                ->whereIn('ID_ESTADO', [33, 34, 35, 46, 47])
                ->get();

            $historialDeContratacion->each(function ($historialDeContratacion) {
                $historialDeContratacion->artista;
                $historialDeContratacion->cliente;
                $historialDeContratacion->estado;
            });
        }

        return view('default.misPendientes')->with([
            "historialDeDedicatorias" => $historialDeDedicatorias,
            "historialDeContratacion" => $historialDeContratacion,
            "user" => $user,
            "precio" => $precio,
            "misPendientes" => "misPendientes",
        ]);
    }
}
