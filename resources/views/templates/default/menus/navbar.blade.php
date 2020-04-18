<a href="{{route('welcome')}}" class="logo">
    <span class="logo-mini">
        <img src="{{ asset('assets/img/LogoAny.png') }}" alt="Conecte" height="35">
    </span>
    <span class="logo-lg">
        <img src="{{ asset('assets/img/logo.svg') }}" alt="Conecte" height="35">
    </span>
</a>



<nav class="navbar navbar-static-top" >
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        <!--
            <li class="noMostarScreen992 item-menu ">
                <a href="/welcome">
                   Campaña Publicitaria
                </a>
            </li>
-->
            <li class="noMostarScreen992 item-menu ">
                <a href="{{route('miHistorial')}}">
                    Dedicatorias
                </a>
            </li>

            <li class="noMostarScreen992 item-menu ">
                <a href="{{route('welcome')}}">
                    @lang('conecte.artists')
                </a>
            </li>

            @if(Auth::user())
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                       
                        @if(Auth::user()->id_perfil == 1)
                            <img src="{{ asset('assets/img/artistas/'.Auth::user()->foto_perfil) }}" class="user-image" alt="">
                        @else
                            <img src="{{ asset('assets/img/clientes/'.Auth::user()->foto_perfil) }}" class="user-image" alt="">
                        @endif
                        <span class="hidden-xs">{{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header" style="background: #232323">
                            @if(Auth::user()->id_perfil == 1)
                                <img src="{{ asset('assets/img/artistas/'.Auth::user()->foto_perfil) }}" class="user-image" alt="">
                            @else
                                <img src="{{ asset('assets/img/clientes/'.Auth::user()->foto_perfil) }}" class="user-image" alt="">
                            @endif
                            <p>
                                {{Auth::user()->name}}
                            </p>
                        </li>
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                </div>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{route('perfil')}}" class="btn btn-default btn-flat" style="border-radius: 5px">@lang('conecte.profile')</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout')}}" class="btn btn-default btn-flat" style="border-radius: 5px">@lang('conecte.logout')</a>
                            </div>
                        </li>
                    </ul>
                </li>
    
                <li class="noMostarScreen992">
                    <a href="#" data-toggle="control-sidebar">
                        <i class="fa fa-angle-down"></i>
                    </a>
                </li>
            @else
                <li class="">
                    <a href="{{ route('loginView')}}">
                        <i class="fa fa-user"></i>
                        <span class="noMostarScreen992"> @lang('conecte.login')</span>                        
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>