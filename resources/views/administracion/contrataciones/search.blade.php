{!! Form::open(array('url'=>'administrador/contrataciones','method'=>'GET','autocomplete'=>'off','role'=>'search', 'class'=>'input-group w100')) !!}
    <div class="box">
        <div class="box-header" style="padding: 15px;">
            <h3 class="box-title">Buscador</h3>
        </div>
        <div class="box-body">                            
            <div class="row">
                <div class="col-md-6">
                    {{ Form::label(null, 'Cliente') }}
                <input type="text" class="form-control" name="NOMBRE" value="{{ $nombre }}"> 
                </div>

                <div class="col-md-6">
                    {{ Form::label(null, 'ESTADO') }}
                    {!! Form::select('ESTADO', $estados, $estado, ['class' => 'form-control', 'placeholder' => 'Seleccione']) !!} 
                </div>
            </div>                        
        </div>
        <div class="box-footer">
            <button type="button" class="btn btn-default" onclick='location.href = "/administrador/contrataciones";'>Cancelar</button>
            <button type="submit" class="btn btn-info pull-right">Buscar</button>
        </div>
    </div>
{!! Form::close() !!}