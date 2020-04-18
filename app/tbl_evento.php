<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class tbl_evento extends Model{
    protected $table      = "tbl_eventos";
    protected $primaryKey = "id";
    protected $fillable   = ['id', 'nombreEvento', 'DescripcionEvento', 'imgEvento', 'urlEvento', 'created_at','updated_at'];
    public $timestamps    = true;
}
