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
    return view('welcome2');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';




//GENERO
Route::get('genero','App\Http\Controllers\M4dashboardController@genero');
Route::get('generoxv','App\Http\Controllers\M4dashboardController@generoxv');
Route::get('uor','App\Http\Controllers\M4dashboardController@uor');
Route::get('uor-explode/{uor}','App\Http\Controllers\M4dashboardController@uor_explode');
///////////////////

Route::get('graficos/usuarios','App\Http\Controllers\HistorialoperacionesController@json_grafico_usuarios');


Route::get('historialoperaciones','App\Http\Controllers\HistorialoperacionesController@index')->name('historialoperaciones.index');


//Route::resource('historialoperaciones', App\Http\Controllers\historialoperacionesController::class);


Route::resource('usuarios', App\Http\Controllers\UsuarioController::class);

Route::get('contar','App\Http\Controllers\HistorialoperacionesController@contar')->name('contar');
Route::get('contarusuarios','App\Http\Controllers\HistorialoperacionesController@contarusuarios')->name('contarusuarios');
Route::get('usuarios_reparticion','App\Http\Controllers\UsuarioController@usuarios_reparticion')->name('usuarios_reparticion');

// Ruta para Login
Route::group(['middleware' => ['auth']], function() {
    /**
    * Logout Route
    */
    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
 });

 // Ruta en Laravel para mostrar el dashboard
Route::get('/dashboardm4', function () {
    // Hacer la petición HTTP al endpoint de genero
    $generoData = json_decode(file_get_contents('http://localhost:3000/genero'));

    //dd($generoData);

    // Hacer la petición HTTP al endpoint de planta
    $plantaData = json_decode(file_get_contents('http://localhost:3000/planta'));

    // Pasar los datos a la vista
    return view('dashboardm4', [
        'genero' => $generoData,
        'planta' => $plantaData,
    ]);
});

Route::get('/dashboard/{usuario_name?}','App\Http\Controllers\M4dashboardController@dashboard') ->name('dashboard');

Route::get('/planta','App\Http\Controllers\M4dashboardController@planta') ->name('planta');
Route::get('/jubilaciones','App\Http\Controllers\M4dashboardController@jubilaciones') ->name('jubilaciones');
Route::get('/ausentismo','App\Http\Controllers\M4dashboardController@ausentismo') ->name('ausentismo');
Route::get('/sindicatos','App\Http\Controllers\M4dashboardController@sindicatos') ->name('sindicatos');
Route::get('/licencias','App\Http\Controllers\M4dashboardController@licencias') ->name('licencias');



