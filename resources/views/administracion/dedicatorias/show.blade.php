<div class="modal fade-scale" id="myModal-{{ $item->ID}}">
    <div class="modal-dialog">
        {!!Form::model($item,['method'=>'PATCH','route'=>['dedicatorias.dedicatorias.update',$item->ID], 'files' => true])!!}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="title"> Dedicatorias </h4>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                        {{ Form::label(null, 'Cliente') }}
                        <input type="text" class="form-control input-sm b-5" value="{{ $item->cliente->first()->name }}" readonly>
                    </div>   

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label(null, 'De parte') }}
                                <input type="text" class="form-control input-sm b-5" value="{{ $item->DE_PARTE_DE }}" readonly>
                            </div>   
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label(null, 'Para') }}
                                <input type="text" class="form-control input-sm b-5" value="{{ $item->DIRIGIDO_A }}" readonly>
                            </div>    
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label(null, 'MENSAJE') }}
                        <textarea class="form-control input-sm b-5" cols="2" rows="2" readonly>{{ $item->MENSAJE }} </textarea>
                    </div>          

                    <div class="form-group">
                        {{ Form::label(null, 'Artista o celebridad') }}
                        <input type="text" class="form-control input-sm b-5" value="{{ $item->artista->first()->name }}" readonly>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label(null, 'Costo') }}
                                <input type="text" class="form-control input-sm b-5" value="{{ number_format($item->COSTO_DEDICATORIA, 2) }}" readonly>
                            </div>   
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label(null, 'Estado') }}
                                {!! Form::select('ESTADO', $estados, $item->ID_ESTADO, ['class' => 'form-control', 'placeholder' => 'Seleccione', 'required']) !!}
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
                    <button type="submit" class="btn btn-primary">Actulizar</button>
                </div>
            </div>
        {!!Form::close()!!}
    </div>
</div>
    