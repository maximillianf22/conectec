<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_solicitudes_de_dedicatorias extends Model
{
    protected $table      = "tbl_solicitudes_de_dedicatorias";
    protected $primaryKey = "ID";
    protected $fillable   = ['ID', 'ID_ARTISTA', 'ID_CLIENTE', 'ID_ESTADO', 'DE_PARTE_DE', 'DIRIGIDO_A', 'MENSAJE', 'COSTO_DEDICATORIA', 'ID_MOVIMIENTO', 'CREATED_AT', 'UPDATE_AT'];
    public $timestamps    = true;

    public function artista(){
        return $this->hasMany(User::class, 'id', 'ID_ARTISTA');
    }

    public function cliente(){
        return $this->hasMany(User::class, 'id', 'ID_CLIENTE');
    }

    public function estado(){
        return $this->hasMany(tbl_parametros::class, 'ID', 'ID_ESTADO');
    }
}
