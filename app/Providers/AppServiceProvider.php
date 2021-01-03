<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->validator->extendImplicit('notIgual', function ($attribute, $value, $parameters) {
           // dd($parameters);
            if($value==1&&$parameters[0]==1){
                return false;
            }
            return true;
        }, 'Não pode ser instrutor e aluno ao mesmo tempo!');
    }
}
