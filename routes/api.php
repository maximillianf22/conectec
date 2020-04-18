<?php

use Illuminate\Http\Request;

Route::group(['middleware' => 'auth:api'], function () {
    //Api Conecte Artista
    //--Inicio
    Route::post('artista/login', ['uses' => 'Api\Artista\LoginController@store']);
    Route::post('artista/editarPerfil', ['uses' => 'Api\Artista\LoginController@editarPerfil']);
    Route::post('artista/biografia', ['uses' => 'Api\Artista\LoginController@agregarBiografia']);

    //--Dedicatoria
    Route::post('artista/dedicatoria', ['uses' => 'Api\Artista\DedicatoriasController@list']);
    Route::post('artista/dedicatoria/historial', ['uses' => 'Api\Artista\DedicatoriasController@historial']);
    Route::post('artista/dedicatoria/historial/ocultar', ['uses' => 'Api\Artista\DedicatoriasController@ocultarHistorial']);
    Route::post('artista/dedicatoria/responder', ['uses' => 'Api\Artista\DedicatoriasController@responder']);
    //--Movimiento y saldo
    Route::post('artista/movimientos', ['uses' => 'Api\Artista\MovimientosController@listMov']);
    Route::post('artista/liquidacion', ['uses' => 'Api\Artista\LiquidacionController@liquidar']);

    //Api Conecte Cliente
    //--Inicio
    Route::get('cliente/generos', ['uses' => 'Api\Cliente\InicioController@listGeneros']);
    Route::get('cliente/generos/celebridades', ['uses' => 'Api\Cliente\InicioController@listGenerosCele']);
    Route::get('cliente/artistas', ['uses' => 'Api\Cliente\InicioController@listArtista']);
    Route::post('cliente/genero/artista', ['uses' => 'Api\Cliente\InicioController@artistaXgeneros']);
    //--search
    Route::post('clientes/search', ['uses' => 'Api\Cliente\InicioController@search']);
    //--Movimientos y saldo
    Route::post('cliente/movimientos', ['uses' => 'Api\Cliente\MovimientoController@listMovimiento']);
    Route::post('cliente/saldo', ['uses' => 'Api\Cliente\MovimientoController@saldo']);
    //--Listado de Conecte
    Route::post('cliente/list/pendientes', ['uses' => 'Api\Cliente\ConecteController@list']);
    Route::post('cliente/list/finalizados', ['uses' => 'Api\Cliente\ConecteController@listFinalizado']);
    Route::post('cliente/solicitar/dedicatoria', ['uses' => 'Api\Cliente\ConecteController@solicitar']);
    Route::post('cliente/solicitar/contratacion', ['uses' => 'Api\Cliente\ConecteController@contratar']);
    //-- Login y Registro
    Route::post('cliente/login', ['uses' => 'Api\Cliente\AuthController@login']);
    Route::post('cliente/registro', ['uses' => 'Api\Cliente\AuthController@registro']);
    Route::post('cliente/editarPerfil', ['uses' => 'Api\Cliente\AuthController@editarPerfil']);
    // -- Consultar chat de contratacion
    Route::post('cliente/contratacion/detalle', ['uses' => 'Api\Cliente\ConecteController@listContratacion']);
    Route::post('cliente/contratacion/send/messaje', ['uses' => 'Api\Cliente\ConecteController@sendMensaje']);
    Route::post('cliente/estado/contratacion/', ['uses' => 'Api\Cliente\ConecteController@consultarEstado']);

    // --SLIDER
    Route::get('cliente/slider/', ['uses' => 'Api\Cliente\ConecteController@sliders']);

    // --OCULTAR MOVIMIENTOS Y HISTORIAL
    Route::post('cliente/borrar/historial', ['uses' => 'Api\Cliente\FuncionesController@borrarHistorial']);
    Route::post('cliente/borrar/movimiento', ['uses' => 'Api\Cliente\FuncionesController@borrarMovimiento']);

    //ACTUALIZAR FOTO PERFIL
    Route::post('cliente/actualizar/foto', ['uses' => 'Api\Cliente\FuncionesController@actualizarFoto']);
    Route::post('cliente/update/foto', ['uses' => 'Api\Cliente\FuncionesController@updateImagen']);

    //LISTA DE PAIS Y CIUDAD
    Route::get('cliente/lista/pais', ['uses' => 'Api\Cliente\FuncionesController@listaPais']);
    Route::get('cliente/lista/ciudad/{idPais}', ['uses' => 'Api\Cliente\FuncionesController@listaCiudad']);

});
