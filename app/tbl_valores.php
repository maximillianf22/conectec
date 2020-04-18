<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_valores extends Model
{
    protected $table      = "tbl_valores";
    protected $primaryKey = "ID";
    protected $fillable   = ['ID', 'NOMBRE', 'DESCRIPCION', 'ID_ESTADO', 'CREATED_AT', 'UPDATED_AT'];
    public $timestamps    = true;
}
