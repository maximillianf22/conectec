@extends ('templates.default.layouts.autenticacion_artistas')
@section ('title','Registro de Artistas')
@section('head')
@endsection
@section('body')
    <body class="hold-transition register-page" style="background:#000000">
    <div class="row">
        <div class="col-lg-12 text-center" style="margin-top: 2%;">
            <a href="/">
                <img src="{{ asset('/assets/img/logo.png') }}" alt="Conecte.com">
            </a>
        </div>
        <div class="col-lg-12 pad-lft pad-rgt " >
            <div class="register-box pad-lft pad-rgt  " style="margin-top: 2%;">
            <div class="head-form-register">Registro Nuevo Usuario</div>
            <div class="register-box-body">
              <form id="register-users" name="register-users" action="{{ url('/registroUsuariosPost') }}" method="post" role="form" style="background:#000 !important ">
              <div class="body-form-registro">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="@lang('conecte.name_lastname')" required autofocus>
                        
                    </div>
                    <div class="form-group has-feedback">
                        <input id="email" type="email" class="form-control" name="email"  onkeyup="validarEmail(this)" value="{{ old('email') }}" required placeholder="example@gmail.com ">
                        <div id="resultado" style="font-size:11px;color:#FF578A;padding-left:7px;"></div>
                    </div>

                    <div class="form-group has-feedback">
                        <select class="form-control " name="valueGenero">
                            @foreach($Genero_ as $Genero)
                            <option value="{{$Genero->ID}}" >{{$Genero->NOMBRE}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group has-feedback">
                        <input id="user_date" name="fechanac" type="date" class="form-control"  placeholder="fecha" value="<?php echo date('Y-m-d');?>"  required >
                        <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                        <div id="result_edad" style="font-size:11px;color:#FF578A;padding-left:7px;"></div>
                    </div>

                    <div class="form-group has-feedback">
                        <input id="celular_usuario" type="text" class="validar_number form-control" name="celular_usuario" placeholder="Celular" require >
                        <div id="result_tel" style="font-size:11px;color:#FF578A;padding-left:7px;"></div>
                    </div>
                    
                    <div class="form-group has-feedback">
                        <input id="password" type="password" onkeyup="validarPass(this.value)" class="form-control" name="password" required placeholder="@lang('conecte.password')">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <div id="result_pass" style="font-size:11px;color:#FF578A;padding-left:7px;"></div>
                    </div>
                    <div class="form-group has-feedback">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="@lang('conecte.confirm_password')">
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 text-center" style="margin-bottom: 15px">
                            <div class="checkbox icheck terminos_condiciones ">
                                <label>
                                    <input name="terminos_y_condiciones" type="checkbox"> <a href="{{ url('/assets/img/legal/TYC-USUARIOS.pdf') }}" target="new">@lang('conecte.i_accept_the_terms_and_conditions')</a>
                                </label>
                            </div>
                        </div>
                        
                    </div>
                
                </div>

                <div class="col-xs-12 text-center pad-all btnText">
                    <button type="button" id="registro" class="btn btn-flat btn-registro"  onclick="javascript:calcularEdad();" >Registrarme</button>
                </div>
                
                </form>
                <br />
                <div class="pad-all have-account-artits">
                    <a href="login" class="text-center ">Ya tengo una cuenta registrada, Iniciar Sesión</a>
                </div>
            </div>
           
            <!-- /.form-box -->
            </div>
            <!-- /.register-box -->

        </div>
    
    </div>
    <script>
      function validarSiNumero(numero){
        if (!/^([0-9])*$/.test(numero)){
            if (numero.length > 10) {
                document.getElementById("result_tel").innerHTML="Debe ingresar maximo 10 caracteres";
                document.getElementById("celular_usuario").value="";
            }
            document.getElementById("celular_usuario").value="";
            document.getElementById("result_tel").innerHTML="Debe Ingresar un Numero celular";
            return false;
        }else{
            if (numero.length > 10) {
                document.getElementById("result_tel").innerHTML="Debe ingresar maximo 10 caracteres";
            }else{
                document.getElementById("result_tel").innerHTML="";
            }
            
        }
      }
      function validarPass(password){
        var cont = document.getElementsByClassName('btnText')[0];
        if (!/^(?=(?:.*\d){2})(?=(?:.*[A-Z]){2})(?=(?:.*[a-z]){2})\S{10,}$/.test(password)) {
            if (password.length > 20) {
                document.getElementById("result_pass").innerHTML="Debe ingresar maximo 10 caracteres";
                document.getElementById("password").value="";
            }
            document.getElementById("result_pass").innerHTML="Debe tener almenos 2 mayusculas, 2 minusculas y un maximo de 20 caracteres";
            cont.style.pointerEvents = "none";
        }else{
            document.getElementById("result_pass").innerHTML="";
            cont.style.pointerEvents = "auto";
        }
      }
    </script>
    </body>
@endsection

@section('js')
    <script>
        $("#celular_usuario").inputmask({"mask": "9999999999"});
    </script>
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <script>toastr.info("{{$error}}")</script>
        @endforeach
    @endif
@endsection
