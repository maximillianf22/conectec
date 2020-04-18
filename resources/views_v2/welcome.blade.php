@extends ('templates.layouts.default')

@section ('title','conecte')

@section('content')

    <div class="page-home-1 text-center d-flex justify-content-center align-items-end">
        <div class="row">
            <div class="col">
                <h1 class="title">Tu artista cerca de ti</h1>
                <p class="subtitle">Conecta tu artista favorito, con tu persona favorita.</p>
                <a class="btnNext" href="/principal">
                    Conecta con tu artista
                </a>
                <h1 class="cantidad">Sólo por $9,99US</h1>
                <p class="msg">*El tiempo de respuesta es relativo. Aplican términos y condiciones.</p>
            </div>
        </div>
    </div>

    <div class="page-home-2 text-center">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1 class="title">Tu artista cerca de ti</h1>
                    <p class="subtitle">Recibe una dedicatoria de tu artista preferido o contáctalo.</p>
                    <a class="btnNext" href="#">
                        Conecta con tu artista
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="page-home-3">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <figure class="figure text-center d-flex justify-content-center align-items-center">
                        <img class="fondo" src="{{ asset('assets/images/fondoArtisata.png') }}">
                        <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                        <figcaption class="figure-caption">
                            <h1 class="nombre">Sebastian yatra</h1>
                            <p class="tipoGenero">Pop</p>
                            <p class="btnConectar">conentar</p>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-4">
                    <figure class="figure text-center d-flex justify-content-center align-items-center">
                        <img class="fondo" src="{{ asset('assets/images/fondoArtisata.png') }}">
                        <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                        <figcaption class="figure-caption">
                            <h1 class="nombre">Sebastian yatra</h1>
                            <p class="tipoGenero">Pop</p>
                            <p class="btnConectar">conentar</p>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-4">
                    <figure class="figure text-center d-flex justify-content-center align-items-center">
                        <img class="fondo" src="{{ asset('assets/images/fondoArtisata.png') }}">
                        <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                        <figcaption class="figure-caption">
                            <h1 class="nombre">Sebastian yatra</h1>
                            <p class="tipoGenero">Pop</p>
                            <p class="btnConectar">conentar</p>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-4">
                    <figure class="figure text-center d-flex justify-content-center align-items-center">
                        <img class="fondo" src="{{ asset('assets/images/fondoArtisata.png') }}">
                        <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                        <figcaption class="figure-caption">
                            <h1 class="nombre">Sebastian yatra</h1>
                            <p class="tipoGenero">Pop</p>
                            <p class="btnConectar">conentar</p>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-4">
                    <figure class="figure text-center d-flex justify-content-center align-items-center">
                        <img class="fondo" src="{{ asset('assets/images/fondoArtisata.png') }}">
                        <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                        <figcaption class="figure-caption">
                            <h1 class="nombre">Sebastian yatra</h1>
                            <p class="tipoGenero">Pop</p>
                            <p class="btnConectar">conentar</p>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-4">
                    <figure class="figure text-center d-flex justify-content-center align-items-center">
                        <img class="fondo" src="{{ asset('assets/images/fondoArtisata.png') }}">
                        <img class="img-fluid figure-img" src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" />
                        <figcaption class="figure-caption">
                            <h1 class="nombre">Sebastian yatra</h1>
                            <p class="tipoGenero">Pop</p>
                            <p class="btnConectar">conentar</p>
                        </figcaption>
                    </figure>
                </div>
                
            </div>
        </div>
    </div>
@endsection


