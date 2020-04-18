@extends ('templates.layouts.default')

@section ('title','Registro')

@section('head')
    <style>
        footer{
            display: none;
        }
        .btn-warning:not(:disabled):not(.disabled).active, .btn-warning:not(:disabled):not(.disabled):active, .show>.btn-warning.dropdown-toggle{
            color: #fff;
            background-color: #ff578a;
            border-color: #ff578a;
            box-shadow: inherit;
        }
        .btn-warning:hover {
            color: #fff;
            background-color: #ff578a;
            border-color: #ff578a;
        }
        .btn-warning {
            color: #ffffff;
            background-color: #ff578a00;
            border-color: #ff578a;
        }
    </style>
@endsection

@section('content')
    <div class="page-home-1 text-center d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col">
                <h1 class="title titleLogin" >Formulario de registro</h1>

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="btn-group btn-group-toggle" style="width: 100%;" data-toggle="buttons">
                                <label class="btn btn-warning btn-login font-weight-bold active" style="cursor:pointer;width: 100%;">
                                    <input type="radio" name="valuePerfil" value="0" autocomplete="off" checked=""> Cliente
                                </label>
                                <label class="btn btn-warning btn-login font-weight-bold" style="cursor:pointer;width: 100%;">
                                    <input type="radio" name="valuePerfil" value="1" autocomplete="off"> Artista
                                </label>
                                <label class="btn btn-warning btn-login font-weight-bold" style="cursor:pointer;width: 100%;">
                                    <input type="radio" name="valuePerfil" value="8" autocomplete="off"> Celebridad
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombres y apellidos" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Correo electronico">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control" name="password" required placeholder="Contrasena">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirmacion de contrasena">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-md-offset-12">

                            <button type="submit" class="btn btn-primary">
                                Registrarse
                            </button>

                            <a class="btn btn-primary" href="{{ url('/login') }}">
                                Iniciar sesión
                            </a>
                        </div>
                    </div>



                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    @if ($errors->has('name'))
        <script>toastr.info("{{$errors->first('name')}}")</script>
    @endif

    @if ($errors->has('email'))
        <script>toastr.info("{{$errors->first('email')}}")</script>
    @endif

    @if ($errors->has('password'))
        <script>toastr.info("{{$errors->first('password')}}")</script>
    @endif
@endsection
