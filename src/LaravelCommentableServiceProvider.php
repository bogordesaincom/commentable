<?php

namespace Bogordesain\LaravelCommentable;

use Illuminate\Support\ServiceProvider;

class LaravelCommentableServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'bogordesain');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'bogordesain');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-commentable.php', 'laravel-commentable');

        // Register the service the package provides.
        $this->app->singleton('laravel-commentable', function ($app) {
            return new LaravelCommentable;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravel-commentable'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravel-commentable.php' => config_path('laravel-commentable.php'),
        ], 'laravel-commentable.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/bogordesain'),
        ], 'laravel-commentable.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/bogordesain'),
        ], 'laravel-commentable.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/bogordesain'),
        ], 'laravel-commentable.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
