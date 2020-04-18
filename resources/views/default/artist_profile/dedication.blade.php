<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Conecte... Tu artista cerca de ti</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{asset('assets/css/conectev2.css')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            .figure-caption{
                display: none !important;
            }
            .figure:hover .figure-caption {
                display: flex!important; 
            }
        </style>
    </head>
    <body class="bg-white">
    @if(!empty($Profile))
        @if ($Profile->cover_perfil !== null)
            <div class="page-cover-profile" style="background-image: url('/assets/img/artist_profile/{{$Profile->cover_perfil}}');">
        @else
            <div class="page-cover-profile" style="background-image: url('/assets/img/artist_profile/cover-default.jpg');">
        @endif
    @else
        <div class="page-cover-profile" style="background-image: url('/assets/img/artist_profile/cover-default.jpg');">
    @endif
    <div style="height:100px;"></div>
    @if(!empty($Profile))
         <div class="col-12 pad-all ">
            <div class="col-lg-6 pad-all profile-artist">
                <div class="pad-all bck-option-artits">
                    <br />
                    <div class="name-profile-artist text-center ">{{$Profile->nombre_artistico}}</div>
                    <div class="social-profile-artist text-center ">
                        <img class="bd-placeholder-img" src="{{asset('assets/img/web/facebook.png')}}" />&nbsp;&nbsp;
                        <img class="bd-placeholder-img" src="{{asset('assets/img/web/twitter.png')}}" />&nbsp;&nbsp;
                        <img class="bd-placeholder-img" src="{{asset('assets/img/web/instagram.png')}}" />
                    </div>
                        <form action="{{route('pedirDedicatoria')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="ID_ARTISTA" value="{{$Profile->id}}">
                        <div class="form-dedication">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 pad-btm ">
                                    <input type="text" name="DE_PARTE_DE" placeholder="De parte de " />
                                </div>
                                <div class="col-lg-6 col-md-12 pad-btm">
                                    <input type="text" name="DIRIGIDO_A" placeholder="Dirijido a" />
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <textarea id="msg_" name="MENSAJE" placeholder="Detalle de la dedicatoria"  class="form-control" cols="30" rows="7" onKeyUp="maximo(this,350);" onKeyDown="maximo(this,350);" required>{{ old('MENSAJE') }}</textarea>
                                    <input type="text" id="cnt_" maxlength="50" readonly style="background:none !important;color:#FFF;margin-top:-25px !important ; text-align:left">
                                </div>
                            </div>
                        </div>
                        <div class="requests-profile-artist text-center ">
                            <input type="submit" class="btn btn-dedicatoria-form" value="Pedir emociones">
                        </div>
                        </form>
                    <br />
                </div>
            </div>
        </div>
    </div>
        @endif
        @include('default.head')
        @include('default.footer')
            
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('assets/js/token.js')}}"></script>
        <script src="{{asset('assets/js/conecte.js')}}"></script>
    </body>

</html>