<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_configuraciones_artistas extends Model
{
    protected $table      = "tbl_configuraciones_artistas";
    protected $primaryKey = "ID";
    protected $fillable   = ['ID', 'ID_ARTISTA', 'PRECIO_DEDICATORIA,', 'ACEPTO_SOLICITUDES_DE_DEDICATORIAS', 'ACEPTO_CONTRATOS', 'COMICION_DECICATORIAS', 'COMICION_CONTRATOS', 'CREATED_AT', 'UPDATE_AT'];
    public $timestamps    = true;
}
