<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Mail;
use App\tbl_movimientos;
use App\tbl_parametros;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\tbl_configuraciones_artistas;

class ArtistasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $user = User::findOrFail(Auth::user()->id);
        $user->tipoUsuario;
        $user->billetera;
		

		if ($request) {

			$query = trim($request->get('query'));

			$users = User::where("id_perfil", "1")
				->where('name', 'like', '%' . $query . '%')
				->paginate(15);

				$users->each(function ($users) {
					$users->estado;
				});
		

		}

		return view('administracion.artistas.index')->with([
			"users" => $users,
			"user"  => $user,
			"artistas" => "artistas",
		]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail(Auth::user()->id);
        
        $user->tipoUsuario;
		$user->billetera;
		
		$artista = User::findOrFail($id);
        $user->tipoUsuario;
        $user->billetera;
        $user->peticiones;
        $user->contrataciones;
        $user->posts;
        $user->configuraciones;

        $movimientos = tbl_movimientos::where('ID_ARTISTA', $id)
            ->orderBy('created_at', 'DESC')
			->paginate(7);

		$estados = tbl_parametros::where('ID_VALOR','2')
            ->pluck('NOMBRE', 'ID');
            
        $generos = tbl_parametros::wherein('ID_VALOR',['1','14'])
            ->orderby('ID_VALOR')
            ->get();
            
        $siNo = tbl_parametros::where('ID_VALOR','5')
			->pluck('NOMBRE', 'ID');


		return view('administracion.artistas.edit')->with([
			"user"	  => $user,
			"movimientos" => $movimientos,
			"artista" => $artista,
			"generos" => $generos,
			"estados" => $estados,
			"siNo"    => $siNo,
			"artistas" => "artistas",			
		]);
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
        $this->validate($request, [
            'TIPO' => 'required',
        ]);
        
        if ($request->TIPO === '0') {
            $this->validate($request, [
                'NAME' => 'required',
                'NAMEART' => 'required',
                'GENERO' => 'required',
                'ESTADO' => 'required',
                'FOTO_PERFIL' => 'image|mimes:jpeg,png,jpg,svg',
                'FOTO_PORTADA' => 'image|mimes:jpeg,png,jpg,svg',
            ]);

            $user = User::findOrFail($id);
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
            $user->id_estado = $request->ESTADO;
            $user->update();

        }elseif ($request->TIPO === '1') {
            $this->validate($request, [
                'ACEPTO_SOLICITUDES_DE_DEDICATORIAS' => 'required',
                'PRECIO_DEDICATORIA' => 'required',
                'ACEPTO_CONTRATOS' => 'required',
                'COMICION_DECICATORIAS' => 'required',
                'COMICION_CONTRATOS' => 'required',
            ]);

            $user = User::findOrFail($id);
            $configuracion = tbl_configuraciones_artistas::where('ID_ARTISTA',$id)->get();
            $configuracion = $configuracion->first();
            $configuracion->PRECIO_DEDICATORIA = $request->PRECIO_DEDICATORIA;
            $configuracion->ACEPTO_SOLICITUDES_DE_DEDICATORIAS = $request->ACEPTO_SOLICITUDES_DE_DEDICATORIAS;
            $configuracion->ACEPTO_CONTRATOS = $request->ACEPTO_CONTRATOS;
            $configuracion->COMICION_DECICATORIAS = $request->COMICION_DECICATORIAS;
            $configuracion->COMICION_CONTRATOS = $request->COMICION_CONTRATOS;
            $configuracion->update();
        }elseif ($request->TIPO === '2') {
            $this->validate($request, [
                'password' => 'required|min:6|confirmed',
            ], [
                'passwordConfirmation.same' => 'La contraseña no coinciden',
                'passwordConfirmation.required' => 'La contraseña no coinciden',
            ]);

            $user = User::findOrFail($id);
            $user->password = bcrypt($request->password);
            if($user->update())
            {
                $data['nombre_usuario'] = $user->name;
                $data['email'] = $user->email;
                $data['password'] = $request->password;
                
                
                Mail::send('mail.cambiarPass', ['data' => $data], function($mail) use($data){
                    $mail->subject('Cambio de Contraseña Conecte');
                    $mail->to($data['email'], $data['nombre_usuario']);
                });
            }
        }

        Session::flash('message', 'Información actulizada satisfactoriamente');
        return Redirect::back();
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
