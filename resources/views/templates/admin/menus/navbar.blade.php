<a href="/welcome" class="logo">
    <span class="logo-mini">
        <img src="{{ asset('assets/img/LogoAny.png') }}" alt="Conecte" height="35">
    </span>
    <span class="logo-lg">
        <img src="{{ asset('assets/img/logo.svg') }}" alt="Conecte" height="35">
    </span>
</a>



<nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            @if(Auth::user())
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('upload/perfil/'. Auth::user()->foto_perfil) }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ asset('upload/perfil/'. Auth::user()->foto_perfil) }}" class="img-circle" alt="User Image">
                            <p>
                                {{Auth::user()->name}}
                                <small>{{$user->tipoUsuario->NOMBRE}}</small>
                            </p>
                        </li>
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <a href="#">$ {{number_format($user->billetera->SALDO, 2)}}</a>
                                </div>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer text-center">
                            <div class="pull">
                                <a href="{{ route('logout')}}" class="btn btn-default btn-flat">Cerrar Sesión</a>
                            </div>
                        </li>
                    </ul>
                </li>
            @else
                <li class="noMostarScreen992">
                    <a href="{{ route('loginView')}}">
                        Iniciar sesión
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>