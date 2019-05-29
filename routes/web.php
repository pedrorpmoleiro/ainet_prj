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

Route::get('/', function () {
    return redirect()->action('HomeController@index');
})->name('root');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['verify' => true, 'register' => false]);

Route::middleware(['auth', 'verified', 'isNotDeleted'])->group(function () {
    Route::get('/password', 'UserController@alterarPassword')->name('password.change');
    Route::patch('/password', 'UserController@patchPassword')->name('password.patch');

    Route::middleware(['isAtivo'])->group(function () {
        Route::resource('socios', 'UserController')->only(['index']);

        Route::middleware(['isDirecao'])->group(function () {
            Route::patch('/socios/reset_quotas','UserController@resetQuotas')->name('socio.reset_quotas');
            Route::patch('/socios/desativar_sem_quotas', 'UserController@desativarSemQuotas')->name('socio.desativar_sem_quotas');
        });

        Route::resource('socios', 'UserController')->only(['edit', 'update'])->middleware(['can:update,socio']);

        Route::middleware(['can:licenca,piloto'])->group(function () {
            Route::get('/pilotos/{piloto}/certificado','UserController@certificado')->name('piloto.certificado');
            Route::get('/pilotos/{piloto}/licenca','UserController@licenca')->name('piloto.licenca');
        });

        Route::resource('movimentos', 'MovimentoController')->only(['create', 'store'])->middleware(['can:create,App\Movimento']);

        Route::resource('movimentos', 'MovimentoController')->only(['index', 'destroy']);

        Route::resource('movimentos', 'MovimentoController')->only(['edit','update'])->middleware(['can:update,movimento']);

        Route::resource('aeronaves', 'AeronaveController')->only(['index']);

        Route::middleware(['isDirecao'])->group(function () {
            Route::resource('aeronaves', 'AeronaveController')->parameters(['aeronaves'=>'aeronave'])->except(['show', 'index']);
            Route::resource('socios', 'UserController')->except(['show', 'edit', 'update', 'index']);

            Route::get('/aeronaves/{aeronave}/pilotos', 'AeronaveController@pilotos')->name('aeronaves.pilotos');
            Route::post('/aeronaves/{aeronave}/pilotos/{piloto}', 'AeronaveController@addPiloto')->name('aeronaves.add_piloto');
            Route::delete('/aeronaves/{aeronave}/pilotos/{piloto}', 'AeronaveController@removePiloto')->name('aeronaves.remove_piloto');

            Route::patch('/socios/{socio}/quota', 'UserController@setQuota')->name('socio.set_quota');
            Route::patch('/socios/{socio}/ativo', 'UserController@ativarSocio')->name('socio.set_ativo');
            Route::post('/socios/{socio}/send_reactivate_mail', 'UserController@sendReActivationEmail')->name('socio.resend_mail');

            Route::get('/pendentes', 'PendenteController@index')->name('pendente.index');
        });
    });
});

/*
Route::get('/aeronaves/{aeronave}/precos_tempos', function () {return view('welcome');});

Route::get('/aeronaves/{aeronave}/linha_temporal', function () {return view('welcome');});
*/

