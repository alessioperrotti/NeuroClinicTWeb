<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Log::info('AppServiceProvider boot method called');

        $this->registerPolicies();

        Gate::define('isPaziente', function ($user) {
            Log::info('Definendo il Gate isPaziente per l\'utente:', ['user' => $user]);
            return $user->hasRole('P');
        });
    }
}
