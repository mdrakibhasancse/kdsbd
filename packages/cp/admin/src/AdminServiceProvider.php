<?php

namespace Cp\Admin;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    //https://github.com/gocanto/gocanto-pkg
    //https://laravel.com/docs/5.2/packages
    //http://stackoverflow.com/questions/19133020/using-models-on-packages


    public function boot()
    {
        //routes.php
        if (! $this->app->routesAreCached())
        {
            require __DIR__.'/adminRoutes.php';

        }

        //views
        if (is_dir(base_path() . '/resources/views/cp/admin')) {
            $this->loadViewsFrom(base_path() . '/resources/views/cp/admin', 'admin');
        } else {
            $this->loadViewsFrom(__DIR__.'/views', 'admin');
        }


        // $this->loadMigrationsFrom(__DIR__.'/database/migrations');



        // $this->loadTranslationsFrom(__DIR__.'/lang', 'admin');
 
        // $this->publishes([
        //     __DIR__.'/lang' => $this->app->langPath('vendor/admin'),
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
        $this->app->make('Cp\Admin\Controllers\AdminController');


        //config
        $this->mergeConfigFrom(__DIR__.'/config/admin.php', 'admin');
    }


}
