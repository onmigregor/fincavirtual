<?php

/*
|--------------------------------------------------------------------------
| Web Routecs
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//rutas que no deben tener middleware
Route::get('getRIF', 			['uses' => 'Wsbackfv\RIFController@getRIF', 'as' => 'getRIF']);
Route::get('getEstaRNC', 		['uses' => 'Wsbackfv\EstatusRNCController@getEstaRNC', 'as' => 'getEstaRNC']);
Route::post('postRegistro', 	['uses' => 'Wsbackfv\EmpresaController@RegEmpresa', 'as' => 'getEstaRNC']);
Route::get('login', 			['uses' => 'Wsfrontfv\LoginController@Login', 'as' => 'login']);
Route::post('postlogin', 			['uses' => 'Wsfrontfv\LoginController@postlogin', 'as' => 'postlogin']);
Route::get('Registro', 			['uses' => 'Wsfrontfv\RegistroController@Registro', 'as' => 'Registro']);
//https://laraveles.com/foro/viewtopic.php?id=6504
Route::get('logout', 			['uses' => 'Wsfrontfv\LoginController@logout', 'as' => 'logout']);
Route::get('registro_unidad', 			['uses' => 'Wsfrontfv\RegistroController@registro_unidad', 'as' => 'registro_unidad']);
Route::post('post_registro_unidad',['uses' => 'Wsfrontfv\RegistroController@post_registro_unidad', 'as' => 'post_registro_unidad']);



Route::get('getConsumirAjax',['uses' => 'Wsgeneric\AjaxGenericController@getConsumirAjax', 'as' => 'getConsumirAjax']);



//Rutas Back  bsucar manera del middñleware
Route::get('getRubro', 			['uses' => 'Wsbackfv\RubroController@getRubro', 'as' => 'getRubro']);
Route::get('getTipoRubro', 		['uses' => 'Wsbackfv\TipoRubroController@getTipoRubro', 'as' => 'getTipoRubro']);
Route::get('getEstado', 		['uses' => 'Wsbackfv\EstadoController@getEstado', 'as' => 'getEstado']);
Route::get('getCiudad',			['uses' => 'Wsbackfv\CiudadController@getCiudad', 'as' => 'getCiudad']);
Route::get('getCargo', 			['uses' => 'Wsbackfv\CargoController@getCargo', 'as' => 'getCargo']);
Route::get('getMunicipio', 		['uses' => 'Wsbackfv\MunicipioController@getMunicipio', 'as' => 'getMunicipio']);
Route::get('getParroquia', 		['uses' => 'Wsbackfv\ParroquiaController@getParroquia', 'as' => 'getParroquia']);
Route::get('getempresas', 		['uses' => 'Wsbackfv\EmpresaController@getEmpresas', 'as' => 'getEmpresas']);
Route::post('RegPedido', 		['uses' => 'Wsbackfv\PedidoController@RegPedido', 'as' => 'RegPedido']);
Route::post('EditPedido', 		['uses' => 'Wsbackfv\PedidoController@EditPedido', 'as' => 'EditPedido']);
Route::get('getPedido', 		['uses' => 'Wsbackfv\PedidoController@getPedido', 'as' => 'getPedido']);
Route::post('getTipoEstatus', 	['uses' => 'Wsbackfv\TipoEstatusController@getTipoEstatus', 'as' => 'getTipoEstatus']);
Route::post('cambiarestatus', 	['uses' => 'Wsbackfv\EstatusController@cambiarestatus', 'as' => 'cambiarestatus']);
Route::post('Regcompras', 		['uses' => 'Wsbackfv\PedidoController@Regcompras', 'as' => 'Regcompras']);
Route::get('getAprobados', 		['uses' => 'Wsbackfv\PedidoController@getAprobados', 'as' => 'getAprobados']);
Route::post('getDescripcionRubro', 		['uses' => 'Wsbackfv\RubroController@getDescripcionRubro', 'as' => 'getDescripcionRubro']);
Route::post('guardar_usuario', 		['uses' => 'Wsbackfv\UsuarioController@guardar_usuario', 'as' => 'guardar_usuario']);



//https://laraveles.com/foro/viewtopic.php?id=6504
Route::group(array('middleware' => 'auth'), function()// la configuracion de lso grupos esta en app\Http/Kernel.php
//Route::group(array('before' => 'auth'), function()
{
Route::get('principal', 		['uses' => 'Wsfrontfv\PrincipalController@principal', 'as' => 'principal']);
Route::get('listar_empresas', 	['uses' => 'Wsfrontfv\Listar_empresasController@Listar', 'as' => 'listar_empresas']);
Route::post('RegEmpresa', 		['uses' => 'Wsfrontfv\RegEmpresaController@RegEmpresa', 'as' => 'RegEmpresa']);
Route::get('empresa/{rif}', 	['uses' => 'Wsfrontfv\EmpresaController@empresa', 'as' => 'empresa']);
Route::get('pedido/{accion?}/{pedido?}', 	['uses' => 'Wsfrontfv\PedidoController@pedido', 'as' => 'pedido']);
Route::post('regpedido', 		['uses' => 'Wsfrontfv\PedidoController@regpedido', 'as' => 'regpedido']);
Route::get('listar_pedido', 	['uses' => 'Wsfrontfv\PedidoController@listar_pedido', 'as' => 'listar_pedido']);
Route::get('pedidos_aprob', 	['uses' => 'Wsfrontfv\PedidoController@pedidos_aprob', 'as' => 'pedidos_aprob']);





});

