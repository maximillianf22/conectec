<section class="content">
    <div class="row">

        <div class="col-md-4">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-black" style="background: url('/assets/img/web/fondo.png') center center;">
                    <h3 class="widget-user-username">{{ $user->name }}</h3>
                    <h5 class="widget-user-desc">{{ $user->tipoUsuario->first()->NOMBRE }}</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('assets/img/artistas/'.$user->foto_perfil) }}" alt="{{ $user->name }}">
                </div>
                <div class="box-footer">
                <br />
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{ count($user->peticiones) }}</h5>
                                <span class="description-text">@lang('conecte.dedications')</span>
                            </div>
                        </div>
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{ count($user->contrataciones) }}</h5>
                                <span class="description-text">@lang('conecte.hirings')</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header">{{ count($user->posts) }}</h5>
                                <span class="description-text">@lang('conecte.publications')</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="info-box bg-yellow" style="background-color: #f4f4f4 !important; border-radius: 15px;">
                        <div class="info-box-content" style="margin-left:0px;padding: 10px 15px">
                            <span class="info-box-text" style="color: #2f2f2f; text-transform: inherit; font-weight: bold;">@lang('conecte.available')</span>
                            <span class="info-box-number" style="color: #2f2f2f; text-transform: inherit; font-weight: bold; font-size: 30px;font-size: 20px;">${{ number_format($totalDisponibles, 2) }}</span>

                            <!--
                            <span class="progress-description" style="color: #2f2f2f; text-transform: inherit; font-weight: 500;opacity: 0.39; font-size: 12px;">
                                @lang('conecte.balance') ${{ number_format($balance, 2) }}
                            </span>
                            -->
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="small-box bg-red" style="background-color: #f4f4f4 !important; border-radius: 15px;">
                        <div class="inner">
                            <h5 style="padding-bottom: 45px;color: #2f2f2f; text-transform: inherit; font-weight: bold;opacity: 0.79;">@lang('conecte.draw_out')</h5>
                        </div>
                        <div class="icon" style="top: -15px; display: block">
                            <img src="{{ asset('assets/img/sacar.png') }}" alt="sacar" style="cursor: pointer;" data-toggle="modal" data-target="#myModal">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-8">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#transaciones" data-toggle="tab">@lang('conecte.transactions')</a>
                    </li>
                    <li>
                        <a href="#perfil" data-toggle="tab">@lang('conecte.profile_information')</a>
                    </li>
                    <li>
                        <a href="#servicios" data-toggle="tab">@lang('conecte.services')</a>
                    </li>
                    <li>
                        <a href="#pass" data-toggle="tab">@lang('conecte.password')</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="active tab-pane" id="transaciones">
                        <ul class="products-list product-list-in-box">
                            @foreach ($movimientos as $item)
                                <li class="item" style="border:none !important ">
                                    @if ($item->ID_TIPO === 31)
                                        <div class="product-img">
                                            <img class="img-circle" src="{{ asset('assets/img/clientes/'.$item->userCliente->first()->foto_perfil) }}" alt="">                                            
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title" style="color: #333; ">{{ $item->tipoMovimiento->first()->NOMBRE }}
                                                <div class="label pull-right price " style="color: #333 !important;  ">+ ${{ number_format($item->COMICION_ARTISTA, 2) }}
                                                    <br>
                                                    <div class="label pull-right state-service" style="color: #333 !important; ">{{ $item->estado->first()->NOMBRE }}</div>
                                                </div>
                                            </a>
                                            <span class="product-description" style="color: #333; font-size: small;">
                                                Barranquilla - Colombia
                                                <br>
                                                <span style="font-size: xx-small">{{ date('d F, Y', strtotime($item->CREATED_AT)) }}</span>
                                            </span>
                                        </div>
                                    @elseif($item->ID_TIPO === 32)
                                        <div class="product-img">
                                            <img class="img-circle" src="{{ asset('assets/img/clientes/'.$item->userCliente->first()->foto_perfil) }}" alt="Product Image">                                            
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title" style="color: #333">{{ $item->tipoMovimiento->first()->NOMBRE }}
                                                <span class="label pull-right" style="color: #333 !important;  background: #f4f4f4 !important">+ ${{ number_format($item->COMICION_ARTISTA, 2) }}</span>
                                                <br>
                                                <span class="label pull-right" style="color: #333 !important; background: #f4f4f4 !important">{{ $item->estado->first()->NOMBRE }}</span>
                                            </a>
                                            <span class="product-description" style="color: #333; font-size: small;">
                                                Barranquilla - Colombia
                                                <br>
                                                <span style="font-size: xx-small">{{ date('d F, Y', strtotime($item->CREATED_AT)) }}</span>
                                            </span>
                                        </div>
                                    @elseif($item->ID_TIPO === 39)
                                        <div class="product-img">
                                            <img src="{{ asset('assets/img/logoPeso.svg') }}" alt="Product Image">
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title" style="color: #333; ">{{ $item->tipoMovimiento->first()->NOMBRE }}
                                                <div class="label pull-right price" > - ${{ number_format($item->COSTO_TOTAL, 2) }}
                                                    <br>
                                                    <div class="label pull-right state-service" style="color: #333 !important;">{{ $item->estado->first()->NOMBRE }}</div>
                                                </div>
                                            </a>
                                            <span class="product-description" style="color: #333; font-size: small;">
                                                Barranquilla - Colombia
                                                <br>
                                                <span style="font-size: xx-small">{{ date('d F, Y', strtotime($item->CREATED_AT)) }}</span>
                                            </span>
                                        </div>

                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        <div class="pad-all text-center">
                            <a href="/mis-movimientos" class="uppercase">Ver todas las transacciones</a>
                        </div>
                    </div>

                    <div class="tab-pane" id="perfil">
                        <form class="form-horizontal" method="POST" action="{{ route('actulizarArtista') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            
                            <input type="hidden" name="TIPO" value="0">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nombres</label>                
                                <div class="col-sm-10">
                                    <input type="text" name="NAME" class="form-control" value="{{$user->name}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nombre Artistico</label>                
                                <div class="col-sm-10">
                                    <input type="text" name="NAMEART" class="form-control" value="{{$user->nombre_artistico}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Correo electronico</label>
                                <div class="col-sm-10">
                                    <input type="email" name="EMAIL" class="form-control" value="{{$user->email}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Imagen de perfil</label>                
                                <div class="col-sm-10">
                                    <input type="file" name="FOTO_PERFIL"  capture="camera" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Genero</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="GENERO" style="width: 100%">
                                        @foreach ($generos as $item)
                                            @if ($item->ID == $user->id_genero)
                                                <option selected value="{{$item->ID}}">{{$item->NOMBRE}}</option>
                                            @else   
                                                <option value="{{$item->ID}}">{{$item->NOMBRE}}</option>
                                            @endif                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Imagen de portada</label>                
                                <div class="col-sm-10">
                                    <input type="file" name="FOTO_PORTADA">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                                </div>
                            </div>
                        </form>
                    </div>     
                    
                    <div class="tab-pane" id="servicios">
                        <form class="form-horizontal" method="POST" action="{{ route('actulizarArtista') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <input type="hidden" name="TIPO" value="1">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Acepta solicitudes para dedicatorias</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="ACEPTO_SOLICITUDES_DE_DEDICATORIAS" style="width: 100%">
                                        @if ($user->configuraciones->first()->ACEPTO_SOLICITUDES_DE_DEDICATORIAS == 26)
                                            <option value="26" selected>Si, Acepto</option>
                                            <option value="27" >No, Acepto</option>
                                        @else
                                            <option value="26" >Si, Acepto</option>
                                            <option value="27" selected>No, Acepto</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Precio por dedicatoria</label>
                                <div class="col-sm-10">
                                    <input type="number" name="PRECIO_DEDICATORIA" class="form-control" placeholder="0.00" value="{{$user->configuraciones->first()->PRECIO_DEDICATORIA}}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Acepta solicitudes para contratación</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="ACEPTO_CONTRATOS" style="width: 100%">
                                        @if ($user->configuraciones->first()->ACEPTO_CONTRATOS == 26)
                                            <option value="26" selected>Si, Acepto</option>
                                            <option value="27" >No, Acepto</option>
                                        @else
                                            <option value="26" >Si, Acepto</option>
                                            <option value="27" selected>No, Acepto</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </div>
    
                        </form>
                    </div>

                    <div class="tab-pane" id="pass">
                        <form class="form-horizontal" id="passArtista" method="POST" action="{{ route('actulizarArtista') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <input type="hidden" name="TIPO" value="2">

                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Contraseña</label>                
                                <div class="col-sm-10">
                                    <input type="password" id="password" onkeyup="validarPass(this.value)" name="password" class="form-control">
                                    <div id="result_pass" style="font-size:11px;color:#FF578A;padding-left:7px;"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Confirmar contraseña</label>                
                                <div class="col-sm-10">
                                    <input type="password" name="password_confirmation" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group btnText">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button onclick="ejecutarForm()" class="btn btn-primary">Cambiar contraseña</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<div class="modal fade-scale " id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        {!!Form::open(array('url'=>'/transacciones','method'=>'POST','autocomplete'=>'off'))!!}
            <div class="modal-content ">
                <div class="modal-header text-center d-none">
                    <h4 class="modal-title">Solicitud de liquidación</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('ID_ARTISTA', $user->id) }}

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label f-w-600">Total disponible</label>
                                {{ Form::text('MI_BILLETERA', number_format($balance, 2), ['class' => 'form-control', 'required', 'readonly']) }}
                            </div>                           
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label f-w-600">Cantidad a retirar</label>
                                {{ Form::text('RETIRAR', null, ['class' => 'form-control', 'required','placeholder' => '0.00' ]) }}
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 0px;">
                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-ligh f-14" data-dismiss="modal">Cancelar</button>
                    <button type="sumit" class="btn btn-primary btn-sm waves-effect waves-ligh f-14">
                        <i class="feather icon-save"> </i> Solicitar 
                    </button>
                </div>
            </div>
        {!!Form::close()!!}
    </div>
</div>

<script>
    function ejecutarForm(){
        $("#passArtista").submit();
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