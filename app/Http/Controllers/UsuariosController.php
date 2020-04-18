<?php

namespace App\Http\Controllers;

use app\tbl_billeteras;
use app\tbl_parametros;
use app\User;
use Illuminate\Http\Request;
use Auth;
use Mail;
use App\tbl_movimientos;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class UsuariosController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		$user = User::findOrFail(Auth::user()->id);
        $user->tipoUsuario;
        $user->billetera;
		

		if ($request) {

			$query = trim($request->get('query'));

			$users = User::where("id_perfil", "0")
				->where('name', 'like', '%' . $query . '%')
				->paginate(15);

				$users->each(function ($users) {
					$users->estado;
				});
		

		}

		return view('administracion.clientes.index')->with([
			"users" => $users,
			"user"  => $user,
			"clientes" => "clientes",
		]);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('administracion.clientes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required',
			'id_estado' => 'required',
		], [
			'name.required' => 'Nombre es requerido',
			'email.required' => 'Correo electronico es requerido',
			'id_estado.required' => 'Estado es requerido',
		]);

		$msg = tbl_parametros::where('ID', '18')->get();

		$user = new User();
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = bcrypt("123456");
		$user->id_perfil = 0;
		$user->id_estado = 10;
		$user->remember_token = str_random(100);
		$user->confirm_token = str_random(100);
		$user->save();

		$billetera = new tbl_billeteras();
		$billetera->ID_USER = $user->id;
		$billetera->SALDO = "0";
		$billetera->SALDO_TOTAL = "0";
		$billetera->save();

		$data['name'] = $user->name;
		$data['email'] = $user->email;
		$data['confirm_token'] = $user->confirm_token;

		Mail::send('mail.confirmacion', ['data' => $user, 'msg' => $msg->first()], function ($mail) use ($data) {
			$mail->subject('Confirma tu cuenta');
			$mail->to($data['email'], $data['name']);
		});

		Session::flash('message', 'Registro Exitoso');
		return redirect::to('administracion/clientes');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$user = User::findOrFail(Auth::user()->id);
        $user->tipoUsuario;
		$user->billetera;
		
		$cliente = User::findOrFail($id);
		$cliente->dedicatorias;
		$cliente->contratacionesClientes;
		$cliente->billetera;

		$movimientos = tbl_movimientos::where('ID_CLIENTE', $id)
			->paginate(7);

		$estados = tbl_parametros::where('ID_VALOR','2')
			->pluck('NOMBRE', 'ID');


		return view('administracion.clientes.edit')->with([
			"user"	  => $user,
			"cliente" => $cliente,
			"movimientos" => $movimientos,
			"estados" => $estados ,
			"clientes" => "clientes",
			
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {

		$this->validate($request, [
            'TIPO' => 'required',
		]);
		
		if ($request->TIPO === '1') {

			$this->validate($request, [
				'NAME' => 'required',
				'ESTADO' => 'required',
				'FOTO_PERFIL' => 'image|mimes:jpeg,png,jpg,svg',
			], [
				'name.required' => 'El nombre es requerido',
				'ESTADO.required' => 'El esatdo es requerido'
			]);

			$user = User::findOrFail($id);
			$user->name = $request->NAME;
			$user->id_estado = $request->ESTADO;
			
			if ($request->hasFile('FOTO_PERFIL')) {
				$file = Input::file('FOTO_PERFIL');
				$name = $id . '.' . $file->getClientOriginalExtension();
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




		Session::flash('message', 'Actulización Exitosa');
		return Redirect::back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$user = User::findOrFaild($id);
		$user->id_estado = 11;
		$user->update();

		Session::flash('message', 'Eliminación Exitosa');
		return redirect::to('/administracion/clientes');
	}
}
