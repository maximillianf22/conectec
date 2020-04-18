@extends ('templates.admin.layouts.default')

@section('title')
Clientes | Conecte
@endsection

@section('content')

    <section class="content-header">
        <h1>
            Clientes
            <small>Listado de clientes</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin') }}">
                    <i class="fa fa-dashboard"></i> Home
                </a>
            </li>
            <li class="active">
                <a href="{{ route('clientes.clientes.index') }}">clientes</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="padding: 15px;">
                        <h3 class="box-title">Clientes</h3>

                        <div class="box-tools" style="top: 8px;">
                            <div class="input-group input-group-sm" style="width: 150px;margin-right: 50px;">
                                {!! Form::open(array('url'=>'administrador/clientes','method'=>'GET','autocomplete'=>'off','role'=>'search', 'class'=>'input-group')) !!}
                                    <input type="text" name="query" class="form-control pull-right" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                {{Form::close()}}
                            </div>
                            <button type="button" class="btn btn-default d-none" style="position: absolute; right: 0; top: 0; display: none" data-toggle="tooltip" data-placement="top" title="Agregar nuevo cliente">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>EMAIL</th>
                                <th>ESTADO</th>
                                <th>FECHA</th>
                                <th class="text-center">ACIONES</th>
                            </tr>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->estado->first()->NOMBRE }}</td>
                                    <td>{{ $item->created_at}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-app" href="{{URL::action('UsuariosController@edit', $item->id)}}">
                                            <i class="fa fa-info"></i> Información
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>

                    <div class="box-footer clearfix">
                        {{ $users->render() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection