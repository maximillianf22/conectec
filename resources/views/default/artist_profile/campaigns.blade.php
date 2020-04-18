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
                        <br />
                        <div class="name-profile-artist text-center ">{{$Profile->nombre_artistico}}</div>
                        <div class="social-profile-artist text-center ">
                            <img class="bd-placeholder-img" src="{{asset('assets/img/web/facebook.png')}}" />&nbsp;&nbsp;
                            <img class="bd-placeholder-img" src="{{asset('assets/img/web/twitter.png')}}" />&nbsp;&nbsp;
                            <img class="bd-placeholder-img" src="{{asset('assets/img/web/instagram.png')}}" />
                        </div>
                        <form action="{{route('solicitarContratacion')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="ID_ARTISTA" value="{{$Profile->id}}">
                         <div class="form-dedication">
                              <div class="row">
                              <div class="col-lg-6 col-md-12 pad-btm ">
                                   <input type="text" name="NAME" placeholder="Nombres y Apellidos" />
                              </div>
                              <div class="col-lg-6 col-md-12 pad-btm ">
                                   <input type="text" name="TELEFONO" placeholder="Celular" />
                              </div>    
                              </div>
                              <div class="row pad-top">
                              <div class="col-lg-12 col-md-12">
                                   <input type="email" name="email_contratante" placeholder="Correo" />
                              </div>
                              </div>
                              <div class="row pad-top ">
                              <div class="col-lg-12 col-md-12">
                                <textarea name="MENSAJE" class="form-control" placeholder="Descripción de la Campaña" cols="2" rows="2" required>{{ old('MENSAJE') }}</textarea>
                              </div>
                              
                              </div>
                         </div>
                        <div class="requests-profile-artist text-center ">
                            <input type="submit" class="btn btn-dedicatoria-form" value="Enviar">
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
    </body>

</html>