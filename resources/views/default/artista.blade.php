@extends ('templates.default.layouts.default')
@section ('title',''.$artista->nombre_artistico)
@section('head')
    
@endsection

@section('content')
    @if(!empty($artista))
        @if ($artista->cover_perfil !== null)
            <div class="page-cover-profile" style="background-image: url('/assets/img/artist_profile/{{$artista->cover_perfil}}');">
        @else
            <div class="page-cover-profile" style="background-image: url('/assets/img/artist_profile/cover-default.jpg');">
        @endif
    @else
        <div class="page-cover-profile" style="background-image: url('/assets/img/artist_profile/cover-default.jpg');">
    @endif
    @if(!empty($artista))
        <div class="col-12 pad-all ">
            <div class="col-lg-6 pad-all profile-artist">
                <div class="pad-all bck-option-artits">
                    <br />
                    <div class="name-profile-artist text-center ">{{$artista->nombre_artistico}}</div>
                    <h4 class="text-center" id="valorDedicatoria" style="color:#FFF;">$ {{number_format($artista->userConfig->PRECIO_DEDICATORIA)}}</h4>
                    <div class="social-profile-artist text-center ">
                        <img class="bd-placeholder-img" src="{{asset('assets/img/web/facebook.png')}}" />&nbsp;&nbsp;
                        <img class="bd-placeholder-img" src="{{asset('assets/img/web/twitter.png')}}" />&nbsp;&nbsp;
                        <img class="bd-placeholder-img" src="{{asset('assets/img/web/instagram.png')}}" />
                    </div>
                    <div class="row">
                        <div class="col-12" id="cargando">
                            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                        </div>
                    </div>
                    <div class="PnlPedirDedicatoria" style="display: none;" id="PnlPedirDedicatoria">
                        <form class="form-horizontal" id="formDedicatoria" method="POST" action="{{ route('pedirDedicatoria') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="ID_ARTISTA" value="{{$artista->id}}">
                            <div class="form-dedication">
                                <div class="row">
                                <div class="col-lg-6 col-md-12 pad-btm ">
                                    <input name="DE_PARTE_DE" id="DE_PARTE_DE" type="text" placeholder="De parte de " class="form-control" value="{{ old('DE_PARTE_DE') }}" required autofocus>
                                </div>
                                <div class="col-lg-6 col-md-12 pad-btm">
                                    <input name="DIRIGIDO_A" id="DIRIGIDO_A" type="text" class="form-control" placeholder="Dirijido a" value="{{ old('DIRIGIDO_A') }}" required>
                                    <input type="hidden" name="nombre_artistico" value="{{$artista->nombre_artistico}}">
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
                                <a href="javascript:;" onclick="confirmacion()" class="btn-dedicatoria-form" style="border:none !important">Pedir emociones</a>
                                <br /><br />
                                @if($artista->userConfig->ACEPTO_CONTRATOS == 26)
                                <a href="#" class="" onclick="contratar()">Campaña Publicitaria  </a>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="PnlcontainerContratar" style="display: none;" id="PnlcontainerContratar" >
                        <form class="form-horizontal" id="formContracto" method="POST" action="{{ route('solicitarContratacion') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="ID_ARTISTA" value="{{$artista->id}}">
                            <div class="form-dedication">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 pad-btm ">
                                        <input name="NAME" id="NAME" type="text" class="form-control" placeholder="Nombres y Apellidos" value="{{ old('NAME') }}" required>
                                    </div>
                                    <div class="col-lg-6 col-md-12 pad-btm ">
                                        <input name="TELEFONO" id="TELEFONO" maxlength="10" type="number" class="form-control" placeholder="Celular" value="{{ old('TELEFONO') }}" required>
                                        <input type="hidden" name="nombre_artistico" value="{{$artista->nombre_artistico}}">
                                    </div>    
                                </div>
                                <div class="row pad-top">
                                    <div class="col-lg-12 col-md-12">
                                        <input type="email" id="emailContratacion" onchange="validarEmail1(this.value)" name="email_contratante" class="form-control" placeholder="Correo Electronico" />
                                        <span style="color:red;" id="emailOK"></span>
                                    </div>
                                </div>
                                <div class="row pad-top">
                                    <div class="col-lg-6 col-md-12 pad-btm ">
                                        <input name="FECHA1" id="FECHA1" type="date" class="form-control" placeholder="Fecha" value="{{ old('FECHA1') }}" required>
                                    </div>
                                    <div class="col-lg-6 col-md-12 pad-btm ">
                                        <input name="FECHA2" id="FECHA2" type="date" class="form-control" placeholder="Fecha" value="{{ old('FECHA2') }}" required>
                                    </div>    
                                </div>
                                <div class="row pad-top">
                                    <div class="col-lg-12 col-md-12">
                                        <input type="time" id="HORA" name="HORA" class="form-control" />
                                    </div>
                                </div>
                                <div class="row pad-top ">
                                    <div class="col-lg-12 col-md-12">
                                        <textarea name="MENSAJE" id="MENSAJE" class="form-control" placeholder="Descripción de la Campaña" cols="2" rows="2" required>{{ old('MENSAJE') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="requests-profile-artist text-center ">
                                <a href="javascript:;" onclick="confirmacionC()" class="btn-dedicatoria-form" style="border:none !important">Enviar</a>
                                <br /><br />
                                @if($artista->userConfig->ACEPTO_SOLICITUDES_DE_DEDICATORIAS == 26)
                                <a href="#" class="" onclick="pedirDedicatoria()">Pedir Dedicatoria</a>
                                @endif
                            </div>
                        </form>
                    </div>
                    <br />
                </div>
            </div>
        </div>
    </div>
    <!-- CONFIRMACION DEDICATORIA -->
    <div class="modal fade" id="confirmarD" tabindex="-1" role="dialog" aria-labelledby="confirmarDLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="background: linear-gradient(45deg, rgba(255,168,134,1) 0%, rgba(255,150,134,1) 22%, rgba(255,95,132,1) 90%, rgba(255,87,132,1) 100%);">
            <div class="modal-header text-center" style="border: none;">
                <h4 class="modal-title" id="confirmarDLabel" style="color:#FFF;">Confirmacion de Dedicatoria<br/>$ ({{number_format($artista->userConfig->PRECIO_DEDICATORIA)}})
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <div class="modal-body" style="padding: 10px 40px;">
                <div class="form-dedication">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 pad-btm ">
                            <input id="deParteC" type="text" class="form-control" disabled style="background: #FFFFFF60;">
                        </div>
                        <div class="col-lg-6 col-md-12 pad-btm ">
                            <input id="dirigidoC" type="text" class="form-control" disabled style="background: #FFFFFF60;">
                        </div>    
                    </div>
                    <div class="row pad-top ">
                        <div class="col-lg-12 col-md-12">
                            <textarea id="MENSAJEC" class="form-control" cols="2" disabled style="background: #FFFFFF60;" rows="2">{{ old('MENSAJE') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center" style="border: none;">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" onclick="enviarC()">Pedir emociones</button>
            </div>
          </div>
        </div>
    </div>
    <!-- CONFIRMACION CONTRACTO -->
    <div class="modal fade" id="confirmarC" tabindex="-1" role="dialog" aria-labelledby="confirmarCLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="background: linear-gradient(45deg, rgba(255,168,134,1) 0%, rgba(255,150,134,1) 22%, rgba(255,95,132,1) 90%, rgba(255,87,132,1) 100%);">
            <div class="modal-header text-center" style="border: none;">
                <h4 class="modal-title" id="confirmarCLabel" style="color:#FFF;">Confirmacion de contracto
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <div class="modal-body" style="padding: 10px 40px;">
                <div class="form-dedication">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 pad-btm ">
                            <input id="NAMECC" type="text" disabled style="background: #FFFFFF60;" class="form-control" placeholder="Nombres y Apellidos" value="{{ old('NAME') }}" required>
                        </div>
                        <div class="col-lg-6 col-md-12 pad-btm ">
                            <input id="TELEFONOCC" type="number" disabled style="background: #FFFFFF60;" class="form-control" placeholder="Celular" value="{{ old('TELEFONO') }}" required>
                        </div>    
                    </div>
                    <div class="row pad-top">
                        <div class="col-lg-12 col-md-12">
                            <input type="email" id="emailContratacionCC" disabled style="background: #FFFFFF60;" name="email_contratante" class="form-control" placeholder="Correo Electronico" />
                        </div>
                    </div>
                    <div class="row pad-top">
                        <div class="col-lg-6 col-md-12 pad-btm ">
                            <input id="FECHA1C" type="date" disabled style="background: #FFFFFF60;" class="form-control" value="{{ old('FECHA1C') }}" required>
                        </div>
                        <div class="col-lg-6 col-md-12 pad-btm ">
                            <input id="FECHA2C" type="date" disabled style="background: #FFFFFF60;" class="form-control" value="{{ old('FECHA2C') }}" required>
                        </div>    
                    </div>
                    <div class="row pad-top">
                        <div class="col-lg-12 col-md-12">
                            <input type="time" id="HORAC" disabled style="background: #FFFFFF60;" name="HORAC" class="form-control" />
                        </div>
                    </div>
                    <div class="row pad-top ">
                        <div class="col-lg-12 col-md-12">
                            <textarea id="MENSAJECC" disabled style="background: #FFFFFF60;" class="form-control" placeholder="Descripción de la Campaña" cols="2" rows="2" required>{{ old('MENSAJE') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center" style="border: none;">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" onclick="enviarCC()">Enviar</button>
            </div>
          </div>
        </div>
    </div>
    @endif
    @include('default.footer')
@endsection

@section('js')
    <script>
        function confirmacion()
        {
            var deParte = $("#DE_PARTE_DE").val();
            var dirigido = $("#DIRIGIDO_A").val();
            var msj = $("#msg_").val();

            if (deParte !== '' && dirigido !== '' && msj !== '') {
                $("#deParteC").val(deParte);
                $("#dirigidoC").val(dirigido);
                $("#MENSAJEC").val(msj);

                $("#confirmarD").modal('show');
            }else{
                toastr.info("Algunos campos estan vacios.");
            }
        }
        function enviarC()
        {
            $("#confirmarD").modal('hide');
            $("#formDedicatoria").submit();
        }
        function confirmacionC()
        {
            var NAME = $("#NAME").val();
            var TELEFONO = $("#TELEFONO").val();
            var EMAIL = $("#emailContratacion").val();
            var FECHA1 = $("#FECHA1").val();
            var FECHA2 = $("#FECHA2").val();
            var HORA = $("#HORA").val();
            var MENSAJE = $("#MENSAJE").val();

            if (NAME !== '' && TELEFONO !== '' && EMAIL !== '' && MENSAJE !== '') {
                $("#NAMECC").val(NAME);
                $("#TELEFONOCC").val(TELEFONO);
                $("#emailContratacionCC").val(EMAIL);
                $("#FECHA1C").val(FECHA1);
                $("#FECHA2C").val(FECHA2);
                $("#HORAC").val(HORA);
                $("#MENSAJECC").val(MENSAJE);

                $("#confirmarC").modal('show');
            }else{
                toastr.info("Algunos campos estan vacios.");
            }
        }
        function enviarCC()
        {
            $("#confirmarC").modal('hide');
            $("#formContracto").submit();
        }
    </script>

    <script>
        document.getElementById('emailContratacion').addEventListener('input', function() {
            campo = event.target;
            valido = document.getElementById('emailOK');
                
            emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
            //Se muestra un texto a modo de ejemplo, luego va a ser un icono
            if (emailRegex.test(campo.value)) {
                valido.innerText = "";
            } else {
                valido.innerText = "incorrecto";
            }
        });
    </script>

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
        $( document ).ready(function() {
            $("#cargando").css("display", "none");
            var aceptoSoli = {!! $artista->userConfig->ACEPTO_SOLICITUDES_DE_DEDICATORIAS !!};
            var aceptoContrato = {!! $artista->userConfig->ACEPTO_CONTRATOS !!};
            if (aceptoSoli == 26) {
                $("#PnlPedirDedicatoria").css("display", "block");
                if (aceptoContrato == 26) {
                    $("#PnlcontainerContratar").css("display", "none");
                }
            }else if(aceptoContrato == 26){
                $("#PnlcontainerContratar").css("display", "block");
                $("#valorDedicatoria").text('');
                if (aceptoSoli == 26) {
                    $("#PnlPedirDedicatoria").css("display", "none");
                }
            }
        });
    </script>

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
            $('.PnlcontainerContratar').hide();
            $('.PnlPedirDedicatoria').show();
           
            $('.content-wrapper').css('margin-bottom',0);

            var valorDedicatoria = "<?php echo number_format($artista->userConfig->PRECIO_DEDICATORIA); ?>";
            $("#valorDedicatoria").text("$ "+valorDedicatoria);

            //var style = window.getComputedStyle(document.getElementById('content-wrapper'));
            //var marginBottom = style.getPropertyValue('margin-bottom'); 

        }

        function contratar(){
            $('.colPosts').hide();
            $('.PnlPedirDedicatoria').hide();
            $('.PnlcontainerContratar').show();
            $('.main-footer').hide();
            $('.content-wrapper').css('margin-bottom',0);
            $("#valorDedicatoria").text('');
        }
    </script>

    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <script>toastr.info("{{$error}}")</script>
        @endforeach
    @endif

@endsection