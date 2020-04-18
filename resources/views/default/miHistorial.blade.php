@extends ('templates.default.layouts.default')
@section ('title','Historial')
@section('head')    
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <style>
        .content-wrapper{
            background-color: #1f1f1f;
            background-image: inherit;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <br />
        <div class="row pad-all">
            <div class="col-md-6 pad-all ">
                <div class="mov-history pad-all">
                    <div class="titleMovimientos pad-all">@lang('conecte.records_dedications')</div>
                    @if(sizeof($historialDeDedicatorias)>=1)
                    @foreach ($historialDeDedicatorias as $item)
                        <div class="media">
                            <div class="media-left">
                                <a href="/artista/{{$item->ID_ARTISTA}}" class="ad-click-event">
                                    <img src="{{ asset('assets/img/artistas')}}/{{$item->artista->first()->foto_perfil}}" alt="{{$item->artista->first()->name}}" class="media-object img-circle" style="max-height: 70px;">
                                </a>
                            </div>
                            <div class="media-body pad-lft ">
                                <div class="clearfix">
                                    <p class="pull-right ">
                                        <a href="/ver-respuesta/{{$item->ID}}" class="btn btn-success btn-sm ad-click-event btnVerResppuesta answer-solicitud">
                                            Respuesta
                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                        </a>
                                    </p>
        
                                    <div class="name-author" style="margin-top: 0; color:white; margin-bottom: 3px;">{{$item->artista->first()->name}}</div>
                                    <div class="description-solicitud">
                                        <p>{{$item->MENSAJE}}</p>
                                        <p class="info-dedicartoria">
                                            <i class="fa fa-calendar-check-o margin-r5"></i> {{$item->CREATED_AT}} - {{ number_format($item->COSTO_DEDICATORIA, 2) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @else
                    <div class="nofilterFoundPendientes">
                        No has realizado dedicartorias aun
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6 pad-all">
            <div class="mov-history pad-all">
                <div class="titleMovimientos pad-all">@lang('conecte.hiring_history')</div>
                @if(sizeof($historialDeContratacion)>=1)
                @foreach ($historialDeContratacion as $item)
                    <div class="media">
                        <div class="media-left">
                            @if ($user->id_perfil === 0)
                                <a href="/artista/{{$item->ID_ARTISTA}}" class="ad-click-event">
                                    <img src="/upload/perfil/{{$item->artista->first()->foto_perfil}}" alt="{{$item->artista->first()->name}}" class="media-object img-circle" style="max-height: 70px;">
                                </a>    
                            @elseif($user->id_perfil === 1)
                                <a href="#" class="ad-click-event">
                                    <img src="/upload/perfil/{{$item->cliente->first()->foto_perfil}}" alt="{{$item->cliente->first()->name}}" class="media-object img-circle" style="max-height: 70px;">
                                </a>  
                            @endif
                        </div>
                        <div class="media-body">
                            <div class="clearfix">
                                <p class="pull-right">
                                    <a href="{{URL::action('NegociacionesController@show', $item->ID)}}" class="btn btn-success btn-sm ad-click-event btnVerResppuesta">                                       
                                        {!! $item->estado->first()->NOMBRE !!}                                     
                                        <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                    </a>
                                </p>
    
                                @if ($user->id_perfil === 0)
                                    <h4 style="margin-top: 0; color:white; margin-bottom: 3px;">{{$item->artista->first()->name}}</h4>
                                @elseif($user->id_perfil === 1)
                                    <h4 style="margin-top: 0; color:white; margin-bottom: 3px;">{{$item->cliente->first()->name}}</h4>
                                @endif
    
                                <p style="opacity: 0.42;color:white;font-size: 12px;">{{$item->MENSAJE}}</p>
                                <p style="margin-bottom: 0; opacity: 0.60; color: white;">
                                    <i class="fa fa-calendar-check-o margin-r5"></i> {{$item->CREATED_AT}} - {{ number_format($item->COSTO_DEDICATORIA, 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                <div class="nofilterFoundPendientes">
                    No ha relizado Contrataciones aun
                </div>
                @endif
            </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $('#example1').DataTable({
                'lengthChange': false,
            });
            $('#example2').DataTable({
                'lengthChange': false,
            });
        })
    </script>
@endsection