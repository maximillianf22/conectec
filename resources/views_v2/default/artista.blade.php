@extends ('templates.layouts.default')

@section ('title','Inicio')

@section('head')
    <style>
        footer{
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            
            @include('templates.menus.siedabarIzq')

            <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9 contenidoPrincipal" style="background: url('/assets/images/fondoPerfilArtisata.png') center / cover, linear-gradient(317deg, #171717, rgba(56, 46, 72, 0)); background-blend-mode: multiply;">
                <div class="container-fluid artista" >
                    <div class="row rowNombre" id="rowNombre">
                        <div class="col-12">
                            <p class="peticiones">1.393.343 peticiones</p>
                            <h1 class="title">Twenty One Pilots</h1>
                        </div>
                    </div>

                    <div class="row rowBtnContactar" id="rowBtnContactar">
                        <div class="col-12 col-sm-3">
                            <p>Pedir dedicatoria</p>
                        </div>
                    </div>

                    <div class="row rowVideos">
                        <div class="col-md-3">
                            <figure class="figure">
                                <img class="img-fluid figure-img" src="{{ asset('assets/images/video-1.png') }}" />
                                <figcaption class="figure-caption">Lane Boy - Twenty one pilots</figcaption>
                            </figure>
                        </div>
                        <div class="col-md-3">
                            <figure class="figure">
                                <img class="img-fluid figure-img" src="{{ asset('assets/images/video-2.png') }}" />
                                <figcaption class="figure-caption">Stressed Out - Twenty one pilots</figcaption>
                            </figure>
                        </div>
                        <div class="col-md-3">
                            <figure class="figure">
                                <img class="img-fluid figure-img" src="{{ asset('assets/images/video-3.png') }}" />
                                <figcaption class="figure-caption">Ride: 21Pilots</figcaption>
                            </figure>
                        </div>
                    </div>

                    <div class="row rowCosto">
                        <div class="col-md-6 d-flex align-items-center">
                            <img src="{{ asset('assets/images/logoConecta.png') }}" alt="">
                            <p>Conecta por <br> Sólo por $9,99US</p>
                        </div>
                        <div class="col-md-6 text-center justify-content-center d-flex align-items-center">
                            <p class="btnConectar">Conectar</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>artista()</script>
@endsection