<?php

namespace Nitm\ConnectedAccounts;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Nitm\ConnectedAccounts\Models\Product;
use Nitm\ConnectedAccounts\Stripe\StripeService;
use Nitm\ConnectedAccounts\Models\SocialProvider;
use Nitm\ConnectedAccounts\Models\ConnectedAccount;
use Nitm\ConnectedAccounts\Observers\Product as ProductObserver;

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
        $this->registerBindings();
        $this->defineRouteBindings();
    }

    /**
     * Register bindings
     *
     * @return void
     */
    protected function registerBindings()
    {
        $bindings = [
            ConnectedAccount::class => NitmConnectedAccounts::connectedAccountModel(),
            SocialProvider::class => NitmConnectedAccounts::socialProviderModel(),
        ];

        foreach ($bindings as $key => $value) {
            $this->app->bind($key, $value);
        }
    }

    /**
     * Define the NitmContent route model bindings.
     *
     * @return void
     */
    protected function defineRouteBindings()
    {
        Route::model('connectedAccount', config('social-auth.connected_account_model', ConnectedAccount::class));
        Route::model('socialProvider', config('social-auth.social_provider_model', SocialProvider::class));
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