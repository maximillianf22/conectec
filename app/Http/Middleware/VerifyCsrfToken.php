<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/video/crear',
        '/artista/login',
        '/artista/dedicatoria',
        'artista/dedicatoria/historial',
        '/artista/dedicatoria/responder',
        '/artista/movimientos',
        '/artista/liquidacion',
        '/cliente/generos',
        '/cliente/artistas',
        '/cliente/movimientos',
        '/cliente/saldo',
        '/cliente/list/pendientes',
        '/cliente/genero/artista',
        '/clientes/search',
        '/cliente/list/finalizados',
        '/cliente/solicitar/dedicatoria',
        '/cliente/login',
        '/cliente/registro',
        '/payu/confirmation',
        'cliente/contratacion/detalle',
        'cliente/contratacion/send/messaje',
        'cliente/estado/contratacion',
        'cliente/editarPerfil',
        'cliente/generos/celebridades',
        '/payu/confirmation/recarga',
    ];
}
