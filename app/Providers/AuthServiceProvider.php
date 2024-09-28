<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

       Passport::ignoreRoutes();
       Passport::tokensExpireIn(now()->addDays(15));
       Passport::refreshTokensExpireIn(now()->addDays(30));
       Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
