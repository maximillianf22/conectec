<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_perfil', 'id_genero', 'name', 'email', 'foto_perfil', 'foto_portada', 'password', 'id_estado', 'confirm_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function configuraciones(){
        return $this->hasMany(tbl_configuraciones_artistas::class, 'ID_ARTISTA', 'id');
    }

    public function userConfig()
    {
        return $this->hasOne('App\tbl_configuraciones_artistas', 'ID_ARTISTA');
    }

    public function peticiones(){
        return $this->hasMany(tbl_solicitudes_de_dedicatorias::class, 'ID_ARTISTA', 'id');
    }

    public function contrataciones(){
        return $this->hasMany(tbl_solicitudes_de_contratacion::class, 'ID_ARTISTA', 'id');
    }

    public function posts(){
        return $this->hasMany(tbl_post_artistas::class, 'ID_ARTISTA', 'id');
    }

    public function tipoUsuario()
    {
      return $this->belongsTo('App\tbl_parametros', 'id_perfil');
    }

    public function estado(){
        return $this->hasMany(tbl_parametros::class, 'ID', 'id_estado');
    }

    public function billetera()
    {
        return $this->hasOne('App\tbl_billeteras', 'ID_USER');
    }

    public function dedicatorias(){
        return $this->hasMany(tbl_solicitudes_de_dedicatorias::class, 'ID_CLIENTE', 'id');
    }

    public function contratacionesClientes(){
        return $this->hasMany(tbl_solicitudes_de_contratacion::class, 'ID_CLIENTE', 'id');
    }

    

}
