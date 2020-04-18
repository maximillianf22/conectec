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
                    <p class="login-box-msg">Iniciar sesión | Administrador</p>
                </div>
                
                <form role="form" method="POST" action="{{route('loginPostAdmin')}}">
                <div class="body-form-login brd-radius-bottoms">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback">
                        <input id="email" type="email" class="form-control" name="email" placeholder="@lang('conecte.email')" style="font-size:14px !important" value="{{ old('email') }}" required autofocus>
                        
                    </div>
                    <div class="form-group has-feedback">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required style="font-size:14px !important">
                        
                    </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-xs-12" style="padding-bottom: 15px;">
                            <button type="submit" class="btn btn-login-form btn-block btn-flat">Iniciar</button>
                        </div>
                    </div>
                </form>
                <div class="action-forms text-center">
                    <a href="{{ route('recoveryaccount') }}">¿Se te ha olvidado la contraseña?</a><br> 
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