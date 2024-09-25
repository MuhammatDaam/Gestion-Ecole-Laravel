<?php

namespace App\Providers;

use App\Services\FirebaseService;
use Illuminate\Support\Facades\App;
use App\Models\Firebase\UserFirebase;
use App\Services\UserFirebaseService;
use Illuminate\Support\ServiceProvider;
use App\Services\PromotionFirebaseService;
use App\Models\Firebase\ApprenantsFirebase;
use App\Models\Firebase\ReferentielFirebase;
use App\Repository\Interface\PromotionRepositoryInterface;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FirebaseService::class, function ($app) {
            return new FirebaseService();
        });
        $this->app->singleton('user', function ($app) {
            return new UserFirebase();
        });
        $this->app->alias(FirebaseService::class, 'firebase');

        $this->app->singleton('referentiel', function () {
            return new ReferentielFirebase();
        });

        $this->app->singleton('apprenants', function () {
            return new ApprenantsFirebase();
        });

        $this->app->singleton('promotion', function ($app) {
            return new PromotionFirebaseService($app->make(PromotionRepositoryInterface::class));
        });
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
