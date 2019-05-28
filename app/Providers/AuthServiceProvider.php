<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\User' => 'App\Policies\UserPolicy',
        'App\Movimento'=>'App\Policies\MovimentoPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('direcao', function ($user) {
            return $user->direcao == 1;
        });

        Gate::define('pilotoDirecao', function ($user) {
            return $user->tipo_socio == 'P' || $user->direcao;
        });

        Gate::define('piloto', function ($user) {
            return $user->tipo_socio == 'P';
        });
    }
}
