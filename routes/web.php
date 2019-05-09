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

Auth::routes(['verify' => true, 'register' => false]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/password', 'UserController@alterarPassword');
    Route::patch('/password', 'UserController@patchPassword');
    
    Route::middleware(['isAtivo', 'isPasswordInicial'])->group(function () {
        Route::resource('aeronaves', 'AeronaveController')->except(['show']);
        Route::resource('movimentos', 'MovimentoController')->except(['show']);
    
        Route::get('/socios/{socio}/edit', 'UserController@edit');
        Route::put('/socios/{socio}', 'UserController@update');
            
        Route::middleware(['isDirecao'])->group(function () {
            Route::resource('socios', 'UserController')->except(['show', 'edit', 'update']);
    
            Route::patch('/socios/{socio}/quota', function () {return view('welcome');});
            Route::patch('/socios/reset_quotas', 'UserController@resetQuotas');
            Route::patch('/socios/{socio}/ativo', function () {return view('welcome');});
            Route::patch('/socios/desativar_sem_quotas', 'UserController@desativarSemQuotas');
            Route::post('/socios/{socio}/send_reactivate_mail', 'UserController@sendReActivationEmail');
        }); 
    });
});

Route::get('/home', 'HomeController@index')->name('home');

/*
Route::get('/aeronaves/{aeronave}/pilotos', function () {return view('welcome');});
Route::post('/aeronaves/{aeronave}/pilotos/{piloto}', function () {return view('welcome');});
Route::delete('/aeronaves/{aeronave}/pilotos/{piloto}', function () {return view('welcome');});
Route::get('/aeronaves/{aeronave}/precos_tempos', function () {return view('welcome');});

Route::get('/pilotos/{piloto}/certificado', function () {return view('welcome');});
Route::get('/pilotos/{piloto}/licenca', function () {return view('welcome');});

Route::get('/pendentes', function () {return view('welcome');});

Route::get('/aeronaves/{aeronave}/linha_temporal', function () {return view('welcome');});
*/
