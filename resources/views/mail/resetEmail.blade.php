@extends ('templates.default.layouts.autentificacion')
@section ('title','Inicio de sesión')
@section('head')
@endsection

@section('body')
    <body class="hold-transition login-page fdo-auth">
        <div class="login-box ">
            <div class="login-logo">              
                <a href="/">
                    <img src="{{ asset('/assets/img/LogoConecteWeb.png') }}" alt="Conecte.com">
                </a>
            </div>

            <div class="login-box-body">
                <div class="fdo-bck-app brd-radius-tops">
                    <p class="login-box-msg">Restaurar Contraseña</p>
                </div>
                
                <form method="POST" action="{{ route('resetpasswordaccount') }}">
                <div class="body-form-login brd-radius-bottoms">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback">
                    <input  type="hidden"  name="id" placeholder="" value="{{ $identificacion_}}">
                            <input  type="hidden"  name="token_" placeholder="" value="{{ $token_}}">
                            
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} field_password" name="password" placeholder="Nueva Contraseña" value="" required autofocus>
                                @if ($errors->has('email')) 
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        
                    </div>
                    <div class="form-group has-feedback">
                    <input id="repeatpassword" type="password" class="form-control{{ $errors->has('repeatpassword') ? ' is-invalid' : '' }} field_repeatpassword" name="repeatpassword" placeholder="Repetir Contraseña" value="" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        
                    </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-xs-12" style="padding-bottom: 15px;">
                             <button class="btn btn-login-form btn-block btn-flat" type="submit">Actualizar</button>
                        </div>
                    </div>
                </form>
                <div class="action-forms text-center">
                    <a href="{{ route('recoveryaccount') }}">¿Se te ha olvidado la contraseña?</a><br>
                    <a href="{{ route('register.usuarios') }}" class="text-center"><b>Aun no soy usuario de conecte,  deseo registrarme</b></a>
                    <br />
                    <a href="{{ route('register.artista') }}" class="text-center"><b>Registrarme como Artista</b></a>
                    
                </div>
            </div>
        </div>
    </body>
@endsection

@section('js')
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <script>toastr.info("{{$error}}")</script>
        @endforeach
    @endif
@endsection