@extends ('templates.admin.layouts.default')

@section('head')
@endsection



@section('content')
    <section class="content-header">
        <h1>
            Movimientos
            <small>Listado de movimientos</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin') }}">
                    <i class="fa fa-dashboard"></i> Home
                </a>
            </li>
            <li class="active">
                <a href="{{ route('movimientos.movimientos.index') }}">Movimientos</a>
            </li>
        </ol>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-header" style="padding: 15px;">
                        <h3 class="box-title">Movimientos</h3>

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
                                    <th>ID</th>
                                    <th>REALIADO POR</th>
                                    <th>PARA</th>
                                    <th class="text-center">TIPO DE MOVIMIENTO</th>
                                    <th>COSTO TOTAL</th>
                                    <th class="text-center">ESTADO</th>
                                    <th class="text-center">FECHA</th>
                                    <th class="text-center">ACCIÓN</th>
                                </tr>                                
                                @foreach ($movimientos as $item)

                                    @if ($item->ID_TIPO === 31)
                                        <tr>
                                            <td> {{ $item->ID }} </td>
                                            <td> {{ $item->userCliente->first()->name }} </td>
                                            <td> {{ $item->userArtista->first()->name }} </td>
                                            <td class="text-center"> {{ $item->tipoMovimiento->first()->NOMBRE }} </td>
                                            <td> {{ number_format($item->COSTO_TOTAL, 2) }} </td>
                                            <td class="text-center"> {{ $item->estado->first()->NOMBRE }} </td>
                                            <td class="text-center"> {{ $item->CREATED_AT }} </td>
                                            <td class="text-center">
                                                <a class="btn btn-app" href="" data-toggle="modal" data-target="#myModal-{{ $item->ID}}">
                                                    <i class="fa fa-info"></i> Información
                                                </a>
                                            </td>
                                            @include('administracion.movimientos.show')
                                        </tr>
                                    @elseif($item->ID_TIPO === 32)
                                        <tr>
                                            <td> {{ $item->ID }}</td>
                                            <td> {{ $item->userCliente->first()->name }} </td>
                                            <td> {{ $item->userArtista->first()->name }} </td>
                                            <td class="text-center"> {{ $item->tipoMovimiento->first()->NOMBRE }} </td>
                                            <td> {{ number_format($item->COSTO_TOTAL, 2) }} </td>
                                            <td class="text-center"> {{ $item->estado->first()->NOMBRE }} </td>
                                            <td class="text-center"> {{ $item->CREATED_AT }} </td>
                                            <td class="text-center">
                                                <a class="btn btn-app" href="" data-toggle="modal" data-target="#myModal-{{ $item->ID}}">
                                                    <i class="fa fa-info"></i> Información
                                                </a>
                                            </td>
                                            @include('administracion.movimientos.show')
                                        </tr>
                                    @elseif($item->ID_TIPO === 39)
                                        <tr>
                                            <td> {{ $item->ID }}</td>
                                            <td> {{ $item->userArtista->first()->name }}</td>
                                            <td> Administrador </td>
                                            <td class="text-center"> {{ $item->tipoMovimiento->first()->NOMBRE }} </td>
                                            <td> {{ number_format($item->COSTO_TOTAL, 2) }} </td>
                                            <td class="text-center"> {{ $item->estado->first()->NOMBRE }} </td>
                                            <td class="text-center"> {{ $item->CREATED_AT }} </td>
                                            <td class="text-center">
                                                <a class="btn btn-app" href="" data-toggle="modal" data-target="#myModal-{{ $item->ID}}">
                                                    <i class="fa fa-info"></i> Información
                                                </a>
                                            </td>
                                            @include('administracion.movimientos.show')
                                        </tr>
                                    @elseif($item->ID_TIPO === 50)
                                        <tr>
                                            <td> {{ $item->ID }}</td>
                                            <td> {{ $item->userCliente->first()->name }}</td>
                                            <td> {{ $item->userCliente->first()->name }}</td>
                                            <td class="text-center"> {{ $item->tipoMovimiento->first()->NOMBRE }} </td>
                                            <td> {{ number_format($item->COSTO_TOTAL, 2) }} </td>
                                            <td class="text-center"> {{ $item->estado->first()->NOMBRE }} </td>
                                            <td class="text-center"> {{ $item->CREATED_AT }} </td> 
                                            <td class="text-center">
                                                <a class="btn btn-app" href="" data-toggle="modal" data-target="#myModal-{{ $item->ID}}">
                                                    <i class="fa fa-info"></i> Información
                                                </a>
                                            </td>
                                            @include('administracion.movimientos.show')
                                        </tr>
                                    @endif

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