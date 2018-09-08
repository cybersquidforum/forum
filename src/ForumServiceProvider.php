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

        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'cybersquid');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cybersquid');

        $this->publishes([
            __DIR__.'/../routes/cybersquid.php' => base_path('../routes/cybersquid.php'),
        ], 'cybersquid-routes');

        $this->publishes([
            __DIR__.'/../config/cybersquid.php' => config_path('cybersquid.php'),
        ], 'cybersquid-config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/cybersquid'),
        ], 'cybersquid-views');

        $this->publishes([
            __DIR__ . '/../resources/assets' => resource_path('../resources/assets'),
        ], 'cybersquid-assets');

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
