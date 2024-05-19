<?php

namespace Cp\Frontend;

use Illuminate\Support\ServiceProvider;

class FrontendServiceProvider extends ServiceProvider
{
    //https://github.com/gocanto/gocanto-pkg
    //https://laravel.com/docs/5.2/packages
    //http://stackoverflow.com/questions/19133020/using-models-on-packages


    public function boot()
    {
        //routes.php
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/frontendRoutes.php';
        }

        //views
        if (is_dir(base_path() . '/resources/views/cp/frontend')) {
            $this->loadViewsFrom(base_path() . '/resources/views/cp/frontend', 'frontend');
        } else {
            $this->loadViewsFrom(__DIR__ . '/views', 'frontend');
        }


        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');



        $this->loadTranslationsFrom(__DIR__ . '/lang', 'frontend');

        // $this->publishes([
        //     __DIR__.'/lang' => $this->app->langPath('vendor/menupage'),
        // ]);


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //controller
        $this->app->make('Cp\Frontend\Controllers\FrontendController');

        //config
        $this->mergeConfigFrom(__DIR__ . '/config/frontend.php', 'frontend');
    }
}
