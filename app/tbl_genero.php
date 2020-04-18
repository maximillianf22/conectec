<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_genero extends Model{
    protected $table      = "tbl_generos";
    protected $primaryKey = "id";
    protected $fillable   = ['id', 'nombreGenero', 'slug', 'descripcionGenero', 'imagenDefault', 'coverDefault', 'idState', 'created_at', 'updated_at'];
    public $timestamps    = true;
}
