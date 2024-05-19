<?php

namespace Cp\UserRole;

use Illuminate\Support\ServiceProvider;

class UserRoleServiceProvider extends ServiceProvider
{
    //https://github.com/gocanto/gocanto-pkg
    //https://laravel.com/docs/5.2/packages
    //http://stackoverflow.com/questions/19133020/using-models-on-packages


    public function boot()
    {
        //routes.php
        if (! $this->app->routesAreCached())
        {
            require __DIR__.'/userRoleRoutes.php';

        }

        //views
        if (is_dir(base_path() . '/resources/views/cp/userrole')) {
            $this->loadViewsFrom(base_path() . '/resources/views/cp/userrole', 'userrole');
        } else {
            $this->loadViewsFrom(__DIR__.'/views', 'userrole');
        }


        $this->loadMigrationsFrom(__DIR__.'/database/migrations');



        $this->loadTranslationsFrom(__DIR__.'/lang', 'userrole');
 
        // $this->publishes([
        //     __DIR__.'/lang' => $this->app->langPath('vendor/userrole'),
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
        $this->app->make('Cp\UserRole\Controllers\UserRoleController');
        $this->app->make('Cp\UserRole\Controllers\AdminUserRoleController');


        //config
        $this->mergeConfigFrom(__DIR__.'/config/userrole.php', 'userrole');
    }


}
