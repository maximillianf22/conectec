@extends ('templates.admin.layouts.default')

@section('title')
Editar {{$artista->nombre_artistico}}
@endsection

@section('content')

    <section class="content-header">
        <h1>
            Actualizar
            <small>{{$artista->nombre_artistico}}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin') }}">
                    <i class="fa fa-dashboard"></i> Home
                </a>
            </li>
            <li>
                <a href="{{ route('artistas.artistas.index') }}">artistas</a>
            </li>
            <li class="active">
                <a href="{{ URL::action('ArtistasController@edit', $artista->id) }}">{{$artista->name}}</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-widget widget-user">
                    
                    <div class="widget-user-header bg-black" style="background: url('/assets/img/web/fondo.png') center center;">
                        <h3 class="widget-user-username">{{ $artista->name }}</h3>
                        <h5 class="widget-user-desc">{{ $artista->tipoUsuario->first()->NOMBRE }}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ asset('assets/img/artistas/'.$artista->foto_perfil) }}" alt="{{ $artista->name }}">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ count($artista->peticiones) }}</h5>
                                    <span class="description-text">Dedicatorias</span>
                                </div>
                            </div>
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ count($artista->contrataciones) }}</h5>
                                    <span class="description-text">contratación</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">${{ number_format($artista->billetera->first()->SALDO, 2) }}</h5>
                                    <span class="description-text">Billetera</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#transaciones" data-toggle="tab">Transacciones</a>
                        </li>
                        <li>
                            <a href="#perfil" data-toggle="tab">Información de cuenta</a>
                        </li>
                        <li>
                            <a href="#servicios" data-toggle="tab">Servicios</a>
                        </li>
                        <li>
                            <a href="#pass" data-toggle="tab">Cambio de contraseña</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="transaciones">
                            <ul class="products-list product-list-in-box">
                                @foreach ($movimientos as $item)
                                    <li class="item">
                                        @if ($item->ID_TIPO === 31)
                                            <div class="product-img">
                                                <img class="img-circle" src="{{ asset('assets/img/clientes/'.$item->userCliente->first()->foto_perfil) }}" alt="Product Image">                                            
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title" style="color: #2f2f2f; opacity: 0.96;">{{ $item->tipoMovimiento->first()->NOMBRE }}
                                                    <span class="label label-warning pull-right" style="color: #2f2f2f !important; opacity: 0.79; background: #f4f4f4 !important">+ ${{ number_format($item->COMICION_ARTISTA, 2) }}</span>
                                                    <br>
                                                    <span class="label label-warning pull-right" style="color: #2f2f2f !important; opacity: 0.79; background: #f4f4f4 !important">{{ $item->estado->first()->NOMBRE }}</span>
                                                </a>
                                                <span class="product-description" style="color: #2f2f2f; opacity: 0.36;font-size: small;">
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
                                                <a href="javascript:void(0)" class="product-title" style="color: #2f2f2f; opacity: 0.96;">{{ $item->tipoMovimiento->first()->NOMBRE }}
                                                    <span class="label label-warning pull-right" style="color: #2f2f2f !important; opacity: 0.79; background: #f4f4f4 !important">+ ${{ number_format($item->COMICION_ARTISTA, 2) }}</span>
                                                    <br>
                                                    <span class="label label-warning pull-right" style="color: #2f2f2f !important; opacity: 0.79; background: #f4f4f4 !important">{{ $item->estado->first()->NOMBRE }}</span>
                                                </a>
                                                <span class="product-description" style="color: #2f2f2f; opacity: 0.36;font-size: small;">
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
                                                <a href="javascript:void(0)" class="product-title" style="color: #2f2f2f; opacity: 0.96;">{{ $item->tipoMovimiento->first()->NOMBRE }}
                                                    <span class="label label-warning pull-right" style="color: #2f2f2f !important; opacity: 0.79; background: #f4f4f4 !important"> - ${{ number_format($item->COSTO_TOTAL, 2) }}</span>
                                                    <br>
                                                    <span class="label label-warning pull-right" style="color: #2f2f2f !important; opacity: 0.79; background: #f4f4f4 !important">{{ $item->estado->first()->NOMBRE }}</span>
                                                </a>
                                                <span class="product-description" style="color: #2f2f2f; opacity: 0.36;font-size: small;">
                                                    Barranquilla - Colombia
                                                    <br>
                                                    <span style="font-size: xx-small">{{ date('d F, Y', strtotime($item->CREATED_AT)) }}</span>
                                                </span>
                                            </div>
    
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                            <div class="box-footer text-center">
                                {{ $movimientos->render()}}
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="perfil">
                            {!!Form::model($artista,['method'=>'PATCH','route'=>['artistas.artistas.update',$artista->id], 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal'])!!}
                                
                                <input type="hidden" name="TIPO" value="0">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nombre y Apellido</label>                
                                    <div class="col-sm-10">
                                        <input type="text" name="NAME" class="form-control" value="{{$artista->name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nombre Artistico</label>                
                                    <div class="col-sm-10">
                                        <input type="text" name="NAMEART" class="form-control" value="{{$artista->nombre_artistico}}">
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="EMAIL" class="form-control" value="{{$artista->email}}" readonly>
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Imagen de perfil</label>                
                                    <div class="col-sm-10">
                                        <input type="file" name="FOTO_PERFIL">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Genero</label>
                                    <div class="col-sm-10">
                                       
                                       {{--  {!! Form::select('GENERO', $generos, $artista->id_genero, ['class' => 'form-control select2', 'placeholder' => 'Seleccione', 'required', 'id' => 'GENERO']) !!} --}}

                                        <select id="GENERO" name="GENERO" class="form-control select2-single" required>
                                                <optgroup label="Artistas">
                                                    @foreach ($generos as $genero)
                                                        @if($genero->ID_VALOR =='1')
                                                            @if($genero->ID==$artista->id_genero)
                                                            yes 
                                                                <option  value="{{ $genero->ID}}" selected>{{ $genero->NOMBRE}}</option>
                                                            @else
                                                                <option value="{{ $genero->ID}}">{{ $genero->NOMBRE}}</option>
                                                            @endif                                                            
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                                <optgroup label="Celebridades">
                                                    @foreach ($generos as $genero)
                                                        @if($genero->ID_VALOR =='14')
                                                            @if($genero->ID==$artista->id_genero)
                                                            yes 
                                                                <option value="{{ $genero->ID}}" selected>{{ $genero->NOMBRE}}</option>
                                                            @else
                                                                <option value="{{ $genero->ID}}">{{ $genero->NOMBRE}}</option>
                                                            @endif                                                            
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Imagen de fondo</label>                
                                    <div class="col-sm-10">
                                        <input type="file" name="FOTO_PORTADA">
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Estado</label>
                                    <div class="col-sm-10">
                                        {!! Form::select('ESTADO', $estados, $artista->id_estado, ['class' => 'form-control select2', 'placeholder' => 'Seleccione', 'required', 'id' => 'ESTADO']) !!}
                                    </div>
                                </div>
                                
    
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </div>
                            {!!Form::close()!!}
                        </div>    
                        
                        <div class="tab-pane" id="servicios">
                            {!!Form::model($artista,['method'=>'PATCH','route'=>['artistas.artistas.update',$artista->id], 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal'])!!}
                            
                                <input type="hidden" name="TIPO" value="1">
    
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Acepta solicitudes para dedicatorias</label>
                                    <div class="col-sm-10">
                                        {!! Form::select('ACEPTO_SOLICITUDES_DE_DEDICATORIAS', $siNo, $artista->userConfig->ACEPTO_SOLICITUDES_DE_DEDICATORIAS, ['class' => 'form-control select2', 'placeholder' => 'Seleccione', 'required', 'id' => 'ACEPTO_SOLICITUDES_DE_DEDICATORIAS']) !!}
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Precio por dedicatoria</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="PRECIO_DEDICATORIA" class="form-control" placeholder="0.00" value="{{$artista->userConfig->PRECIO_DEDICATORIA}}" >
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Acepta solicitudes para contratación</label>
                                    <div class="col-sm-10">
                                        {!! Form::select('ACEPTO_CONTRATOS', $siNo, $artista->userConfig->ACEPTO_CONTRATOS, ['class' => 'form-control select2', 'placeholder' => 'Seleccione', 'required', 'id' => 'ACEPTO_CONTRATOS']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Comición dedicatoria</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="COMICION_DECICATORIAS" class="form-control" placeholder="0.00" value="{{$artista->userConfig->COMICION_DECICATORIAS}}" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Comición por contrato</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="COMICION_CONTRATOS" class="form-control" placeholder="0.00" value="{{$artista->userConfig->COMICION_CONTRATOS}}" >
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </div>
        
                            {!!Form::close()!!}
                        </div>

                        <div class="tab-pane" id="pass">
                            <div class="container-fluid">
                                {!!Form::model($artista,['method'=>'PATCH','route'=>['artistas.artistas.update',$artista->id], 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal'])!!}
    
                                    <input type="hidden" name="TIPO" value="2">
    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inputName" class="control-label">Contraseña</label>     
                                                <div class="input-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                                    <input type="password" readonly name="password" id="password" class="form-control">   
                                                    <div class="input-group-btn">
                                                        <a href="javascript:;" onclick="generarPass()" class="btn btn-info">Generar <i class="fa fa-key"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">    
                                        <div class="col-md-12">
                                            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                                <label for="inputName" class="control-label">Confirmar contraseña</label>
                                                <input type="password" readonly id="password_confirmation" name="password_confirmation" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-sm-12 text-center">
                                                    <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>        
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <script>toastr.info("{{$error}}")</script>
        @endforeach
    @endif
    <script>
        function generarPass()
        {
            long=8;
            var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789";
            var contraseña = "";
            for (i=0; i<long; i++) contraseña += caracteres.charAt(Math.floor(Math.random()*caracteres.length));
            $("#password").val(contraseña);
            $("#password_confirmation").val(contraseña);
        }
    </script>
@endsection