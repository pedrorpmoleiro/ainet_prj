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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['verify' => true, 'register' => false]);

Route::middleware(['auth', 'verified', 'isNotDeleted'])->group(function () {
    Route::get('/password', 'UserController@alterarPassword');
    Route::patch('/password', 'UserController@patchPassword');

    Route::middleware(['isAtivo'])->group(function () {
        Route::resource('socios', 'UserController')->only(['index']);

        Route::middleware(['can:update,socio'])->group(function () {
            Route::resource('socios', 'UserController')->only(['edit', 'update']);
        });

        Route::middleware(['can:licenca,piloto'])->group(function () {
            Route::get('/pilotos/{piloto}/certificado','UserController@certificado');
            Route::get('/pilotos/{piloto}/licenca','UserController@licenca');
        });

        Route::resource('aeronaves', 'AeronaveController')->only(['index']);
        Route::resource('movimentos', 'MovimentoController')->except(['show']);

        Route::middleware(['isDirecao'])->group(function () {
            Route::resource('aeronaves', 'AeronaveController')->except(['show', 'index']);
            Route::resource('socios', 'UserController')->except(['show', 'edit', 'update', 'index']);

            Route::patch('/socios/{socio}/quota', function () {return view('welcome');});
            Route::patch('/socios/reset_quotas', 'UserController@resetQuotas');
            Route::patch('/socios/{socio}/ativo', function () {return view('welcome');});
            Route::patch('/socios/desativar_sem_quotas', 'UserController@desativarSemQuotas');
            Route::post('/socios/{socio}/send_reactivate_mail', 'UserController@sendReActivationEmail');
        });
    });
});

/*
Route::get('/aeronaves/{aeronave}/pilotos', function () {return view('welcome');});
Route::post('/aeronaves/{aeronave}/pilotos/{piloto}', function () {return view('welcome');});
Route::delete('/aeronaves/{aeronave}/pilotos/{piloto}', function () {return view('welcome');});
Route::get('/aeronaves/{aeronave}/precos_tempos', function () {return view('welcome');});
*/

/*
Route::get('/pendentes', function () {return view('welcome');});

Route::get('/aeronaves/{aeronave}/linha_temporal', function () {return view('welcome');});
*/

