<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_solicitudes_de_liquidacion extends Model
{
    protected $table      = "tbl_solicitudes_de_liquidacion";
    protected $primaryKey = "ID";
    protected $fillable   = ['ID', 'ID_ARTISTA', 'CANTIDAD', 'ID_MOVIMIENTO', 'ID_ESTADO', 'CREATED_AT', 'UPDATED_AT'];
    public $timestamps    = true;

    public function artista(){
        return $this->hasMany(User::class, 'id', 'ID_ARTISTA');
    }
}
