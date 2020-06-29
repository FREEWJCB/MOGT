<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

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

Route::get("/tipoDiscapacidad/contar", "TipoDiscapacidadController@contar");

Route::resource('tipoDiscapacidad','TipoDiscapacidadController');

Route::resource('estado','EstadoController');

Route::resource('municipio','MunicipioController');

Route::post('/parroquia/municipio','ParroquiaController@municipio');

Route::resource('parroquia','ParroquiaController');

Route::resource('empleado','EmpleadoController');

Route::resource('cargo','CargoController');

Route::get('/auth', function(){
  if(Auth::user()){
    return Auth::user();
  }else{
    return response()->json([
        'status' => 'Ocurrio un error!',
        'msg' => 'El usuario no esta loggeado.',
    ],400);
  }
});

// Cuando no encuentre la pagina se redirigira a esta
Route::get('/{any}', 'ThemeController@index')->where('any', '.*');
