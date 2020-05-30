<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('cerrar_sesion', function () {
  Auth::logout();
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('alergia','AlergiaController');

Route::resource('tipoAlergia','TipoAlergiaController');

Route::resource('usuario','UsuarioController');

Route::resource('discapacidad','DiscapacidadController');

Route::resource('tipoDiscapacidad','TipoDiscapacidadController');

Route::resource('estado','EstadoController');

Route::resource('municipio','MunicipioController');

Route::post('/parroquia/municipio','ParroquiaController@municipio');

Route::resource('parroquia','ParroquiaController');
