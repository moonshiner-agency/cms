<?php

namespace Moonshiner\Cms;

use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // if(!$this->app->runningInConsole()) return; 
            
        $this->registerMigrations();

        $this->publishes([
            __DIR__ . '/../config/cms.php' => config_path('cms.php'),
        ]);
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');     
         $this->publishes([
            __DIR__.'/../resources/assets' => resource_path('vendor/moonshine'),
        ], 'public');


    }

    /**
     * Register Passport's migration files.
     *
     * @return void
     */
    protected function registerMigrations()
    {
        return $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'passport-migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }
}
