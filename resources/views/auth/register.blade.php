@extends ('templates.default.layouts.autentificacion')

@section ('title','Registro')

@section('head')
@endsection

@section('body')
    <body class="hold-transition register-page">
        <div class="register-box">
          <div class="register-logo">
                <a href="/">
                    <img src="{{ asset('/assets/img/logo.png') }}" alt="Conecte.com">
                </a>
          </div>
        
          <div class="register-box-body">
            <p class="login-box-msg">@lang('conecte.new_user_registration')</p>
        
            <form action="{{ url('/registroPost') }}" method="post" role="form">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="@lang('conecte.name_lastname')" required autofocus>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="@lang('conecte.email')">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <select class="form-control select2" name="valuePerfil">
                        <option value="0" selected="selected">@lang('conecte.users')</option>
                        <option value="1">@lang('conecte.celebrities')</option>
                    </select>
                    <span class="glyphicon glyphicon-tag form-control-feedback"></span>
                </div>
                {{-----}}
                <div class="form-group has-feedback">
                    <select class="form-control select2" name="valueGenero">
                        @foreach($Genero_ as $Genero)
                        <option value="{{$Genero->ID}}" selected="">{{$Genero->NOMBRE}}</option>
                        @endforeach
                    </select>
                    
                </div>
                <div class="form-group has-feedback">
                    <input name="fechanac" type="date" class="form-control" placeholder="fecha" value="" >
                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input id="celuphone" type="text" class="form-control" name="celuphone" value="{{ old('celuphone') }}" placeholder="@lang('conecte.celuphone')" required autofocus>
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>

                
                {{-----}}
                
                <div class="form-group has-feedback">
                    <input id="password" type="password" class="form-control" name="password" required placeholder="@lang('conecte.password')">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="@lang('conecte.confirm_password')">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-center" style="margin-bottom: 15px">
                        <div class="checkbox icheck">
                            <label>
                                <input name="terminos_y_condiciones" type="checkbox"><a href="#">@lang('conecte.i_accept_the_terms_and_conditions')</a>
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('conecte.check_in')</button>
                    </div>
                </div>
            </form>
            <a href="login" class="text-center">@lang('conecte.i_have_an_account')</a>
          </div>
          <!-- /.form-box -->
        </div>
        <!-- /.register-box -->
    </body>
@endsection

@section('js')
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <script>toastr.info("{{$error}}")</script>
        @endforeach
    @endif
@endsection
