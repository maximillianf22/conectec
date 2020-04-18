<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_agenda_evento extends Model{
    protected $table      = "tbl_agenda_eventos";
    protected $primaryKey = "id";
    protected $fillable   = ['id', 'nombreEvento', 'descripcionEvento', 'imagenEvento', 'urlEvento', 'idState'];
    public $timestamps    = true;
}