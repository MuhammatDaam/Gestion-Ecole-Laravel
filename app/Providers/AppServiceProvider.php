<?php

namespace App\Providers;

use App\Services\ReferentielFirebaseService;
use App\Services\UserFirebaseService;
use Illuminate\Support\ServiceProvider;
use App\Repository\ReferentielRepositoryImpl;
use App\Repository\Firebase\UserFirebaseRepositoryImpl;
use App\Services\Interfaces\ReferentielServiceInterface;
use App\Services\Interfaces\UserFirebaseServiceInterface;
use App\Repository\Interface\UserFirebaseRepositoryInterface;
use App\Repository\Interface\ReferentielRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Lier l'interface UserFirebaseServiceInterface à son implémentation
        $this->app->bind(UserFirebaseServiceInterface::class, UserFirebaseService::class);

        // Lier l'interface UserFirebaseRepositoryInterface à son implémentation
        $this->app->bind(UserFirebaseRepositoryInterface::class, UserFirebaseRepositoryImpl::class);

        // $this->app->bind(ReferentielServiceInterface::class, ReferentielFirebaseService::class);

        $this->app->bind(ReferentielRepositoryInterface::class, ReferentielRepositoryImpl::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
