<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\tbl_billeteras;
use App\tbl_parametros;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\tbl_configuraciones_artistas;
use Mail;
use Redirect;
use Session;

class RegisterController extends Controller {

	protected function validator(array $data) {
		return Validator::make($data, [
			'name' => 'required|max:255',
			'valuePerfil' => 'required|max:1',
			'terminos_y_condiciones' => 'required',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|min:6|confirmed',
		]);
	}

	public function register() {
		$Genero_ = tbl_parametros::where('ID_VALOR', '13')->get();
		return view('auth.register',compact('Genero_'));
	}
	public function registros_usuarios() {
		$Genero_ = tbl_parametros::where('ID_VALOR', '13')->get();
		return view('auth.registro_usuarios',compact('Genero_'));
	}
	public function registros_artistas() {
		$Genero_ = tbl_parametros::where('ID_VALOR', '13')->get();
		return view('auth.registro_artistas',compact('Genero_'));
	}

	protected function registroArtistaPost(Request $request) {

		$this->validate($request, [
			'name' => 'required|max:255',
			'terminos_y_condiciones' => 'required',
			'email' => 'required|email|max:255|unique:users',
			'nombre_artistico' => 'required|unique:users'
		], [
			'name.max' => 'El nombre es demasiado largo',
			'email.unique' => 'Este correo electronico ya existe en nuestro sistema',
			'passwordConfirmation.same' => 'La contraseña no coinciden',
			'name.required' => 'Verifique la información ingresada e intente nuevamente',
			'valuePerfil.required' => 'Verifique la información ingresada e intente nuevamente',
			'terminos_y_condiciones.required' => 'Es necesario aceptar los terminos y condiciones',
			'passwordConfirmation.required' => 'Verifique la información ingresada e intente nuevamente',
			'email.required' => 'Verifique la información ingresada e intente nuevamente',
			'nombre_artistico.required' => 'Verifique la información ingresada e intente nuevamente',
			'nombre_artistico.unique' => 'Este Nombre artistico ya existe en nuestro sistema',
		]);

		$msg = tbl_parametros::where('ID', '18')->get();

		$user = new User();
		$user->name = $request->name;
		$user->email = $request->email;
		$user->nombre_artistico = $request->nombre_artistico;
		$user->password = bcrypt($request->password);
		/*
		$user->id_sexo = $request->valueGenero;
		*/
		$user->celular = intval(preg_replace('/[^0-9]+/','', $request->telefono_artista), 10);
		/*
		$user->fecha_nac = $request->fechanac;
		*/
		$user->nombre_manager = $request->name_manager;
		$user->email_manager = $request->email_manager;
		$user->celular_manager = intval(preg_replace('/[^0-9]+/','', $request->celular_manager), 10);

		$user->id_perfil = 1;
		$user->id_estado = 10;
		$user->remember_token = str_random(100);
		$user->confirm_token = str_random(100);

		if($user->save()){
			$billetera = new tbl_billeteras();
			$billetera->ID_USER = $user->id;
			$billetera->SALDO = "0";
			$billetera->SALDO_TOTAL = "0";
			if($billetera->save()){
				$newConfig = new tbl_configuraciones_artistas();
				$newConfig->ID_ARTISTA = $user->id;
				$newConfig->PRECIO_DEDICATORIA = 0;
				$newConfig->COMICION_DECICATORIAS = 0;
				$newConfig->ACEPTO_SOLICITUDES_DE_DEDICATORIAS = 26;
				$newConfig->ACEPTO_CONTRATOS = 26;
				$newConfig->COMICION_CONTRATOS = 0;
				if($newConfig->save()){
					$data['name'] = $user->name;
					$data['email'] = $user->email;
					$data['confirm_token'] = $user->confirm_token;

					Mail::send('mail.confirmacion', ['data' => $user, 'msg' => $msg->first()], function ($mail) use ($data) {
						$mail->subject('Confirma tu cuenta');
						$mail->to($data['email'], $data['name']);
					});

					Session::flash('message', 'Registro Exitoso, Gracias por ser parte de conecte.com, hemos enviado un correo de confirmacion');
					return redirect::to('/login');
				}
			}
		}
	}

	protected function registroUsuariosPost(Request $request) {

		$this->validate($request, [
			'name' => 'required|max:255',
			'terminos_y_condiciones' => 'required',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|min:6|confirmed',
		], [
			'name.max' => 'El nombre es demasiado largo',
			'email.unique' => 'Este correo electronico ya existe en nuestro sistema',
			'passwordConfirmation.same' => 'La contraseña no coinciden',
			'name.required' => 'Verifique la información ingresada e intente nuevamente',
			'valuePerfil.required' => 'Verifique la información ingresada e intente nuevamente',
			'terminos_y_condiciones.required' => 'Es necesario aceptar los terminos y condiciones',
			'passwordConfirmation.required' => 'Verifique la información ingresada e intente nuevamente',
			'email.required' => 'Verifique la información ingresada e intente nuevamente',
		]);

		$msg = tbl_parametros::where('ID', '18')->get();

		$user = new User();
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->id_sexo = $request->valueGenero;
		$user->celular = intval(preg_replace('/[^0-9]+/','', $request->celular_usuario), 10);
		$user->fecha_nac = $request->fechanac;
		$user->id_perfil = 0;
		$user->foto_perfil = 'user.png';
		$user->id_estado = 10;
		$user->remember_token = str_random(100);
		$user->confirm_token = str_random(100);
		$user->save();

		$billetera = new tbl_billeteras();
		$billetera->ID_USER = $user->id;
		$billetera->SALDO = 500000;
		$billetera->SALDO_TOTAL = 500000;
		$billetera->save();

		$data['name'] = $user->name;
		$data['email'] = $user->email;
		$data['confirm_token'] = $user->confirm_token;

		Mail::send('mail.confirmacion', ['data' => $user, 'msg' => $msg->first()], function ($mail) use ($data) {
			$mail->subject('Confirma tu cuenta');
			$mail->to($data['email'], $data['name']);
		});
		Session::flash('message', 'Registro Exitoso, Gracias por ser parte de conecte.co, hemos enviado un correo de confirmacion');
		return redirect::to('/login');
	}

	public function confirmRegister($email, $confirm_token) {

		$user = User::where('email', $email)
			->where('confirm_token', $confirm_token)
			->get();

		//CASO = 0 : Cliente
		//CASO = 1 : Artista o celebridad

		if (count($user) > 0) {
			$user = $user->first();
			$user = User::findOrFail($user->id);

			switch ($user->id_perfil) {
			case 0:
				$user->id_estado = 9;
				$user->update();
				return redirect('/login')->with('message', $user->name . ' tu cuenta ya ha sido activada. Ya puedes iniciar sesión en Conecte.');
			case 1:
				$user->id_estado = 17;
				$user->update();

				$configuraciones = new tbl_configuraciones_artistas();
				$configuraciones->ID_ARTISTA = $user->id;
				$configuraciones->PRECIO_DEDICATORIA = "30000";
				$configuraciones->ACEPTO_SOLICITUDES_DE_DEDICATORIAS = 26;
				$configuraciones->ACEPTO_CONTRATOS = 26;

				return redirect('/login')->with('message', $user->name . ' tu cuenta ya ha sido activada, y se encutra en revisión por el adminitrador.');

			default:
				return redirect('/login')->with('message', $user->name . ' Lo sentimos, no hemos podido encontra la cuenta asociada');
			}
		}
	}
}
