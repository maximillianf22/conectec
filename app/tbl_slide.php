<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class tbl_slide extends Model{
    protected $table      = "tbl_slides";
    protected $primaryKey = "id";
    protected $fillable   = ['nombreSlider', 'descripcionSlider', 'urlLink', 'imgSlider,', 'idState', 'created_at', 'update_at'];
    public $timestamps    = true;
}
