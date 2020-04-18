@extends ('templates.admin.layouts.default')

@section('head')
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Contratación
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin') }}">
                    <i class="fa fa-dashboard"></i> Home
                </a>
            </li>
            <li>
                <a href="{{ route('contrataciones.contrataciones.index') }}">contrataciones</a>
            </li>
            <li class="active">
                <a href="{{ route('contrataciones.contrataciones.show', ['id'=>$contratacion->ID]) }}">contratación</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Contratación</h3>      
                        <div class="pull-right">
                            <button type="button" class="btn btn-default btn-sm" data-widget="collapse">
                                {{ $contratacion->estado->first()->NOMBRE }}
                            </button>
                        </div>  
                    </div>
                    <div class="box-body">
                        <form role="form">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group" style="margin-bottom: 0;">
                                        <label>Ubicación</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" readonly value="{{ $contratacion->PAIS }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" readonly value="{{ $contratacion->CIUDAD }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" readonly value="{{ $contratacion->DIRECCION }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group" style="margin-bottom: 0;">
                                         <label>Datos personales</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" readonly value="{{ $contratacion->NOMBRES }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" readonly value="{{ $contratacion->TELEFONO }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group" style="margin-bottom: 0;">
                                        <label>Fecha tentativa</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" readonly value="{{ $contratacion->DESDE }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" readonly value="{{ $contratacion->HASTA }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" readonly value="{{ $contratacion->HORA }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group" style="margin-bottom: 0;">
                                        <label>Artista o celebridad</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" readonly value="{{ $contratacion->artista->first()->name }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group" style="margin-bottom: 0;">
                                        <label>Mensaje</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" readonly> {{ $contratacion->MENSAJE }} </textarea>
                                    </div>
                                </div>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="box box-primary direct-chat direct-chat-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Negociación</h3>
                    </div>

                    <div class="box-body">
                        <div class="direct-chat-messages">
                            <div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-right">{{$contratacion->cliente->first()->name}}</span>
                                    <span class="direct-chat-timestamp pull-left">{{$contratacion->CREATED_AT}}</span>
                                </div>
                                <img class="direct-chat-img" src="{{ asset('assets/img/clientes/'.$contratacion->cliente->first()->foto_perfil) }}" alt="{{$contratacion->cliente->first()->name}}">
                                <div class="direct-chat-text">{{$contratacion->MENSAJE}}</div>
                            </div>

                            @foreach ($negociacion as $item)
                                @if ($item->publicadoPor->first()->id_perfil == 1)
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-left">{{ $item->artista->first()->nombre_artistico }}</span>
                                            <span class="direct-chat-timestamp pull-right">{{$item->CREATED_AT}}</span>
                                        </div>
                                        <img class="direct-chat-img" src="{{ asset('assets/img/artistas/'.$item->artista->first()->foto_perfil) }}" alt="{{$item->cliente->first()->name}}">
                                        <div class="direct-chat-text">{{$item->MENSAJE}}</div>
                                    </div>
                                @elseif($item->publicadoPor->first()->id_perfil == 0)
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-right">{{$item->cliente->first()->name}}</span>
                                            <span class="direct-chat-timestamp pull-left">{{$item->CREATED_AT}}</span>
                                        </div>
                                        <img class="direct-chat-img" src="{{ asset('assets/img/clientes/'.$item->cliente->first()->foto_perfil) }}" alt="{{$item->cliente->first()->name}}">
                                        <div class="direct-chat-text">{{$item->MENSAJE}}</div>
                                    </div>
                                @endif
                            @endforeach
                        </div>        
                    </div>

                    {{-- 
                    <div class="box-footer">
                        @if($contratacion->ID_ESTADO !== 48 && $contratacion->ID_ESTADO !== 49)
                            {!!Form::open(array('url'=>'/negociacion','method'=>'POST','autocomplete'=>'off'))!!}
                                <div class="input-group" data-children-count="1">
                                    <input type="hidden" name="ID_SOLICITUD_DE_CONTRATACION" value="{{$contratacion->ID}}">
                                    <input type="text" name="message" placeholder="Escriba su mensaje ..." class="form-control">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-flat">Enviar</button>
                                    </span>
                                </div>
                            {!!Form::close()!!}
                        @endif
                    </div>
                    --}}

                </div>
            </div>

            <div class="col-xs-12">
                @if($contratacion->ID_ESTADO === 35 || $contratacion->ID_ESTADO === 46)
                    <a class="btn btn-primary" data-toggle="modal" data-target="#myModalCanelar" style="text-transform: uppercase;">
                        <i class="fa fa-close" style="padding-right: 5px;font-size: large;"></i> Cancelar contrato
                    </a>  
                @endif

                @if($contratacion->ID_ESTADO === 47)
                    <a class="btn btn-primary" data-toggle="modal" data-target="#myModalFinalizar" style="text-transform: uppercase;">
                        <i class="fa fa-close" style="padding-right: 5px;font-size: large;"></i> Finalizar contrato
                    </a>                    
                @endif

                @if($contratacion->ID_ESTADO === 49 || $contratacion->ID_ESTADO === 48)
                    <a class="btn btn-primary" data-toggle="modal" data-target="#myModalActivar" style="text-transform: uppercase;">
                        <i class="fa fa-close" style="padding-right: 5px;font-size: large;"></i> Activar contrato
                    </a>
                @endif




            </div>
        </div>
    </section>

@endsection

@section('js')
    <div class="modal fade-scale" id="myModalCanelar" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            {!! Form::model($contratacion->ID, array('method'=>'PATCH', 'route' => array('formularioDeContratacion.formularioDeContratacion.update', $contratacion->ID))) !!}
                <input type="hidden" name="TIPO" value="2">
                <div class="modal-content ">
                    <div class="modal-header text-center">
                        <h4 class="modal-title">Cancelar contrato</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p>Esta completamente seguro que desea cancelar el contrato</p>                                            
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 0px;">
                        <button type="button" class="btn btn-primary btn-sm waves-effect waves-ligh f-14" data-dismiss="modal">Cancelar</button>
                        <button type="sumit" class="btn btn-primary btn-sm waves-effect waves-ligh f-14">
                            <i class="feather icon-save"> </i> Si, cancelar 
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>


    @if (count($contratacion->formulario) > 0)
        <div class="modal fade-scale" id="myModalFinalizar" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                {!! Form::model($contratacion->formulario->first(), array('method'=>'PATCH', 'route' => array('formularioDeContratacion.formularioDeContratacion.update', $contratacion->formulario->first()->ID))) !!}
                    <input type="hidden" name="TIPO" value="1">
                    <div class="modal-content ">
                        <div class="modal-header text-center">
                            <h4 class="modal-title">Finalizar contrato</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">            
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p>Esta completamente seguro que desea finalizar el contrato</p>                                            
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="border-top: 0px;">
                            <button type="button" class="btn btn-primary btn-sm waves-effect waves-ligh f-14" data-dismiss="modal">Cancelar</button>
                            <button type="sumit" class="btn btn-primary btn-sm waves-effect waves-ligh f-14">
                                <i class="feather icon-save"> </i> Si, finalizar 
                            </button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    @endif

   

    <div class="modal fade-scale " id="myModalActivar" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            {!! Form::model($contratacion->ID, array('method'=>'PATCH', 'route' => array('formularioDeContratacion.formularioDeContratacion.update', $contratacion->ID))) !!}
                <input type="hidden" name="TIPO" value="4">
                <div class="modal-content ">
                    <div class="modal-header text-center">
                        <h4 class="modal-title">Activar contrato</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p>Esta completamente seguro que desea activar el contrato</p>                                            
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 0px;">
                        <button type="button" class="btn btn-primary btn-sm waves-effect waves-ligh f-14" data-dismiss="modal">Cancelar</button>
                        <button type="sumit" class="btn btn-primary btn-sm waves-effect waves-ligh f-14">
                            <i class="feather icon-save"> </i> Si, activar 
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection