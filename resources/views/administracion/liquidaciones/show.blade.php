
<div class="modal fade-scale" id="myModal-{{ $item->ID}}">
    <div class="modal-dialog">
        {!!Form::model($item,['method'=>'PATCH','route'=>['liquidaciones.liquidaciones.update',$item->ID], 'id' => 'formUpdate', 'files' => true])!!}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="title">{{ $item->tipoMovimiento->first()->NOMBRE }} </h4>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label(null, 'Realizado por') }}
                                <input type="text" class="form-control input-sm b-5" value="{{ $item->userCliente->first()->name }}" readonly>
                            </div>   
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label(null, 'Para') }}
                                <input type="text" class="form-control input-sm b-5" value="Administración" readonly>
                            </div>    
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label(null, 'Valor del retiro') }}
                                <input type="text" class="form-control input-sm b-5" value="{{ number_format($item->COSTO_TOTAL, 2) }}" readonly>
                            </div>   
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label(null, 'Estado') }}
                                <input type="text" class="form-control input-sm b-5" value="{{ $item->estado->first()->NOMBRE }}" readonly>
                            </div>    
                        </div>
                    </div>                                             

                    <div class="form-group">
                        {{ Form::label(null, 'FECHA') }}
                        <input type="text" class="form-control input-sm b-5" value="{{ $item->CREATED_AT }}" readonly>
                    </div>

                    {{ Form::hidden('TIPO', '0') }}

                    <div class="form-group">
                        {{ Form::label(null, 'Soporte') }}
                        <input type="file" name="SOPORTE" class="form-control" required>
                    </div>  

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Actulizar</button>
                </div>
            </div>
        {!!Form::close()!!}
    </div>
</div>

<div class="modal fade-scale" id="myModalDelete-{{ $item->ID}}">
        <div class="modal-dialog">
            {!! Form::open([ 'method'  => 'delete', 'route' => [ 'liquidaciones.liquidaciones.destroy', $item->ID ] ]) !!}

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="title">{{ $item->tipoMovimiento->first()->NOMBRE }} </h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Realizado por') }}
                                    <input type="text" class="form-control input-sm b-5" value="{{ $item->userCliente->first()->name }}" readonly>
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Para') }}
                                    <input type="text" class="form-control input-sm b-5" value="Administración" readonly>
                                </div>    
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Valor del retiro') }}
                                    <input type="text" class="form-control input-sm b-5" value="{{ number_format($item->COSTO_TOTAL, 2) }}" readonly>
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Estado') }}
                                    <input type="text" class="form-control input-sm b-5" value="{{ $item->estado->first()->NOMBRE }}" readonly>
                                </div>    
                            </div>
                        </div>                                             
    
                        <div class="form-group">
                            {{ Form::label(null, 'FECHA') }}
                            <input type="text" class="form-control input-sm b-5" value="{{ $item->CREATED_AT }}" readonly>
                        </div>    
                        
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Rechazar</button>
                    </div>
                </div>

            {!!Form::close()!!}
        </div>
    </div>
