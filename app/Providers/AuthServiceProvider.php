<?php

namespace App\Providers;
use App\Policies\EntradaPolicy;
use App\Models\Entrada;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Entrada::class => EntradaPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->deleteAction();
    }
    public function deleteAction(){
        Gate::define('deleteEntrada', function ($user, $entrada) {
            return $user->id == $entrada->user_id;
          });
    }
}
