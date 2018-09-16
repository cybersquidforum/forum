<?php

namespace Cybersquid\Forum;

use Illuminate\Support\ServiceProvider;

class ForumServiceProvider extends ServiceProvider
{
    protected $defer = false;
    /**
     * Bootstrap the application services.
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'cybersquid');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cybersquid');
        $this->mergeConfigFrom(
            __DIR__ . '/../config/cybersquid.php', 'cybersquid'
        );
        // Publish migrations
        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations'),
        ], 'migrations');

        // Publish config file
        $this->publishes([
            __DIR__.'/../config/cybersquid.php' => config_path('cybersquid.php'),
        ], 'config');

        // Publish views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/cybersquid'),
        ], 'views');

        // Publish assets
        $this->publishes([
            __DIR__ . '/../resources/assets' => resource_path('../resources/assets'),
        ], 'assets');

        // Publish lang
        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('../resources/lang'),
        ], 'lang');
    }

    /**
     * Register the application services.
     * @return void
     */
    public function register()
    {
    }
}
