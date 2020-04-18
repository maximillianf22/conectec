<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_negociacion_contratacion extends Model
{
    protected $table      = "tbl_negociacion_contratacion";
    protected $primaryKey = "ID";
    protected $fillable   = ['ID', 'ID_SOLICITUD_DE_CONTRATACION', 'ID_USER', 'ID_ARTISTA', 'ID_CLIENTE', 'MENSAJE,', 'CREATED_AT', 'UPDATE_AT'];
    public $timestamps    = true;

    public function publicadoPor(){
        return $this->hasMany(User::class, 'id', 'ID_USER');
    }

    public function artista(){
        return $this->hasMany(User::class, 'id', 'ID_ARTISTA');
    }

    public function cliente(){
        return $this->hasMany(User::class, 'id', 'ID_CLIENTE');
    }

    
}
