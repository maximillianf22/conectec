@extends ('templates.default.layouts.autentificacion')


@section ('title','Restaurar contraseña')

@section('head')
@endsection

@section('body')
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">              
                <a href="/">
                    <img src="{{ asset('/assets/img/logo.png') }}" alt="Conecte.com">
                </a>
            </div>

            <div class="login-box-body">
                <p class="login-box-msg">Para continuar, digite su correo electronico con que esta registrado en conecte.co</p>

                <form role="form" method="POST" action="{{ url('/password/email') }}">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback">
                        <input id="email" type="email" class="form-control" name="email" placeholder="Correo electronico" value="{{ old('email') }}" required autofocus>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-12" style="padding-bottom: 15px;">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Restablecer contraseña</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
@endsection

@section('js')
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <script>toastr.info("{{ $error }}")</script>
        @endforeach
    @endif

    @if (session('status'))
        <script>toastr.info("{{ session('status') }}")</script>
    @endif
@endsection