<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_solicitudes_de_contratacion extends Model
{
    protected $table      = "tbl_solicitudes_de_contratacion";
    protected $primaryKey = "ID";
    protected $fillable   = ['ID', 'ID_ARTISTA', 'ID_CLIENTE', 'ID_ESTADO', 'COSTO', 'CIUDAD', 'PAIS', 'DIRECCION', 'NOMBRES', 'TELEFONO', 'DESDE', 'HASTA', 'HORA', 'MENSAJE', 'ID_MOVIMIENTO', 'CREATED_AT', 'UPDATE_AT'];
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

    public function formulario(){
        return $this->hasMany(tbl_formulario_de_pago_contratacion::class, 'ID_SOLICITUD_DE_CONTRATACION', 'ID');
    }

}
