@extends ('templates.admin.layouts.default')

@section('head')

@endsection

@section('content')

    <section class="content-header">
        <h1>
            Dedicatorias
            <small>Listado de dedicatorias</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin') }}">
                    <i class="fa fa-dashboard"></i> Home
                </a>
            </li>
            <li class="active">
                <a href="{{ route('dedicatorias.dedicatorias.index') }}">dedicatorias</a>
            </li>
        </ol>
    </section>

    

    <section class="content">
        <div class="row">

            <div class="col-xs-12">
                {!! Form::open(array('url'=>'administrador/dedicatorias','method'=>'GET','autocomplete'=>'off','role'=>'search', 'class'=>'input-group w100')) !!}
                    <div class="box">
                        <div class="box-header" style="padding: 15px;">
                            <h3 class="box-title">Buscador</h3>
                        </div>
                        <div class="box-body">                            
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::label(null, 'Cliente') }}
                                <input type="text" class="form-control" name="NOMBRE" value="{{ $nombre }}"> 
                                </div>

                                <div class="col-md-6">
                                    {{ Form::label(null, 'ESTADO') }}
                                    {!! Form::select('ESTADO', $estados, $estado, ['class' => 'form-control', 'placeholder' => 'Seleccione']) !!} 
                                </div>
                            </div>                        
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-default" onclick='location.href = "/administrador/dedicatorias";'>Cancelar</button>
                            <button type="submit" class="btn btn-info pull-right">Buscar</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>

            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Dedicatorias</h3>        
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th class="text-center">ID</th>
                                <th>CLIENTE</th>
                                <th>DE</th>
                                <th>PARA</th>
                                <th>ARTISTA</th>
                                <th>COSTO</th>
                                <th class="text-center">ESTADO</th>
                                <th class="text-center">FECHA</th>
                                <th class="text-center">ACCIÓN</th>
                            </tr>

                            @foreach ($dedicatorias as $item)
                                <tr>
                                    <td class="text-center">{{ $item->ID }}</td>
                                    <td>{{ $item->cliente->first()->name }}</td>
                                    <td>{{ $item->DE_PARTE_DE }}</td>
                                    <td>{{ $item->DIRIGIDO_A }}</td>
                                    <td>{{ $item->artista->first()->name }}</td>
                                    <td>{{ number_format($item->COSTO_DEDICATORIA, 2) }}</td>
                                    <td class="text-center">{{ $item->estado->first()->NOMBRE}}</td>
                                    <td class="text-center">{{ $item->CREATED_AT}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-app" href="" data-toggle="modal" data-target="#myModal-{{ $item->ID}}">
                                            <i class="fa fa-info"></i> Información
                                        </a>
                                    </td>
                                    @include('administracion.dedicatorias.show')
                                </tr>
                            @endforeach
                            
                        </table>
                    </div>
                </div>
            </div>                  
        </div>
    </section>



@endsection