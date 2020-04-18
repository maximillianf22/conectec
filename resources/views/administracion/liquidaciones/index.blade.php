@extends ('templates.admin.layouts.default')

@section('head')
@endsection



@section('content')
    <section class="content-header">
        <h1>
            Liquidaciones
            <small>Listado de liquidaciones</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin') }}">
                    <i class="fa fa-dashboard"></i> Home
                </a>
            </li>
            <li class="active">
                <a href="{{ route('liquidaciones.liquidaciones.index') }}">liquidaciones</a>
            </li>
        </ol>
    </section>
    
    <section class="content">
        <div class="row">

            <div class="col-xs-12">
                {!! Form::open(array('url'=>'administrador/liquidaciones','method'=>'GET','autocomplete'=>'off','role'=>'search', 'class'=>'input-group w100')) !!}
                    <div class="box">
                        <div class="box-header" style="padding: 15px;">
                            <h3 class="box-title">Buscador</h3>
                        </div>
                        <div class="box-body">                            
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::label(null, 'Artista o celebridad') }}
                                <input type="text" class="form-control" name="NOMBRE" value="{{ $nombre}}"> 
                                </div>

                                <div class="col-md-6">
                                    {{ Form::label(null, 'ESTADO') }}
                                    {!! Form::select('ESTADO', $estados, $estado, ['class' => 'form-control', 'placeholder' => 'Seleccione']) !!} 
                                </div>
                            </div>                        
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-default" onclick='location.href = "/administrador/liquidaciones";'>Cancelar</button>
                            <button type="submit" class="btn btn-info pull-right">Buscar</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>

            <div class="col-xs-12">


                <div class="box">

                    <div class="box-header" style="padding: 15px;">
                        <h3 class="box-title">Liquidaciones</h3>

                        <div class="box-tools" style="top: 8px;">
                            <div class="input-group input-group-sm" style="width: 150px;margin-right: 50px;">
                                {!! Form::open(array('url'=>'administrador/artistas','method'=>'GET','autocomplete'=>'off','role'=>'search', 'class'=>'input-group')) !!}
                                    <input type="text" name="query" class="form-control pull-right" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                {{Form::close()}}
                            </div>
                            <button type="button" class="btn btn-default" style="position: absolute; right: 0; top: 0; display: none" data-toggle="tooltip" data-placement="top" title="Agregar nuevo cliente">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>REALIADO POR</th>
                                    <th>PARA</th>
                                    <th class="text-center">TIPO DE MOVIMIENTO</th>
                                    <th class="text-center">VALOR RETIRO</th>
                                    <th class="text-center">ESTADO</th>
                                    <th class="text-center">FECHA</th>
                                    <th class="text-center">ACCIÓN</th>
                                </tr>                                
                                @foreach ($movimientos as $item)
                                    </tr>
                                        <td class="text-center"> {{ $item->ID }} </td>
                                        <td> {{ $item->userCliente->first()->name }} </td>
                                        <td> {{ $item->userArtista->first()->nombre_artistico }} </td>
                                        <td class="text-center"> {{ $item->tipoMovimiento->first()->NOMBRE }} </td>
                                        <td class="text-center"> {{ number_format($item->COSTO_TOTAL, 2) }} </td>
                                        <td class="text-center"> {{ $item->estado->first()->NOMBRE }} </td>
                                        <td class="text-center"> {{ $item->CREATED_AT }} </td>
                                        <td class="text-center">
                                            @if (!empty($item->SOPORTE))
                                                <a href="{{ asset('/upload/soportes/liquidaciones/'. $item->SOPORTE ) }}" download> 
                                                    <span class="label label-success">Descargar</span> 
                                                </a>
                                            @else
                                                <a class="btn btn-app" href="" data-toggle="modal" data-target="#myModal-{{ $item->ID}}">
                                                    <i class="fa fa-check"></i> Aprobar
                                                </a>
                                                <a class="btn btn-app" href="" data-toggle="modal" data-target="#myModalDelete-{{ $item->ID}}">
                                                    <i class="fa fa-close"></i> Rechazar
                                                </a>
                                            @endif
                                        </td>
                                        @include('administracion.liquidaciones.show')
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="box-footer clearfix">
                        {{ $movimientos->render() }}
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
@endsection