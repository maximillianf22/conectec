<div class="opacity " style="position:fixed; top:0; width:100%">
<nav class="navbar navbar-dark navbar-expand-md " >
     <div class="container-fluid">
          <a class="navbar-brand " href="/">
          <img src="{{ asset('assets/img/LogoConecteWeb.png') }} ">
          </a>
          <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse d-xl-flex justify-content-xl-end" id="navcol-1">
          <ul class="nav navbar-nav">
               
               @if(Auth::user())
                    <li class="nav-item" role="presentation">
                         <a class="nav-link active" href="{{route('perfil')}}" >{{Auth::user()->name}}</a>
                    </li>
               @else
                    <li class="nav-item" role="presentation">
                         <a class="nav-link active btn-login" href="{{route('loginView')}}" >Iniciar sesión</a>
                    </li>
               @endif
               <li class="nav-item" role="presentation">
                    <a class="nav-link active btn-explorar " href="{{route('home.explorer')}}">Explorar</a>
               </li>
               <li class="nav-item" role="presentation">
                    <a class="nav-link active btn-tutorial " href="{{route('loginView')}}">Tutorial</a>
               </li>
<!--
               <div class="languaje" style=" font-size:14px; padding:7px 1px ; color:grey">
                    <a style="color:grey !important" href="{{ route('change_lang', ['lang' => 'es']) }}">es</a> | <a style="color:grey !important"  href="{{ route('change_lang', ['lang' => 'en']) }}">en</a>
               </div>
-->
          </ul>
          </div>
     </div>
</nav>
</div>