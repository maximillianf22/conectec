<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_post_artistas extends Model
{
    protected $table      = "tbl_post_artistas";
    protected $primaryKey = "ID";
    protected $fillable   = ['ID', 'ID_ARTISTA', 'NOMBRE', 'IMAGEN', 'EMBED,', 'DESCRIPCION', 'ID_ESTADO', 'CREATED_AT', 'UPDATE_AT'];
    public $timestamps    = true;
}
