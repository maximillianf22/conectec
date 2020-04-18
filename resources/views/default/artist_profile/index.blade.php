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
                    <div class="pad-all">
                        <br /><br />
                        <div class="name-profile-artist text-center ">{{$Profile->nombre_artistico}}</div>
                        <div class="social-profile-artist text-center ">
                            <img class="bd-placeholder-img" src="{{asset('assets/img/web/facebook.png')}}" />&nbsp;&nbsp;
                            <img class="bd-placeholder-img" src="{{asset('assets/img/web/twitter.png')}}" />&nbsp;&nbsp;
                            <img class="bd-placeholder-img" src="{{asset('assets/img/web/instagram.png')}}" />
                        </div>
                        <div class="requests-profile-artist text-center ">{{$Profile->dedicatorias+$Profile->contrataciones}} Peticiones</div>
                        @if($details->ACEPTO_SOLICITUDES_DE_DEDICATORIAS == 26)
                            <div class="requests-profile-artist text-center "><a href="{{route('home.profile.dedicatoria',$Profile->nombre_artistico)}}" class="btn-dedicatoria-form"> Pedir dedicatoria </a></div>
                            @if($details->ACEPTO_CONTRATOS == 26)
                                <div class="advertising_campaign text-center "><a href="{{route('home.profile.campaigns',$Profile->nombre_artistico)}}"> Campaña publicitaria </a></div>
                            @endif
                        @elseif($details->ACEPTO_CONTRATOS == 26)
                            <div class="advertising_campaign text-center "><a href="{{route('home.profile.campaigns',$Profile->nombre_artistico)}}" class="btn-dedicatoria-form"> Campaña publicitaria </a></div>
                            @if($details->ACEPTO_SOLICITUDES_DE_DEDICATORIAS == 26)
                                <div class="requests-profile-artist text-center "><a href="{{route('home.profile.dedicatoria',$Profile->nombre_artistico)}}"> Pedir dedicatoria </a></div>
                            @endif
                        @endif
                        <br />
                    </div>
                </div>
            </div>
        </div>
    @endif
        @include('default.head')
        @include('default.explorar.events')
        @include('default.footer')
            
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    </body>

</html>