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

            <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9 contenidoPrincipal">
                <div class="container-fluid tileAndBuscador">
                    <div class="row">
                        <div class="col-6">
                            <h1 class="artistasParaTi">Artistas para ti</h1>
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            <div class="contenedorBuscador">
                                <form method="GET" action="/principal" role="search">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-search 3x"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="query" class="form-control" placeholder="Ej, maluma, etc.">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row rowArtistasParaTi">
                        <div class="col-2 col-sm-3">
                                <figure class="figure">
                                    <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                                    <figcaption class="figure-caption">Twister el Rey</figcaption>
                                </figure>
                        </div>
                        <div class="col-2 col-sm-3">
                                <figure class="figure">
                                    <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                                    <figcaption class="figure-caption">Twister el Rey</figcaption>
                                </figure>
                        </div>
                        <div class="col-2 col-sm-3">
                                <figure class="figure">
                                    <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                                    <figcaption class="figure-caption">Twister el Rey</figcaption>
                                </figure>
                        </div>
                        <div class="col-2 col-sm-3">
                                <figure class="figure">
                                    <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                                    <figcaption class="figure-caption">Twister el Rey</figcaption>
                                </figure>
                        </div>
                    </div>

                    <div class="row rowGeneros">
                        <div class="col-12">
                            <h1 class="title">Géneros</h1>
                            <ul class="list-unstyled d-lg-flex">
                                <li style="margin-left:0">Champeta</li>
                                <li style="color: #fff; background-color: #ffffff00;">Vallenato</li>
                                <li style="color: #fff; background-color: #ffffff00;">Salsa</li>
                                <li style="color: #fff; background-color: #ffffff00;">Reggaeton</li>
                                <li style="color: #fff; background-color: #ffffff00;">Trap</li>
                            </ul>
                        </div>
                    </div>

                    <div class="row rowArtistasParaTi">
                        <div class="col-2 col-sm-3">
                                <figure class="figure">
                                    <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                                    <figcaption class="figure-caption">Twister el Rey</figcaption>
                                </figure>
                        </div>
                        <div class="col-2 col-sm-3">
                                <figure class="figure">
                                    <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                                    <figcaption class="figure-caption">Twister el Rey</figcaption>
                                </figure>
                        </div>
                        <div class="col-2 col-sm-3">
                                <figure class="figure">
                                    <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                                    <figcaption class="figure-caption">Twister el Rey</figcaption>
                                </figure>
                        </div>
                        <div class="col-2 col-sm-3">
                                <figure class="figure">
                                    <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                                    <figcaption class="figure-caption">Twister el Rey</figcaption>
                                </figure>
                        </div>
                        <div class="col-2 col-sm-3">
                                <figure class="figure">
                                    <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                                    <figcaption class="figure-caption">Twister el Rey</figcaption>
                                </figure>
                        </div>
                        <div class="col-2 col-sm-3">
                                <figure class="figure">
                                    <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                                    <figcaption class="figure-caption">Twister el Rey</figcaption>
                                </figure>
                        </div>
                        <div class="col-2 col-sm-3">
                                <figure class="figure">
                                    <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                                    <figcaption class="figure-caption">Twister el Rey</figcaption>
                                </figure>
                        </div>
                        <div class="col-2 col-sm-3">
                                <figure class="figure">
                                    <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                                    <figcaption class="figure-caption">Twister el Rey</figcaption>
                                </figure>
                        </div>
                    </div>

                    <div class="row rowArtistasParaTi">
                            <div class="col-12">
                                <h1 class="title">Celebridades</h1>
                            </div>
                            <div class="col-2 col-sm-3">
                                    <figure class="figure">
                                        <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                                        <figcaption class="figure-caption">Twister el Rey</figcaption>
                                    </figure>
                            </div>
                            <div class="col-2 col-sm-3">
                                    <figure class="figure">
                                        <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                                        <figcaption class="figure-caption">Twister el Rey</figcaption>
                                    </figure>
                            </div>
                            <div class="col-2 col-sm-3">
                                    <figure class="figure">
                                        <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                                        <figcaption class="figure-caption">Twister el Rey</figcaption>
                                    </figure>
                            </div>
                            <div class="col-2 col-sm-3">
                                    <figure class="figure">
                                        <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                                        <figcaption class="figure-caption">Twister el Rey</figcaption>
                                    </figure>
                            </div>
                        </div>

                </div>
            </div>

        </div>
    </div>
@endsection

