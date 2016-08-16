<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@vistaIndex');
Route::get('/vuelos', 'HomeController@vistaVuelos');
Route::match(array('GET','POST'), '/login', 'UserController@actionLogin');
Route::match(array('GET','POST'), '/register', 'UserController@actionRegister');
Route::get('/register/verify/{confirmation_code}', 'UserController@verificarCuenta');

Route::group(array('before' => 'auth'), function()
{
  Route::match(array('GET','POST'), '/vuelos/compra', 'HomeController@comprarVuelos');
  Route::post('/vuelos/compra/confirmar', 'HomeController@confirmarPago');
  Route::post('/vuelos/compra/confirmar/imprimir', 'HomeController@imprimirPago');
  Route::get('/user', 'UserController@vistaUser');
  Route::post('/user/reservaciones', 'UserController@mostrarReservaciones');
  Route::post('/user/historialtable', 'UserController@mostrarHistorial');
  Route::post('/user/pagostable', 'UserController@mostrarPagos');
  Route::post('/upload','UserController@Upload');
  Route::get('/logout', 'UserController@logout');
  Route::get('/user/historial', 'UserController@vistaHistorial');
  Route::get('/user/creditos', 'UserController@vistaCreditos');
  Route::match(array('GET','POST'),'/user/agregarcreditos', 'UserController@agregarCreditos');
  Route::match(array('GET','POST'), '/user/configuracion', 'UserController@vistaConfiguracion');
  Route::post('/imprimir','UserController@imprimirPago');
  Route::post('/buscarVuelo','HomeController@buscarVuelo');
  Route::post('/vuelosInfo/{origen}/{destino}/{salida}/{regreso?}','HomeController@mostrarVuelos');
});
/*
Route::match(array('GET','POST'),'/vuelos/asientos','HomeController@seleccionAsientos');
*/
