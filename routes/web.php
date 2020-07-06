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

Route::get("/alergia/contar", "AlergiaController@contar");

Route::resource('alergia','AlergiaController')->except([
  'create', 'show', 'edit'
]);

Route::get("/tipoAlergia/contar", "TipoAlergiaController@contar");

Route::resource('tipoAlergia','TipoAlergiaController')->except([
  'create', 'show', 'edit'
]);

Route::resource('usuario','UsuarioController');

Route::get("/discapacidad/contar", "DiscapacidadController@contar");

Route::resource('discapacidad','DiscapacidadController')->except([
  'create', 'show', 'edit'
]);

Route::get("/tipoDiscapacidad/contar", "TipoDiscapacidadController@contar");

Route::resource('tipoDiscapacidad','TipoDiscapacidadController')->except([
  'create', 'show', 'edit'
]);

Route::get("/estado/contar", "EstadoController@contar");

Route::resource('estado','EstadoController')->except([
  'create', 'show', 'edit'
]);

Route::get("/municipio/contar", "MunicipioController@contar");

Route::resource('municipio','MunicipioController')->except([
  'create', 'show', 'edit'
]);

Route::post('/parroquia/municipio','ParroquiaController@municipio');

Route::resource('parroquia','ParroquiaController')->except([
  'create', 'show', 'edit'
]);

Route::resource('empleado','EmpleadoController')->except([
  'create', 'show', 'edit'
]);

Route::get("/cargo/contar", "CargoController@contar");

Route::resource('cargo','CargoController')->except([
  'create', 'show', 'edit'
]);

Route::get('/auth', function(Illuminate\Http\Request $request){
  if($request->ajax()){  // si es por una petición ajax

    if(Auth::user()){
      return Auth::user();
    }else{
      return response()->json([
          'status' => 'Ocurrio un error!',
          'msg' => 'El usuario no esta loggeado.',
      ],400);
    }

  } else { // si no se redirige a index

    return view('/theme/index');

  }
});

// Cuando no encuentre la pagina se redirigira a esta
Route::get('/{any}', 'ThemeController@index')->where('any', '.*');
