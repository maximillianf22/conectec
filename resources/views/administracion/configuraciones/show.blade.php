@extends ('templates.admin.layouts.default')

@section('title')
{{$configuraciones->NOMBRE}}
@endsection


@section('content')

    <section class="content-header">
        <h1>
            Parametros de {{$configuraciones->NOMBRE}}
            <small>Listado de parametros</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin') }}">
                    <i class="fa fa-dashboard"></i> Home
                </a>
            </li>
            <li class="active">
                <a href="{{ route('configuraciones.configuraciones.index') }}">configuraciones</a>
            </li>
            <li class="active">
                <a href="{{ route('configuraciones.configuraciones.show', ['id'=>$configuraciones->ID]) }}">{{$configuraciones->NOMBRE}}</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="box-title">Configuraciones</h3>
                        </div>
                        @if($ID == 1 || $ID == 14)
                        <div class="col-md-6 text-right">
                            <a href="#" data-toggle="modal" data-target="#crear" class="btn btn-info">Agregar</a>
                        </div>
                        @endif
                    </div>
                    
                  </div>
                  <div class="box-body">
                        <table id="example" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRE</th>
                                    <th>DESCRIPCIÓN</th>
                                    <th>FECHA DE CREACIÓN</th>
                                    <th>ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parametros as $item)
                                    <tr>
                                        <td>{{ $item->ID }}</td>
                                        <td>{{ $item->NOMBRE }}</td>
                                        <td>{{ $item->DESCRIPCION }}</td>
                                        <td>{{ $item->CREATED_AT }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-app" onclick="editCofing('{{$item->ID}}', '{{$item->NOMBRE}}', '{{$item->DESCRIPCION}}')">
                                                <i class="fa fa-edit"></i> Actualizar
                                            </a>
                                            {{--<a href="{{URL::action('ConfiguracionesController@show', $item->ID)}}" class="btn btn-app">
                                                <i class="fa fa-eye"></i> Parameters--}}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                  </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')

    <div class="modal fade-scale" id="crear">
        <div class="modal-dialog">
            {!! Form::open(['action' => 'ConfiguracionesController@store', 'enctype' => 'multipart/form-data']) !!}
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">{{$configuraciones->NOMBRE}} </h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            {{ Form::label(null, 'Nombre') }}
                            {{ Form::text('NOMBRE', null, ['class' => 'form-control input-lg b-5', 'required', 'autocomplete' => 'off']) }}
                        </div>     
                        <input type="hidden" name="type" value="{{$ID}}">
                        <div class="form-group">
                            {{ Form::label(null, 'Descripción') }}
                            {{ Form::text('DESCRIPCION', null, ['class' => 'form-control input-lg b-5', 'required', 'autocomplete' => 'off']) }}
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <input type="file" name="imagen" id="imagen" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="modal fade-scale" id="myModal">
        <div class="modal-dialog">
            {!!Form::model($configuraciones,['method'=>'PATCH','route'=>['valoresConguraciones.valoresConguraciones.update',0], 'id' => 'formUpdate'])!!}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="title">Rename </h4>
                    </div>
                    <div class="modal-body">
                        {{ Form::hidden('ID', '0', ['ID' => 'ID']) }}

                        <div class="form-group">
                            {{ Form::label(null, 'Nombre') }}
                            {{ Form::text('NOMBRE', null, ['class' => 'form-control input-lg b-5', 'ID' => 'NOMBRE_DE_CONFIGURACIONES', 'required']) }}
                        </div>     
                        
                        <div class="form-group">
                            {{ Form::label(null, 'Descripción') }}
                            {{ Form::text('DESCRIPCION', null, ['class' => 'form-control input-lg b-5', 'ID' => 'DESCRIPCION_DE_CONFIGURACIONES', 'required']) }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            {!!Form::close()!!}
        </div>
    </div>


    <script>
        $(function () {
          $('#example').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            "bInfo"       : false,
            "order"       : ['0', 'DESC']
          })
        })

        function editCofing(id, name, descripcion){
            var title = "Cambiar nombre de \"" + name + "\" a";
            $('#title').text(title);
            $('#NOMBRE_DE_CONFIGURACIONES').val(name);
            $('#DESCRIPCION_DE_CONFIGURACIONES').val(descripcion);
            $('#ID').val(id);

            $("#formUpdate").attr("action", "{{ route('valoresConguraciones.valoresConguraciones.index') }}/" + id);

            $('#myModal').modal('toggle');
        }
    </script>
@endsection