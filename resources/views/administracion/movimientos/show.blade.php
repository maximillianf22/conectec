@if ($item->ID_TIPO === 31)
    <div class="modal fade-scale" id="myModal-{{ $item->ID}}">
        <div class="modal-dialog">
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="title">{{ $item->tipoMovimiento->first()->NOMBRE }} de {{ $item->userCliente->first()->name }} </h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Realizado por') }}
                                    {{ Form::text('NOMBRE', $item->userCliente->first()->name, ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Para') }}
                                    {{ Form::text('NOMBRE', $item->userArtista->first()->name, ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>    
                            </div>
                        </div>
                        
                        <div class="form-group">
                            {{ Form::label(null, 'Costo total') }}
                            {{ Form::text('NOMBRE', number_format($item->COSTO_TOTAL, 2), ['class' => 'form-control input-sm b-5', 'readonly']) }}
                        </div> 

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Porcentaje plataforma') }}
                                    {{ Form::text('NOMBRE', $item->PORCENTAJE_PLATAFORMA, ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Comición plataforma') }}
                                    {{ Form::text('NOMBRE',  number_format($item->COMICION_PLATAFORMA, 2), ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>   
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Porcentaje artista') }}
                                    {{ Form::text('NOMBRE', $item->PORCENTAJE_ARTISTA, ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Comición artista') }}
                                    {{ Form::text('NOMBRE',  number_format($item->COMICION_ARTISTA, 2), ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>   
                            </div>
                        </div>                        

                        <div class="form-group">
                            {{ Form::label(null, 'FECHA') }}
                            {{ Form::text('NOMBRE', $item->CREATED_AT, ['class' => 'form-control input-sm b-5', 'readonly']) }}
                        </div>     

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@elseif($item->ID_TIPO === 32)
    <div class="modal fade-scale" id="myModal-{{ $item->ID}}">
        <div class="modal-dialog">
            <form>
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
                                    {{ Form::text('NOMBRE', $item->userCliente->first()->name, ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Para') }}
                                    {{ Form::text('NOMBRE', $item->userArtista->first()->name, ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>    
                            </div>
                        </div>
                        
                        <div class="form-group">
                            {{ Form::label(null, 'Costo total') }}
                            {{ Form::text('NOMBRE', number_format($item->COSTO_TOTAL, 2), ['class' => 'form-control input-sm b-5', 'readonly']) }}
                        </div> 

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Porcentaje plataforma') }}
                                    {{ Form::text('NOMBRE', $item->PORCENTAJE_PLATAFORMA, ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Comición plataforma') }}
                                    {{ Form::text('NOMBRE',  number_format($item->COMICION_PLATAFORMA, 2), ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>   
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Porcentaje artista') }}
                                    {{ Form::text('NOMBRE', $item->PORCENTAJE_ARTISTA, ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Comición artista') }}
                                    {{ Form::text('NOMBRE',  number_format($item->COMICION_ARTISTA, 2), ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>   
                            </div>
                        </div>                        

                        <div class="form-group">
                            {{ Form::label(null, 'FECHA') }}
                            {{ Form::text('NOMBRE', $item->CREATED_AT, ['class' => 'form-control input-sm b-5', 'readonly']) }}
                        </div>     

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@elseif($item->ID_TIPO === 39)
    <div class="modal fade-scale" id="myModal-{{ $item->ID}}">
        <div class="modal-dialog">
            <form>
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
                                    {{ Form::text('NOMBRE', $item->userCliente->first()->name, ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Para') }}
                                    {{ Form::text('NOMBRE', 'Administración', ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>    
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Valor del retiro') }}
                                    {{ Form::text('NOMBRE', number_format($item->COSTO_TOTAL, 2), ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Estado') }}
                                    {{ Form::text('NOMBRE', $item->estado->first()->NOMBRE, ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>    
                            </div>
                        </div>                                             

                        <div class="form-group">
                            {{ Form::label(null, 'FECHA') }}
                            {{ Form::text('NOMBRE', $item->CREATED_AT, ['class' => 'form-control input-sm b-5', 'readonly']) }}
                        </div>     

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@elseif($item->ID_TIPO === 50)
    <div class="modal fade-scale" id="myModal-{{ $item->ID}}">
        <div class="modal-dialog">
            <form>
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
                                    {{ Form::text('NOMBRE', $item->userCliente->first()->name, ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Para') }}
                                    {{ Form::text('NOMBRE', $item->userCliente->first()->name, ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>    
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Valor del retiro') }}
                                    {{ Form::text('NOMBRE', number_format($item->COSTO_TOTAL, 2), ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label(null, 'Estado') }}
                                    {{ Form::text('NOMBRE', $item->estado->first()->NOMBRE, ['class' => 'form-control input-sm b-5', 'readonly']) }}
                                </div>    
                            </div>
                        </div>                                             

                        <div class="form-group">
                            {{ Form::label(null, 'FECHA') }}
                            {{ Form::text('NOMBRE', $item->CREATED_AT, ['class' => 'form-control input-sm b-5', 'readonly']) }}
                        </div>     

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endif
