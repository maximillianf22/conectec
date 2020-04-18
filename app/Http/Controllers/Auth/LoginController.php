<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth,Mail;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Redirect;
use Session;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $parametro = $request->parametro;
        return view('auth.login');
    }

    public function loginAdmin()
    {
        return view('auth.admin.login');
    }

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth){
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function loginPost(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $users = User::Where('email', $request->email)->first();
        
        $token = $request->token;

        if (!empty($users)) {
            if (Auth::attempt($credentials)) {
                if (Auth::user()->id_perfil == 2) {
                    Auth::logout();
                    Session::flush();
                    Session::flash('message_error', 'Este usuario no puede iniciar sesión por este formulario');
                    return redirect::to('/login');
                }else{
                    switch (Auth::user()->id_estado) {
                        case 10:
                                Auth::logout();
                                Session::flash('message_error', 'Esta cuenta aun no sido verificada, revisa tu correo electrónico');
                                return redirect::to('/login');
                            break;
    
                        case 11:
                                Auth::logout();
                                Session::flash('message_error', 'Esta cuenta fue rechazada');
                                return redirect::to('/login');
                            break;
    
                        case 17:
                                Auth::logout();
                                Session::flash('message_error', 'Esta cuenta esta siendo revisada por el administrador');
                                return redirect::to('/login');
                            break;
    
                        case 19:
                                Auth::logout();
                                Session::flash('message_error', 'Esta cuenta fue rechazada contecte con el administrador');
                                return redirect::to('/login');
                            break;
    
                        default:
                                return redirect::to('/welcome');
                        break;
                    }
                }
            } else {
                Session::flash('message_error', 'Usuario o contraseña incorrectos');
                return redirect::to('/login');
            }
        } else {
            Session::flash('message_error', 'Usuario o contraseña incorrectos');
            return redirect::to('/login');
        }
    }

    public function loginPostAdmin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        $users = User::Where('email', $request->email)->first();

        if (!empty($users)) {
            if (Auth::attempt($credentials)) {
                if (Auth::user()->id_perfil == 2) {
                    return redirect::to('/administrador');
                } else {
                    Auth::logout();
                    Session::flush();
                    Session::flash('message_error', 'Este usuario no puede iniciar sesión por este formulario');
                    return redirect::to('/login/administrador');
                }

            } else {
                Session::flash('message_error', 'La Contraseña es Incorrecta');
                return redirect::to('login/administrador');
            }

        } else {
            Session::flash('message_error', 'Estamos mejorando nuestro sistema, pronto estaremos de vuelta');
            return redirect::to('login/administrador');
        }

    }

    protected function getLogout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::to('/');
    }



    public function RecoveryAccount() { return view('auth.userRecovery');}
    public function PostRecoveryAccount(Request $request){
      $this->validate($request, [ 'email' => 'required' ]);
      $validate_ = User::where('email', $request->email)->first();
      
      if (!empty($validate_)) {
        $validate_->confirm_token = str_random(100);
        if($validate_->update()){
          $DataName_ = $validate_->name;
          $DataEmail_ = $validate_->email;
          $data['nombre'] =  $DataName_;
          $data['id'] = $validate_->id;
          $data['email'] = $DataEmail_;
          $data['confirm_token'] = $validate_->confirm_token;

          Mail::send('mail.recovery', ['data' => $data], function($mail) use($data){
            $mail->subject('Restaurar Contraseña');
            $mail->to($data['email'], $data['nombre']);
          });

          Session::flash('message', 'Se ha enviado un correo con la recuperación de la cuenta.');
          return redirect::to('/login');

        }
      }else{  Session::flash('message_error', 'El correo ingresado no esta registrado.'); 
            return redirect::to('/recoveryaccount');
        }
    }

    public function ConfirmationRecoveryAccount($identificacion_,$token_){
      $ValidateAccount = User::where('id', $identificacion_)->where('confirm_token', $token_)->first();
      if (!empty($ValidateAccount)) {
        return view('mail.resetEmail',compact('identificacion_','token_'));
      }else{
        return "Error Confirmación de Datos ";
      }
    }

    public function ResetPassAccount(Request $request){
      $ValidateConfirmAccount_ = User::where('id', $request->id)->where('confirm_token', $request->token_)->first();
      if (!empty($ValidateConfirmAccount_)) {
          $ValidateConfirmAccount_->password = bcrypt($request->password);
          $ValidateConfirmAccount_->confirm_token = str_random(100);
          if($ValidateConfirmAccount_->update()){
            return redirect::to('/login');
          }
      }else{
        Session::flash('message_error', 'Error al intentar actualizar la nueva contraseña.'); 
        return redirect::to('/login');
      }
    }


}
