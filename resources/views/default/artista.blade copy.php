@extends ('templates.default.layouts.default')

@section ('title',''.$artista->name)

@section('head')
    <style>
        .content-wrapper{
            background: url('/assets/img/artist_profile/{{$artista->foto_portada}}') top / cover, linear-gradient(317deg, #171717, rgba(56, 46, 72, 0)); background-blend-mode: multiply;
        }
        .fade-scale {
            transform: scale(0);
            opacity: 0;
            -webkit-transition: all .25s linear;
            -o-transition: all .25s linear;
            transition: all .25s linear;
        }

        .fade-scale.in {
            opacity: 1;
            transform: scale(1);
        }

        .modal.in .modal-dialog {
            -webkit-transform: translate(0, calc(50vh - 50%));
            -ms-transform: translate(0, 50vh) translate(0, -50%);
            -o-transform: translate(0, calc(50vh - 50%));
            transform: translate(0, 50vh) translate(0, -50%);
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid">
    
        <div class="row">
            <div class="col-12 contenidoPrincipal">
                <div class="container-fluid artista" >
                    <div class="row rowNombre" id="rowNombre">

                        <div class="col-6">
                            <p class="peticiones"></p>
                            <h1 class="title">{{$artista->name}}</h1>
                            <div class="social-profile-artist text-left ">
                                <img class="bd-placeholder-img" src="{{asset('assets/img/web/facebook.png')}}" />&nbsp;&nbsp;
                                <img class="bd-placeholder-img" src="{{asset('assets/img/web/twitter.png')}}" />&nbsp;&nbsp;
                                <img class="bd-placeholder-img" src="{{asset('assets/img/web/instagram.png')}}" />
                            </div>
                        </div>
                        <div class="col-12">
                            <p class="peticiones" style="color:#FFF; font-size:18px;">{{ $perfil->dedicatorias + $perfil->contrataciones }} Peticiones </p>
                        </div>
                            @if($artista->configuraciones->first()->ACEPTO_SOLICITUDES_DE_DEDICATORIAS === 26)
                                <div class="col-md-5" onclick="pedirDedicatoria()">
                                    <p class="pedirDedicatoria btn-dedicatoria-form">@lang('conecte.ask_for_a_dedication')</p>
                                </div>
                                <div class="col-md-2"></div>
                            @endif

                            @if($artista->configuraciones->first()->ACEPTO_CONTRATOS === 26)
                                <div class="col-md-5" onclick="contratar()">
                                    <p class="contratar" style="color:#FFF; background:none !important; border:2px solid #FFF; border-radius:25px;">Campaña publicitaria</p>
                                </div>
                            @endif

                        <div class="col-md-12"></div>

                        @foreach ($artista->posts as $item)
                            <div class="col-md-3 colPosts">
                                <figure class="figure" data-toggle="modal" data-target="#myModal" onclick="renovarIframe('{{$item->EMBED}}')">
                                    <img class="img-responsive figure-img" src="{{ asset('upload/post/'.$item->IMAGEN) }}" />
                                    <figcaption class="figure-caption">{{$item->NOMBRE}}</figcaption>
                                </figure>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="container-fluid containerPedirDedicatoria" style="display: none;">
            <div class="row">
                {{-- strat validamos que el cliente no tenga una solicitud de dedicación activa --}}
                <div class="col-md-12">
                    <form class="form-horizontal" method="POST" action="{{ route('pedirDedicatoria') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="ID_ARTISTA" value="{{$artista->id}}">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-1 control-label">@lang('conecte.of') </label>
                                <div class="col-sm-11">
                                    <input name="DE_PARTE_DE" type="text" class="form-control" value="{{ old('DE_PARTE_DE') }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">Para</label>
                                <div class="col-sm-11">
                                    <input name="DIRIGIDO_A" type="text" class="form-control" value="{{ old('DIRIGIDO_A') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">@lang('conecte.message')</label>
                                <div class="col-sm-11">
                                    <textarea id="msg_" name="MENSAJE" class="form-control" cols="30" rows="7" onKeyUp="maximo(this,350);" onKeyDown="maximo(this,350);" required>{{ old('MENSAJE') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label"></label>
                                <div class="col-sm-11">
                                    <input type="text" id="cnt_" maxlength="50" readonly style="background:none !important;color:#384650; text-align:left">
                                    <button type="button" class="btn btn-default textMaxCaracteres"></button>
                                    <button type="submit" class="btn btn-default pull-right btnPedir">@lang('conecte.send')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container-fluid containerContratar" style="display: none;">
            <div class="row">

                <div class="col-md-12">
                    <form class="form-horizontal" method="POST" action="{{ route('solicitarContratacion') }}">
                        <div class="box-body">
                            {{ csrf_field() }}
                            <input type="hidden" name="ID_ARTISTA" value="{{$artista->id}}">
                            <p class="ubicacion">@lang('conecte.location')</p>
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <input name="PAIS" type="text" class="form-control" placeholder="@lang('conecte.country')" value="{{ old('PAIS') }}" required>
                                </div>

                                <div class="col-sm-4">
                                    <input name="CIUDAD" type="text" class="form-control" placeholder="@lang('conecte.city')" value="{{ old('CIUDAD') }}" required>
                                </div>
                                
                                <div class="col-sm-4">
                                    <input name="DIRECCION" type="text" class="form-control" placeholder="@lang('conecte.address')" value="{{ old('DIRECCION') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">@lang('conecte.personal_information')</label>
                                <div class="col-sm-7">
                                    <input name="NAME" type="text" class="form-control" placeholder="@lang('conecte.name')" value="{{ old('NAME') }}" required>
                                </div>
                                <div class="col-sm-3">
                                    <input name="TELEFONO" type="number" class="form-control" placeholder="@lang('conecte.phone')" value="{{ old('TELEFONO') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">@lang('conecte.tentative_date')</label>
                                <div class="col-sm-3">
                                    <input name="DESDE" type="date" class="form-control" placeholder="Desde" value="{{ old('DESDE') }}" required>
                                </div>
                                <div class="col-sm-3">
                                    <input name="HASTA" type="date" class="form-control" placeholder="hasta" value="{{ old('HASTA') }}" required>
                                </div>
                                <div class="col-sm-4">
                                    <input name="HORA" type="time" class="form-control" placeholder="horas" value="{{ old('HORAS') }}" required>
                                </div>
                            </div>

                            <div class="form-group textAndEnviar" style="margin-bottom: 50px">
                                <div class="col-sm-11">
                                    <textarea name="MENSAJE" class="form-control" cols="2" rows="2" required>{{ old('MENSAJE') }}</textarea>
                                </div>
                                <div class="col-sm-1 colSend">
                                    <button type="submit" class="btn btn-app btnSend">
                                        <i class="fa fa-paper-plane fa-3"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

@endsection

@section('js')

    <div class="modal fade-scale" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close d-none" data-dismiss="modal">&times;</button>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe id="ifrm" class="embed-responsive-item" src="" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        /* agregado jj: 05-16-2019  pra agregar contador de caracteres */
        function maximo(campo,limite){
            if(campo.value.length>=limite){
                campo.value=campo.value.substring(0,limite);
            }else{
                $("#cnt_").val($("#msg_").val().length + " de 350 caracteres *");
            }

        }
        function contador_() {
            var max_chars = 50;
            var text_tmp ="";
            if($("#msg_").val().length<=max_chars){
                $("#cnt_").val($("#msg_").val().length + " de 350 caracteres *");
                $("#cnt_").addClass('mui--is-not-empty'); 
                text_tmp = $("#msg_").val();
            }else{
                if(!empty(text_tmp)){
                    document.getElementById("msg_").value  =  text_tmp ;
                }else{
                    document.getElementById("msg_").value  =  " ";
                }
                
                
            }
        }

        /*-------------------------------------------------------------*/

        function renovarIframe(url){
            $('#ifrm').attr('src', url)
        }

        function pedirDedicatoria(){
            $('.colPosts').hide();
            $('.containerContratar').hide();
            $('.containerPedirDedicatoria').show();
            $('.main-footer').hide();
            $('.content-wrapper').css('margin-bottom',0);

            //var style = window.getComputedStyle(document.getElementById('content-wrapper'));
            //var marginBottom = style.getPropertyValue('margin-bottom'); 

        }

        function contratar(){
            $('.colPosts').hide();
            $('.containerPedirDedicatoria').hide();
            $('.containerContratar').show();
            $('.main-footer').hide();
            $('.content-wrapper').css('margin-bottom',0);
        }
    </script>

    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <script>toastr.info("{{$error}}")</script>
        @endforeach
    @endif

@endsection