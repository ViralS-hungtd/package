<?php

namespace MyVendor\MyPackage;

use Illuminate\Support\ServiceProvider;

class MyPackageServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'myvendor');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'myvendor'); // return view('c::my')
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'myvendor'); // return view('c::my')

        //Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/mypackage.php', 'mypackage');

        // Register the service the package provides.
        $this->app->singleton('mypackage', function ($app) {
            return new MyPackage;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['mypackage'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/mypackage.php' => config_path('mypackage.php'),
        ], 'mypackage.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/myvendor'),
        ], 'mypackage.views');*/

        // Publishing assets.
        $this->publishes([
            __DIR__.'/../resources/assets/js' => public_path('vendor/backpack/crud/js'),
        ], 'mypackage.views');

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/myvendor'),
        ], 'mypackage.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
