@extends ('templates.default.layouts.default')
@section ('title','Mis movimientos')
@section('head')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <style>
        .content-wrapper{background-color: #1f1f1f;background-image: inherit;}
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row pad-all">
            <div class="col-12 pad-all ">
                <div class="titleMovimientos pad-all">@lang('conecte.transactions_and_movements')</div>
            </div>
            <div class="container-fluid containerMovimientos">
                @if(sizeof($movimientos)>=1)
                @foreach ($movimientos as $item)
                    <div class="box1">
                        <div class="box-body1">
                            <ul class="products-list product-list-in-box">
                                <li class="item" style="background: transparent;border:none !important">
                                    @if ($item->ID_TIPO === 31 && $user->id_perfil === 0)
                                        <div class="product-img">
                                            <img class="img-circle" src="{{asset('assets/img/clientes')}}/{{$item->userArtista->first()->foto_perfil}}" alt="">                                            
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title" style="opacity: 0.96;">{{ $item->tipoMovimiento->first()->NOMBRE }}
                                                <div class="label pull-right price" >- {{ number_format($item->COSTO_TOTAL, 2) }}
                                                <br>
                                                <div class="label  pull-right state-service">{{ $item->estado->first()->NOMBRE }}</div>
                                                </div>
                                            </a>
                                            <span class="product-description" >
                                                <div class="name-artist">{{$item->userArtista->first()->name}}</div>
                                                <br>
                                                <span style="font-size: xx-small">{{ $item->CREATED_AT }}</span>
                                            </span>
                                        </div>
                                    @elseif($item->ID_TIPO === 31 && $user->id_perfil === 1)
                                        <div class="product-img">
                                            <img class="img-circle" src="{{ asset('assets/img/clientes/'.$item->userCliente->first()->foto_perfil) }}" alt="">                                            
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title" >{{ $item->tipoMovimiento->first()->NOMBRE }}
                                                <div class="label pull-right price" >- {{ number_format($item->COSTO_TOTAL, 2) }}
                                                <br>
                                                <div class="label  pull-right state-service">{{ $item->estado->first()->NOMBRE }}</div>
                                                </div>
                                            </a>
                                            <span class="product-description" style="opacity: 0.36;font-size: small;">
                                                <div class="name-artist">{{$item->userCliente->first()->name}}</div>
                                                <br>
                                                <span style="font-size: xx-small">{{ $item->CREATED_AT }}</span>
                                            </span>
                                        </div>
                                    @elseif($item->ID_TIPO === 32 && $user->id_perfil === 0)
                                        <div class="product-img">
                                            <img class="img-circle" src="{{ asset('assets/img/clientes/'.$item->userArtista->first()->foto_perfil) }}" alt="">                                            
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title" style="opacity: 0.96;">{{ $item->tipoMovimiento->first()->NOMBRE }}
                                            <div class="label pull-right price" >- {{ number_format($item->COSTO_TOTAL, 2) }}
                                                <br>
                                                <div class="label  pull-right state-service">{{ $item->estado->first()->NOMBRE }}</div>
                                                </div>
                                            </a>
                                            <span class="product-description" style="opacity: 0.36;font-size: small;">
                                                <div class="name-artist">{{$item->userArtista->first()->name}}</div>
                                                <br>
                                                <span style="font-size: xx-small">{{ $item->CREATED_AT }}</span>
                                            </span>
                                        </div>
                                    @elseif($item->ID_TIPO === 32 && $user->id_perfil === 1)
                                        <div class="product-img">
                                            <img class="img-circle" src="{{ asset('assets/img/clientes/'.$item->userCliente->first()->foto_perfil) }}" alt="">                                            
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title" style="opacity: 0.96;">{{ $item->tipoMovimiento->first()->NOMBRE }}
                                                <div class="label pull-right price" >- {{ number_format($item->COSTO_TOTAL, 2) }}
                                                <br>
                                                <div class="label  pull-right state-service">{{ $item->estado->first()->NOMBRE }}</div>
                                                </div>
                                            </a>
                                            <span class="product-description" style="opacity: 0.36;font-size: small;">
                                                <div class="name-artist">{{$item->userCliente->first()->name}}</div>
                                                <br>
                                                <span style="font-size: xx-small">{{ $item->CREATED_AT }}</span>
                                            </span>
                                        </div>
                                    @elseif($item->ID_TIPO === 39)
                                        <div class="product-img">
                                            <img class="img-circle" src="{{ asset('assets/img/artistas/'.$item->userArtista->first()->foto_perfil) }}" alt="">                                            
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title" style="opacity: 0.96;">{{ $item->tipoMovimiento->first()->NOMBRE }}
                                                <span class="label label-warning pull-right" style="color: #2f2f2f !important; opacity: 0.79; background: #f4f4f4 !important">- {{ number_format($item->COSTO_TOTAL, 2) }}</span>
                                                <br>
                                                
                                                @if($item->estado->first()->ID == 40)
                                                    <a href="{{ asset('/upload/soportes/liquidaciones/'. $item->SOPORTE ) }}" download>
                                                        <span class="label label-warning pull-right" style="color: #2f2f2f !important; opacity: 0.79; background: #f4f4f4 !important">{{ $item->estado->first()->NOMBRE }} - Soporte</span>
                                                    </a>
                                                @else
                                                    <span class="label label-warning pull-right" style="color: #2f2f2f !important; opacity: 0.79; background: #f4f4f4 !important">{{ $item->estado->first()->NOMBRE }}</span>
                                                @endif
                                                
                                            </a>
                                            <span class="product-description" style="opacity: 0.36;font-size: small;">
                                                <div class="name-artist">{{$item->userArtista->first()->name}}</div>
                                                <br>
                                                <span style="font-size: xx-small">{{ $item->CREATED_AT }}</span>
                                            </span>
                                        </div>  
                                    @elseif($item->ID_TIPO === 40)
                                        <div class="product-img">
                                            <img class="img-circle" src="{{ asset('assets/img/artistas/'.$item->userArtista->first()->foto_perfil) }}" alt="">                                            
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title" style="opacity: 0.96;">{{ $item->tipoMovimiento->first()->NOMBRE }}
                                                <span class="label label-warning pull-right" style="color: #2f2f2f !important; opacity: 0.79; background: #f4f4f4 !important">- {{ number_format($item->COSTO_TOTAL, 2) }}</span>
                                                <br>
                                                <span class="label label-warning pull-right" style="color: #2f2f2f !important; opacity: 0.79; backgroun<div class="label pull-right price" >- {{ number_format($item->COSTO_TOTAL, 2) }}
                                                <br>
                                                <div class="label  pull-right state-service">{{ $item->estado->first()->NOMBRE }}</div>
                                                </div>d: #f4f4f4 !important">{{ $item->estado->first()->NOMBRE }}</span>
                                            </a>
                                            <span class="product-description" style="opacity: 0.36;font-size: small;">
                                                <div class="name-artist">{{$item->userCliente->first()->name}}</div>
                                                <br>
                                                <span style="font-size: xx-small">{{ $item->CREATED_AT }}</span>
                                            </span>
                                        </div>
                                    @elseif($item->ID_TIPO === 50 && $user->id_perfil === 0)
                                        <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title" >{{ $item->tipoMovimiento->first()->NOMBRE }}
                                                <div class="label pull-right price" >+ {{ number_format($item->COSTO_TOTAL, 2) }}
                                                <br>
                                                <div class="label  pull-right state-service">{{ $item->estado->first()->NOMBRE }}</div>
                                                </div>
                                            </a>
                                            <span class="product-description" style="opacity: 0.36;font-size: small;">
                                                <div class="name-artist">{{$item->userCliente->first()->name}}</div>
                                                <br>
                                                <span style="font-size: xx-small">{{ $item->CREATED_AT }}</span>
                                            </span>
                                        </div>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
                @else
                <div class="nofilterFoundPendientes">
                        No has realizado transacciones en nuestra plataforma
                    </div>
                @endif

                <div class="box">
                    <div class="box-body1">
                        {{ $movimientos->render() }}
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
            })
        })
    </script>
@endsection