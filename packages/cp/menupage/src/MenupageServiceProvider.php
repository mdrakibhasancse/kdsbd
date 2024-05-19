<?php

namespace Cp\Menupage;

use Illuminate\Support\ServiceProvider;

class MenupageServiceProvider extends ServiceProvider
{
    //https://github.com/gocanto/gocanto-pkg
    //https://laravel.com/docs/5.2/packages
    //http://stackoverflow.com/questions/19133020/using-models-on-packages


    public function boot()
    {
        //routes.php
        if (! $this->app->routesAreCached())
        {
            require __DIR__.'/menupageRoutes.php';

        }

        //views
        if (is_dir(base_path() . '/resources/views/cp/menupage')) {
            $this->loadViewsFrom(base_path() . '/resources/views/cp/menupage', 'menupage');
        } else {
            $this->loadViewsFrom(__DIR__.'/views', 'menupage');
        }


        $this->loadMigrationsFrom(__DIR__.'/database/migrations');



        $this->loadTranslationsFrom(__DIR__.'/lang', 'menupage');
 
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
        $this->app->make('Cp\Menupage\Controllers\MenupageController');
        $this->app->make('Cp\Menupage\Controllers\AdminMenupageController');


        //config
        $this->mergeConfigFrom(__DIR__.'/config/menupage.php', 'menupage');
    }


}
