<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Conecte... Tu artista cerca de ti</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{asset('assets/css/conectev2.css')}}">
        <style>
            .figure-caption{
                display: none !important;
            }
            .figure:hover .figure-caption {
                display: flex!important; 
            }
        </style>
    </head>
    <body style="background:#000">

    <div class="fdoPage_">
        
        <div class="opacity " style="position:fixed; top:0; width:100%">  
            <nav class="navbar navbar-dark navbar-expand-md " >
                
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
                                    <a class="nav-link active" href="perfil" >{{Auth::user()->name}}</a>
                                </li>
                            @else
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active btn-login" href="{{route('register.usuarios')}}" >Registro Usuario</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active btn-login" href="/login" >Iniciar sesión</a>
                                </li>
                            @endif
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active btn-explorar " href="{{route('home.explorer')}}">Explorar</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active btn-tutorial " href="/login">Tutorial</a>
                            </li>
    <!--
                            <div class="languaje" style=" font-size:14px; padding:7px 1px ; color:grey">
                                <a style="color:grey !important" href="{{ route('change_lang', ['lang' => 'es']) }}">es</a> | <a style="color:grey !important"  href="{{ route('change_lang', ['lang' => 'en']) }}">en</a>
                            </div>
        -->
                        </ul>
                    </div>
                
            </nav>
        </div>

        <div style="  padding-top:100px;"></div>
        <div class="container-fluid  pad-all ">
            <div class="row">

                <div class="col-lg-6 pad-all text-center fdoLeft " style="min-height:600px;">
                    <br /><br />
                    <h1><span style="color: rgb(255,255,255);font-size:40px; font-weight:normal;">Recibe</span><br /><span style="color: rgb(255,255,255);font-size:40px; font-weight:bold;">emociones</span></h1>
                    <br /><br />
                    <p style="font-size:30px; font-weight:200;color:#fff; line-height:40px;">Conecta a tu artista favorito<br /> con tu persona favorita</p>
                    <br /><br />
                    <a class="btn btn-link btn-lg text-center" role="button" href="{{route('home.favorites')}}" >Si quiero el video</a>
                </div>

                <div class="col-lg-6 pad-all  text-center fdoRight" style="min-height:600px;">
                    <br /><br />
                    <h1><span style="color: rgb(255,255,255);font-size:40px; font-weight:normal;">Damos</span><br /><span style="color: rgb(255,255,255);font-size:40px; font-weight:bold;">emociones</span></h1>
                    <br /><br />
                    <p style="font-size:30px; font-weight:200;color:#fff; line-height:40px;">Acércate a tus fans y <br /> haz parte de la familia conecte </p>
                    <br /><br />
                    <a class="btn btn-link btn-lg text-center" role="button" href="{{route('register.artista')}}" >Registrarme como artista</a>
                </div>

            </div>
        </div>
        @include('default.footer')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    </body>
</html>