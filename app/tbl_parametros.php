<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_parametros extends Model
{
    protected $table      = "tbl_parametros";
    protected $primaryKey = "ID";
    protected $fillable   = ['ID', 'ID_VALOR', 'NOMBRE', 'DESCRIPCION', 'ID_ESTADO', 'CREATED_AT', 'UPDATED_AT'];
    public $timestamps    = true;

    public function artistas(){
        return $this->hasMany(User::class, 'id_genero', 'ID');
    }
}
