<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_formulario_de_pago_contratacion extends Model
{
    protected $table      = "tbl_formulario_de_pago_contratacion";
    protected $primaryKey = "ID";
    protected $fillable   = ['ID', 'ID_SOLICITUD_DE_CONTRATACION', 'PRECIO', 'CREATED_AT', 'UPDATE_AT'];
    public $timestamps    = true;

}
