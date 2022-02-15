<?php

namespace Nitm\ConnectedAccounts;

use Illuminate\Support\ServiceProvider;
use Nitm\ConnectedAccounts\Models\Product;
use Nitm\ConnectedAccounts\Observers\Product as ProductObserver;
use Nitm\ConnectedAccounts\Stripe\StripeService;

class ConnectedAccountServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'social-auth-migrations');
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('social-auth.php'),
            ], 'social-auth-config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'social-auth');
    }

    /**
     * Set the nova user model
     *
     * @param  mixed $class
     * @return void
     */
    public static function useNovaUser($class)
    {
        config(['social-auth.nova.user' => $class]);
    }
}