<?php

namespace Cybersquid\Forum;

use Illuminate\Support\ServiceProvider;

class ForumServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/cybersquid.php');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'cybersquid');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cybersquid');

        // Publish migrations
        $this->publishes([
            __DIR__ . '/../migrations/' => database_path('/migrations')
        ], 'cybersquid-migrations');

        // Publish routes
        $this->publishes([
            __DIR__.'/../routes/cybersquid.php' => base_path('../routes/cybersquid.php'),
        ], 'cybersquid-routes');

        // Publish config file
        $this->publishes([
            __DIR__.'/../config/cybersquid.php' => config_path('cybersquid.php'),
        ], 'cybersquid-config');

        // Publish views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/cybersquid'),
        ], 'cybersquid-views');

        // Publish assets
        $this->publishes([
            __DIR__ . '/../resources/assets' => resource_path('../resources/assets'),
        ], 'cybersquid-assets');

        // Publish lang
        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('../resources/lang'),
        ], 'cybersquid-lang');
    }

    /**
     * Register the application services.
     * @return void
     */
    public function register()
    {

    }
}
