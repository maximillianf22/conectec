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
                                <p class="selecionadoPedirDedicatoria">Pedir dedicatoria</p>
                            </div>
                        </div>

                        <form>
                            <div class="row RowFormulario">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">De parte de</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control-plaintext" id="deParteDe" placeholder="Daniel Jose Ruiz gutierez">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Dirigido a </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control-plaintext" id="dirigidoa" placeholder="Daniel Jose Ruiz gutierez">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Mensaje</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control-plaintext" name="msg" id="msg" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection