<?php
//use Symfony\Component\Routing\Annotation\Route;

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
    return redirect()->action('HomeController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/email/verify/{id}', function () {return view('welcome');});
Route::get('/password', function () {return view('welcome');});
Route::patch('/password', function () {return view('welcome');});

Route::resource('aeronaves', 'AeronaveController')->except(['show']);

Route::resource('socios', 'UserController')->except(['show']);

Route::patch('/socios/{socio}/quota', function () {return view('welcome');});
Route::patch('/socios/reset_quotas', function () {return view('welcome');});
Route::patch('/socios/{socio}/ativo', function () {return view('welcome');});
Route::patch('/socios/desativar_sem_quotas', function () {return view('welcome');});
Route::post('/socios/{socio}/send_reactivate_mail', function () {return view('welcome');});


/*
Route::get('/aeronaves/{aeronave}/pilotos', function () {return view('welcome');});
Route::post('/aeronaves/{aeronave}/pilotos/{piloto}', function () {return view('welcome');});
Route::delete('/aeronaves/{aeronave}/pilotos/{piloto}', function () {return view('welcome');});
Route::get('/aeronaves/{aeronave}/precos_tempos', function () {return view('welcome');});

Route::get('/pilotos/{piloto}/certificado', function () {return view('welcome');});
Route::get('/pilotos/{piloto}/licenca', function () {return view('welcome');});

Route::get('/movimentos', function () {return view('welcome');});
Route::get('/movimentos/{movimento}/edit', function () {return view('welcome');});
Route::get('/movimentos/create', function () {return view('welcome');});
Route::post('/movimentos', function () {return view('welcome');});
Route::put('/movimentos/{movimento}', function () {return view('welcome');});
Route::delete('/movimentos/{movimento}', function () {return view('welcome');});
Route::get('/pendentes', function () {return view('welcome');});

Route::get('/aeronaves/{aeronave}/linha_temporal', function () {return view('welcome');});
*/
