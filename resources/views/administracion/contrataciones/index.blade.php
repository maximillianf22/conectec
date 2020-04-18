@extends ('templates.admin.layouts.default')

@section('head')
@endsection

@section('content')

    <section class="content-header">
        <h1>
            Contrataciones
            <small>Listado de Contrataciones</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin') }}">
                    <i class="fa fa-dashboard"></i> Home
                </a>
            </li>
            <li class="active">
                <a href="{{ route('contrataciones.contrataciones.index') }}">contrataciones</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('administracion.contrataciones.search')                
            </div>

            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Contrataciones</h3>        
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th class="text-center">ID</th>
                                <th>CLIENTE</th>
                                <th>ARTISTA</th>
                                <th>DIRECCIÓN</th>
                                <th>TELEFONO</th>
                                <th>CIUDAD</th>
                                <th>FECHA</th>
                                <th>ESTADO</th>
                                <th class="text-center">ACCIÓN</th>
                            </tr>                       

                            @foreach ($contrataciones as $item)
                                <tr>
                                    <td class="text-center">{{ $item->ID }}</td>
                                    <td>{{ $item->cliente->first()->name }}</td>
                                    <td>{{ $item->artista->first()->nombre_artistico }}</td>
                                    <td>{{ $item->DIRECCION }}</td>
                                    <td>{{ $item->TELEFONO }}</td>
                                    <td>{{ $item->CIUDAD }}</td>
                                    <td>{{ $item->CREATED_AT }}</td>
                                    <td>{{ $item->estado->first()->NOMBRE }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-app" href="{{ route('contrataciones.contrataciones.show', ['id' => $item->ID]) }}">
                                            <i class="fa fa-info"></i> Información
                                        </a>
                                    </td>
                                </tr>
                            @endforeach 
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection