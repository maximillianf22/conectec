<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Para controlar el idioma con la session establecida. */
Route::get('lang/{lang}', function($lang) {
    \Session::put('lang', $lang);
    return \Redirect::back();
})->middleware('web')->name('change_lang');

/*---Rediseño V2 Conecte 07-22-2019 ---*/

Route::get('/video', ['uses' => 'HomeController@videoConverter', 'as' => 'video.converter']);

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'index']);
Route::get('/musica', ['uses' => 'HomeController@music', 'as' => 'home.music']);
Route::get('/explorar', ['uses' => 'HomeController@explorer', 'as' => 'home.explorer']);
Route::get('/favoritos', ['uses' => 'HomeController@favorites', 'as' => 'home.favorites']);

Route::post('/favoritos/filtergeneros', ['uses' => 'HomeController@filtroGenero', 'as' => 'home.favorites.filtro.genero']);


Route::get('/perfil/{name}', ['uses' => 'HomeController@profile', 'as' => 'home.profile']);


Route::get('/welcome', ['uses' => 'HomeController@welcome', 'as' => 'welcome']);
Route::get('/home', function(){
    return redirect('/login');
});

Route::get('/artista/{name}', ['uses' => 'HomeController@artista', 'as' => 'artista']);
Route::get('pagar/contrato/token/{token}/parametro/{parametro}', 'Api\Cliente\PagosController@pagarContrato', ['as' => 'pagoContrato']);
Route::post('/pagar/movimiento', ['uses' => 'Api\Cliente\PagosController@pagarMovimiento']);
Route::get('/payu/response', ['uses' => 'Api\Cliente\PagosController@responsePayu']);
Route::post('/payu/confirmation', ['uses' => 'Api\Cliente\PagosCartista.generosontroller@confirmationPayu']);
Route::get('contrato/pagar/respuesta', ['uses' => 'Api\Cliente\PagosController@respuestaPago']);
Route::get('/generos/{id}', ['uses' => 'HomeController@generos', 'as' => 'artista.generos']);

//Recargas
Route::get('/payu/response/recarga', ['uses' => 'RecargaController@responsePayuR']);
Route::post('/payu/confirmation/recarga', ['uses' => 'RecargaController@confirmationPayuR']);


Route::group(['prefix' => '/',  'middleware' => 'auth'], function(){
    Route::get('/perfil/{name}/dedicatoria', ['uses' => 'HomeController@profile_dedication', 'as' => 'home.profile.dedicatoria']);
    Route::get('/perfil/{name}/campaigns', ['uses' => 'HomeController@profile_campaigns', 'as' => 'home.profile.campaigns']);
    Route::post('/pedir-dedicatoria', ['uses' => 'HomeController@pedirDedicatoria', 'as' => 'pedirDedicatoria']);
    Route::post('/solicitar-contratacion', ['uses' => 'HomeController@solicitarContratacion', 'as' => 'solicitarContratacion']);
    Route::get('/mis-movimientos', ['uses' => 'HomeController@misMovimientos', 'as' => 'misMovimientos']);
    Route::get('/mi-historial', ['uses' => 'HomeController@miHistorial', 'as' => 'miHistorial']);
    Route::get('/mis-pendientes', ['uses' => 'HomeController@misPedientes', 'as' => 'misPendientes']);
    Route::get('/ver-respuesta/{id}', ['uses' => 'HomeController@verRespuesta', 'as' => 'verRespuesta']);
    Route::get('/perfil', ['uses' => 'HomeController@perfil', 'as' => 'perfil']);
    Route::post('/actulizarCliente', ['uses' => 'HomeController@actulizarCliente', 'as' => 'actulizarCliente']);
    Route::post('/actulizarArtista', ['uses' => 'HomeController@actulizarArtista', 'as' => 'actulizarArtista']);
    Route::resource('/transacciones', 'LiquidacionesController', ['as' => 'liquidacion']);
    Route::resource('/negociacion', 'NegociacionesController', ['as' => 'negociacion']);
    Route::resource('/formularioDeContratacion', 'FormularioDeContratacionController', ['as' => 'formularioDeContratacion']);
    Route::resource('/contratos', 'ContratosController', ['as' => 'contratos']);
});

Route::group(['prefix' => 'administrador', 'middleware' => 'administrador'], function () {
    Route::get('/', ['uses' => 'AdministradorController@index', 'as' => 'admin']);
    Route::resource('clientes', 'UsuariosController', ['as' => 'clientes']);
    Route::resource('artistas', 'ArtistasController', ['as' => 'artistas']);
    Route::resource('configuraciones', 'ConfiguracionesController', ['as' => 'configuraciones']);
    Route::post('configuraciones/crear', ['uses' => 'ConfiguracionesController@store', 'as' => 'configuracionesStore']);
    Route::resource('movimientos', 'MovimientosController', ['as' => 'movimientos']);
    Route::resource('liquidaciones', 'LiquidacionesController', ['as' => 'liquidaciones']);
    Route::resource('dedicatorias', 'DedicatoriasController', ['as' => 'dedicatorias']);
    Route::resource('contrataciones', 'ContratacionesController', ['as' => 'contrataciones']);
    Route::resource('valoresConguraciones', 'ValoresConfiguracionController', ['as' => 'valoresConguraciones']);
});


/* Start autentificación */
    Auth::routes();
    Route::get('/login/?', ['uses' => 'Auth\LoginController@login', 'as' => 'loginView']);
    Route::get('/login/administrador', ['uses' => 'Auth\LoginController@loginAdmin', 'as' => 'loginViewAdmin']);
    Route::get('/logout', ['uses' => 'Auth\LoginController@getLogout', 'as' => 'getLogout']);
    Route::post('/loginPost', ['uses' => 'Auth\LoginController@loginPost', 'as' => 'loginPost']);
    Route::post('/loginPostAdmin', ['uses' => 'Auth\LoginController@loginPostAdmin', 'as' => 'loginPostAdmin']);
    
    Route::get('/recoveryaccount', ['uses' => 'Auth\LoginController@RecoveryAccount', 'as' => 'recoveryaccount']);
    Route::post('/recoveryaccount', ['uses' => 'Auth\LoginController@PostRecoveryAccount', 'as' => 'recoveryaccount']);
    Route::get('/confirmationEmail/identificacion/{id}/token/{token_}', ['uses' => 'Auth\LoginController@ConfirmationRecoveryAccount', 'as' => 'confirmationEmail']);
    Route::post('/resetpasswordaccount', ['uses' => 'Auth\LoginController@ResetPassAccount', 'as' => 'resetpasswordaccount']);


    Route::get('/registro-usuarios', ['uses' => 'Auth\RegisterController@registros_usuarios', 'as' => 'register.usuarios']);
    Route::get('/registro-artistas', ['uses' => 'Auth\RegisterController@registros_artistas', 'as' => 'register.artista']);

    Route::post('/registroArtistaPost', ['uses' => 'Auth\RegisterController@registroArtistaPost', 'as' => 'registroArtistaPost']);
    Route::post('/registroUsuariosPost', ['uses' => 'Auth\RegisterController@registroUsuariosPost', 'as' => 'registroUsuariosPost']);

    //Route::get('/administrador/login', ['uses' => 'Auth\LoginController@login', 'as' => 'loginView']);
    Route::get('/auth/confirm/email/{email}/confirm_token/{confirm_token}', ['uses' => 'Auth\RegisterController@confirmRegister', 'as' => 'confirmarCorreo']);
/* End autentificación */


