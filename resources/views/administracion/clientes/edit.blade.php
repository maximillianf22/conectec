@extends ('templates.admin.layouts.default')

@section('title')
Editar {{$cliente->name}}
@endsection

@section('content')

    <section class="content-header">
        <b style="font-size:18px;">
           Actualizar :  {{$cliente->name}}
        </b>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin') }}">
                    <i class="fa fa-dashboard"></i> Home
                </a>
            </li>
            <li>
                <a href="{{ route('clientes.clientes.index') }}">clientes</a>
            </li>
            <li class="active">
                <a href="{{ URL::action('UsuariosController@edit', $cliente->id) }}">{{$cliente->name}}</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-widget widget-user">
                    <div class="widget-user-header bg-black" style="background: url('/assets/img/web/fondo.png') center center;">
                        <h3 class="widget-user-username">{{ $cliente->name }}</h3>
                        <h5 class="widget-user-desc">{{ $cliente->tipoUsuario->first()->NOMBRE }}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="profile-user-img img-responsive img-circle" src="{{ asset('assets/img/clientes/'.$cliente->foto_perfil) }}" alt="">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ count($cliente->dedicatorias) }}</h5>
                                    <span class="description-text">Dedicatorias</span>
                                </div>
                            </div>
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ count($cliente->contratacionesClientes) }}</h5>
                                    <span class="description-text">contratación</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">${{ number_format($cliente->billetera->first()->SALDO, 2) }}</h5>
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
                                            
                                                <img class="img-circle" src="{{ asset('assets/img/artistas/'.$item->userArtista->first()->foto_perfil) }}" alt="Product Image">                                            
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title" style="color: #2f2f2f; opacity: 0.96;">{{ $item->tipoMovimiento->first()->NOMBRE }}
                                                    <span class="label label-warning pull-right" style="color: #2f2f2f !important; opacity: 0.79; background: #f4f4f4 !important">- ${{ number_format($item->COMICION_ARTISTA, 2) }}</span>
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
                                                <img class="img-circle" src="{{ asset('assets/img/artistas/'.$item->userArtista->first()->foto_perfil) }}" alt="Product Image">                                            
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title" style="color: #2f2f2f; opacity: 0.96;">{{ $item->tipoMovimiento->first()->NOMBRE }}
                                                    <span class="label label-warning pull-right" style="color: #2f2f2f !important; opacity: 0.79; background: #f4f4f4 !important">- ${{ number_format($item->COMICION_ARTISTA, 2) }}</span>
                                                    <br>
                                                    <span class="label label-warning pull-right" style="color: #2f2f2f !important; opacity: 0.79; background: #f4f4f4 !important">{{ $item->estado->first()->NOMBRE }}</span>
                                                </a>
                                                <span class="product-description" style="color: #2f2f2f; opacity: 0.36;font-size: small;">
                                                    Barranquilla - Colombia
                                                    <br>
                                                    <span style="font-size: xx-small">{{ date('d F, Y', strtotime($item->CREATED_AT)) }}</span>
                                                </span>
                                            </div>
                                        @elseif($item->ID_TIPO === 50)
                                            <div class="product-img">
                                                <img src="{{ asset('assets/img/logoPeso.svg') }}" alt="Product Image">
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title" style="color: #2f2f2f; opacity: 0.96;">{{ $item->tipoMovimiento->first()->NOMBRE }}
                                                    <span class="label label-warning pull-right" style="color: #2f2f2f !important; opacity: 0.79; background: #f4f4f4 !important"> + ${{ number_format($item->COSTO_TOTAL, 2) }}</span>
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
                            {!!Form::model($cliente,['method'=>'PATCH','route'=>['clientes.clientes.update',$cliente->id], 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal'])!!}
                                
                                <input type="hidden" name="TIPO" value="1">
    
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nombres</label>                
                                    <div class="col-sm-10">
                                        <input type="text" name="NAME" class="form-control" value="{{$cliente->name}}">
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Correo electronico</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="EMAIL" class="form-control" value="{{$cliente->email}}" readonly>
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Imagen de perfil</label>                
                                    <div class="col-sm-10">
                                        <input type="file" name="FOTO_PERFIL">
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Estado</label>
                                    <div class="col-sm-10">
                                        {!! Form::select('ESTADO', $estados, $cliente->id_estado, ['class' => 'form-control select2', 'placeholder' => 'Seleccione', 'required', 'id' => 'ESTADO']) !!}
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
                                {!!Form::model($cliente,['method'=>'PATCH','route'=>['clientes.clientes.update',$cliente->id], 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal'])!!}
        
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
        
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
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
