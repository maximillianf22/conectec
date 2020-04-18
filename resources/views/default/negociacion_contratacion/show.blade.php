@extends ('templates.default.layouts.default')

@section ('title','Negociación')

@section('head')
    <style>
        .main-footer{
            display: none;
        }
        .content-wrapper{
            margin-bottom: 0px !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 contenidoPrincipal">
                <div class="container-fluid artista" >
                    <div class="row rowNombre" id="rowNombre">
                        <div class="col-12">
                            <p class="peticiones">{{ count($artista->peticiones) }} peticiones</p>
                            <h1 class="title">{{$artista->name}}</h1>
                        </div>

                        <div class="col-md-12"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid containerContratar">
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal">
                    <div class="box-body">
                        {{ csrf_field() }}
                        <input type="hidden" name="ID_ARTISTA" value="{{$artista->id}}">
                        <p class="ubicacion">Ubicación</p>
                        <div class="form-group">
                            <div class="col-sm-4">
                                <input name="CIUDAD" type="text" class="form-control" placeholder="Ciudad" value="{{ $contratacion->CIUDAD }}" readonly>
                            </div>
                            <div class="col-sm-4">
                                <input name="PAIS" type="text" class="form-control" placeholder="País" value="{{ $contratacion->PAIS }}" readonly>
                            </div>
                            <div class="col-sm-4">
                                <input name="DIRECCION" type="text" class="form-control" placeholder="Dirección" value="{{ $contratacion->DIRECCION }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Datos personales</label>
                            <div class="col-sm-7">
                                <input name="NAME" type="text" class="form-control" placeholder="Nombre y apellido" value="{{ $contratacion->NOMBRES }}" readonly>
                            </div>
                            <div class="col-sm-3">
                                <input name="TELEFONO" type="number" class="form-control" placeholder="Teléfono" value="{{ $contratacion->TELEFONO }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha tentativa</label>
                            <div class="col-sm-3">
                                <input name="DESDE" type="date" class="form-control" placeholder="Desde" value="{{ $contratacion->DESDE }}" readonly>
                            </div>
                            <div class="col-sm-3">
                                <input name="HASTA" type="date" class="form-control" placeholder="hasta" value="{{ $contratacion->HASTA }}" readonly>
                            </div>
                            <div class="col-sm-4">
                                <input name="HORA" type="time" class="form-control" placeholder="horas" value="{{ $contratacion->HORA }}" readonly>
                            </div>
                        </div>

                        <div class="form-group textAndEnviar" style="margin-bottom: 50px">
                            <div class="col-sm-11">
                                <textarea name="MENSAJE" class="form-control" cols="2" rows="2" readonly>{{ $contratacion->MENSAJE }}</textarea>
                            </div>
                            <div class="col-sm-1 colSend">
                                <button type="submit" class="btn btn-app btnSend">
                                    <i class="fa fa-paper-plane fa-3"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <div class="col-md-12">
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
                                            <span class="direct-chat-name pull-left">{{ $item->artista->first()->name }}</span>
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

                </div>
            </div>


            <div class="col-md-12">
                @if ($user->id_perfil === 0)

                    @if ($contratacion->ID_ESTADO === 46)
                        <a class="btn btn-primary" data-toggle="modal" data-target="#myModalPagar" style="text-transform: uppercase;">
                            <i class="fa fa-shopping-cart" style="padding-right: 5px;font-size: large;"></i> Pagar contrato
                        </a>
                    @elseif($contratacion->ID_ESTADO === 47)
                        <a class="btn btn-primary" style="text-transform: uppercase;">
                            <i class="fa fa-shopping-cart" style="padding-right: 5px;font-size: large;"></i> Contrato pagado
                        </a>
                    @endif

                @elseif($user->id_perfil === 1)
                        
                    @if($contratacion->ID_ESTADO === 35)
                        <a class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="text-transform: uppercase;">
                            <i class="fa fa-shopping-cart" style="padding-right: 5px;font-size: large;"></i> Activar formulario de pago para el cliente
                        </a>
                    @endif
                    
                    @if($contratacion->ID_ESTADO === 46)
                        <a class="btn btn-primary" data-toggle="modal" data-target="#myModalModificar" style="text-transform: uppercase;">
                            <i class="fa fa-shopping-cart" style="padding-right: 5px;font-size: large;"></i> Actualizar formulario de pago para el cliente
                        </a>
                    @endif

                    @if($contratacion->ID_ESTADO === 35 || $contratacion->ID_ESTADO === 46)
                        <a class="btn btn-primary" data-toggle="modal" data-target="#myModalCanelar" style="text-transform: uppercase;">
                            <i class="fa fa-close" style="padding-right: 5px;font-size: large;"></i> Cancelar contrato
                        </a>  
                    @endif

                    @if($contratacion->ID_ESTADO === 47)
                        <a class="btn btn-primary" style="text-transform: uppercase;">
                            <i class="fa fa-shopping-cart" style="padding-right: 5px;font-size: large;"></i> Contrato pagado
                        </a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#myModalFinalizar" style="text-transform: uppercase;">
                            <i class="fa fa-close" style="padding-right: 5px;font-size: large;"></i> Finalizar contrato
                        </a>                    
                    @endif

                    @if($contratacion->ID_ESTADO === 49 || $contratacion->ID_ESTADO === 48)
                        <a class="btn btn-primary" data-toggle="modal" data-target="#myModalActivar" style="text-transform: uppercase;">
                            <i class="fa fa-close" style="padding-right: 5px;font-size: large;"></i> Activar contrato
                        </a>
                    @endif


                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    @if ($user->id_perfil === 0 && (count($contratacion->formulario) > 0))
        <div class="modal fade-scale " id="myModalPagar" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                {!! Form::model($contratacion, array('method'=>'PATCH', 'route' => array('contratos.contratos.update', $contratacion->ID))) !!}
                    <div class="modal-content ">
                        <div class="modal-header text-center">
                            <h4 class="modal-title">Pagar contrato</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p> Esta completamente seguro de pagar <strong> {{ number_format($contratacion->formulario->first()->PRECIO, 2) }} </strong> a <strong> {{$artista->name}} </strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="border-top: 0px;">
                            <button type="button" class="btn btn-primary btn-sm waves-effect waves-ligh f-14" data-dismiss="modal">No</button>
                            <button type="sumit" class="btn btn-primary btn-sm waves-effect waves-ligh f-14">
                                <i class="feather icon-save"> </i> Si, pagar 
                            </button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    @elseif($user->id_perfil === 1)
        @if (count($contratacion->formulario) > 0)
            <div class="modal fade-scale" id="myModalModificar" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    {!! Form::model($contratacion->formulario->first(), array('method'=>'PATCH', 'route' => array('formularioDeContratacion.formularioDeContratacion.update', $contratacion->formulario->first()->ID))) !!}
                        <input type="hidden" name="TIPO" value="0">
                        <div class="modal-content ">
                            <div class="modal-header text-center">
                                <h4 class="modal-title">Actualizar formulario de pago</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">            
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label f-w-600">Precio del contrato</label>
                                            {{ Form::number('PRECIO', $contratacion->formulario->first()->PRECIO, ['class' => 'form-control', 'required', 'placeholder' => '0.00' ]) }}
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" style="border-top: 0px;">
                                <button type="button" class="btn btn-primary btn-sm waves-effect waves-ligh f-14" data-dismiss="modal">Cancelar</button>
                                <button type="sumit" class="btn btn-primary btn-sm waves-effect waves-ligh f-14">
                                    <i class="feather icon-save"> </i> Actualizar 
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>

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

            <div class="modal fade-scale" id="myModalActivar" tabindex="-1" role="dialog">
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

            
        @else
            <div class="modal fade-scale " id="myModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    {!!Form::open(array('url'=>'/formularioDeContratacion','method'=>'POST','autocomplete'=>'off'))!!}
                        <div class="modal-content ">
                            <div class="modal-header text-center">
                                <h4 class="modal-title">Habilitar formulario de pago</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <input type="hidden" name="ID_SOLICITUD_DE_CONTRATACION" value="{{$contratacion->ID}}">
            
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label f-w-600">Precio del contrato</label>
                                            {{ Form::number('PRECIO', null, ['class' => 'form-control', 'required', 'placeholder' => '0.00' ]) }}
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" style="border-top: 0px;">
                                <button type="button" class="btn btn-primary btn-sm waves-effect waves-ligh f-14" data-dismiss="modal">Cancelar</button>
                                <button type="sumit" class="btn btn-primary btn-sm waves-effect waves-ligh f-14">
                                    <i class="feather icon-save"> </i> Activar 
                                </button>
                            </div>
                        </div>
                    {!!Form::close()!!}
                </div>
            </div> 

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

        @endif
    @endif




@endsection