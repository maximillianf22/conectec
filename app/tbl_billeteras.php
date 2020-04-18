<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_billeteras extends Model
{
    protected $table      = "tbl_billeteras";
    protected $primaryKey = "ID";
    protected $fillable   = ['ID', 'ID_USER', 'SALDO', 'SALDO_TOTAL', 'CREATED_AT', 'UPDATE_AT'];
    public $timestamps    = true;
}
