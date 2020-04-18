@extends ('templates.default.layouts.autentificacion')

@section ('title','Inicio de sesión')

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
                <p class="login-box-msg">@lang('conecte.to_continue_log_in_at') conecte.com</p>

                <form role="form" method="POST" action="{{ url('/loginPost') }}">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback">
                        <input id="email" type="email" class="form-control" name="email" placeholder="@lang('conecte.email')" value="{{ old('email') }}" required autofocus>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input id="password" type="password" class="form-control" name="password" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-12" style="padding-bottom: 15px;">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('conecte.login')</button>
                        </div>
                    </div>
                </form>
            
                <a href="{{ url('/password/reset') }}">@lang('conecte.have_you_forgotten_your_password')</a><br>
                <a href="{{ url('/register') }}" class="text-center">@lang('conecte.check_in') conecte.com</a>
            
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