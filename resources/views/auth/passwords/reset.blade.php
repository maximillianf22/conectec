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
                <p class="login-box-msg">Restablecer contraseña.</p>
                <form role="form" method="POST" action="{{ url('/password/reset') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group has-feedback">
                        <input id="email" type="email" class="form-control" name="email" placeholder="Correo electronico" value="{{ $email or old('email') }}" required autofocus>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group has-feedback">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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

    <div class="container" style="display: none">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Reset Password</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Reset Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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