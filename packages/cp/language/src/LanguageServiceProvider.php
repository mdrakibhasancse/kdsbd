<?php

namespace Cp\Language;

use Illuminate\Support\ServiceProvider;

class LanguageServiceProvider extends ServiceProvider
{
    //https://github.com/gocanto/gocanto-pkg
    //https://laravel.com/docs/5.2/packages
    //http://stackoverflow.com/questions/19133020/using-models-on-packages


    public function boot()
    {
        //routes.php
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/languageRoutes.php';
        }

        //views
        if (is_dir(base_path() . '/resources/views/cp/language')) {
            $this->loadViewsFrom(base_path() . '/resources/views/cp/language', 'language');
        } else {
            $this->loadViewsFrom(__DIR__ . '/views', 'language');
        }


        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');



        $this->loadTranslationsFrom(__DIR__ . '/lang', 'language');

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
        $this->app->make('Cp\Language\Controllers\LanguageController');
        $this->app->make('Cp\Language\Controllers\AdminLanguageController');


        //config
        $this->mergeConfigFrom(__DIR__ . '/config/language.php', 'language');
    }
}