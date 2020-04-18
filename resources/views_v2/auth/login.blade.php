@extends ('templates.layouts.default')

@section ('title','Inicio de sesión')

@section('head')
    <style>
        footer{
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="page-home-1 text-center d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col">
                <h1 class="title titleLogin" >Inicio de sesión</h1>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-md-offset-12">
                            <button type="submit" class="btn btn-primary">
                                Inicio de sesion
                            </button>

                            <a class="btn btn-primary" href="{{ url('/register') }}">
                                Registrarse
                            </a>
                            <br>

                            <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                Olvidé mi contraseña?
                            </a>

                            
                        </div>
                    </div>



                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    @if ($errors->has('password'))
        <script>toastr.info("{{$errors->first('password')}}")</script>
    @endif

    @if ($errors->has('email'))
        <script>toastr.info("{{$errors->first('email')}}")</script>
    @endif
@endsection