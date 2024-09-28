<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Container\Attributes\Auth;
use App\Services\AuthentificationServicePassport;
use App\Services\AuthentificationServiceSanctum;
use App\Services\Interfaces\AuthentificationServiceInterface;

class AuthCustomerServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
        AuthentificationServiceInterface::class,AuthentificationServicePassport::class,
        //AuthentificationServiceInterface::class,AuthentificationServiceSanctum::class
        );
    }
}
