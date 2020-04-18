@extends ('templates.default.layouts.autenticacion_artistas')
@section ('title','Registro de Artistas')
@section('head')
@endsection
@section('body')
<script>
    $(document).ready(function (){
      $('#telefono_artista').keyup(function (){
        this.value = (this.value + '').replace(/[^0-9]/g, '');
      });
      $('#celular_manager').keyup(function (){
        this.value = (this.value + '').replace(/[^0-9]/g, '');
      });
    });
</script>    
    <body class="hold-transition register-page" style="background:#000000">
    <br />
    <div class="row ">
        <div class="col-lg-2 pad-all  "></div>
        <div class="col-lg-4 pad-all  ">
            <div class="register-box five-razones ">
                <div class="register-logo1 text-center">
                        <a href="/">
                            <img src="{{ asset('/assets/img/logo_registro.png') }}" alt="Conecte.com">
                        </a>
                        <div class="text-center razones" style="font-size:13px; color:#FFF;">
                            5 Razones para hacer parte de Conecte
                        </div>
                </div>
                <div class="info-conecte">
                <br />
                <div class="pad-all" style="padding:15px 70px">
                    <p>Ingresos para ti</p>
                    <p>Conexión con tus fans</p>
                    <p>Promoción como artista</p>
                    <p>Posibilidad de negocios</p>
                    <p>Mantenerse en vigencia</p>
                </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 ">
        
            <div class="register-box">
            
            <div class="head-form-register">Pre Registro Artistas</div>
            <div class="register-box-body">
              <form action="{{ url('/registroArtistaPost') }}" method="post" role="form" style="background:#000 !important ">
              <div class="body-form-registro">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="@lang('conecte.name_lastname')" required autofocus>
                        
                    </div>
                    <div class="form-group has-feedback">
                        <input id="name" type="text" class="form-control" name="nombre_artistico" value="{{ old('name_artistico') }}" placeholder="nombre artistico" required autofocus>
                        
                    </div>

                    <div class="form-group has-feedback">
                        <input id="email" type="email" class="form-control" name="email"  onkeyup="validarEmail(this)"  value="{{ old('email') }}" required placeholder="@lang('conecte.email')">
                        <div id="resultado" style="font-size:11px;color:#FF578A;padding-left:7px;"></div>
                    </div>
                    <div class="form-group has-feedback">
                        <input id="telefono_artista1" type="text" class="form-control" name="telefono_artista" placeholder="telefono artista">
                        <div id="result_tel" style="font-size:11px;color:#FF578A;padding-left:7px;"></div>
                    </div>

                    <div class="form-group has-feedback">
                        <input id="name" type="text" class="form-control" name="name_manager" value="{{ old('name_manager') }}" placeholder="nombre manager"  autofocus>
                    </div>

                    <div class="form-group has-feedback">
                        <input id="email_manager" type="text" class="form-control"  onkeyup="validarEmail1(this)"  name="email_manager" value="{{ old('email_manager') }}" placeholder="email manager"  autofocus>
                        <div id="resultado1" style="font-size:11px;color:#FF578A;padding-left:7px;"></div>
                    </div>

                    <div class="form-group has-feedback">
                        <input id="celular_manager1" type="text" class="form-control" name="celular_manager" placeholder="celular manager">
                        <div id="result_cel" style="font-size:11px;color:#FF578A;padding-left:7px;"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 text-center" style="margin-bottom: 15px">
                            <div class="checkbox icheck terminos_condiciones ">
                                <label>
                                    <input name="terminos_y_condiciones" type="checkbox"> <a href="{{ url('/assets/img/legal/TYC-ARTISTAS.pdf') }}" target="new">@lang('conecte.i_accept_the_terms_and_conditions')</a>
                                </label>
                            </div>
                        </div>
                        
                    </div>
                
                </div>

                    <div class="col-xs-12 text-center pad-all">
                        <button type="submit" class="btn btn-flat btn-registro">enviar</button>
                    </div>
                
                </form>
                <br />
                <div class="pad-all have-account-artits">
                    <a href="login" class="text-center ">Ya tengo una cuenta registrada, iniciar sesión </a>
                </div>
            </div>
            <div class="col-lg-2 pad-all  "></div>
            <!-- /.form-box -->
            </div>
            <!-- /.register-box -->

        </div>
    
    </div>
    
    </body>
@endsection

@section('js')
    <script>
        $("#telefono_artista1").inputmask({"mask": "9999999999"});
        $("#celular_manager1").inputmask({"mask": "9999999999"});
    </script>
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <script>toastr.info("{{$error}}")</script>
        @endforeach
    @endif
@endsection
