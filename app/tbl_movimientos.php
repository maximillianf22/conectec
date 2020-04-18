<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_movimientos extends Model
{
    protected $table      = "tbl_movimientos";
    protected $primaryKey = "ID";
    protected $fillable   = ['ID', 'ID_ARTISTA', 'ID_CLIENTE', 'ID_TIPO', 'ID_ESTADO', 'COSTO_TOTAL', 'PORCENTAJE_PLATAFORMA', 'COMICION_PLATAFORMA', 'PORCENTAJE_ARTISTA', 'COMICION_ARTISTA', 'SOPORTE', 'CREATED_AT', 'UPDATE_AT'];
    public $timestamps    = true;


    public function tipoMovimiento(){
        return $this->hasMany(tbl_parametros::class, 'ID', 'ID_TIPO');
    }

    public function userArtista(){
        return $this->hasMany(User::class, 'id', 'ID_ARTISTA');
    }


    public function userCliente(){
        return $this->hasMany(User::class, 'id', 'ID_CLIENTE');
    }

    public function estado(){
        return $this->hasMany(tbl_parametros::class, 'ID', 'ID_ESTADO');
    }

    public function scopeNombreHacePv($query, $nombreHacePv)
    {
        if (trim($nombreHacePv) != "")
        {
            $query->whereHas('userArtista', function($q) use($nombreHacePv){
                $q->where(DB::raw("name"), "LIKE", "%$nombreHacePv%");
            });
        }
    }


}


