<?php

namespace Cp\Media;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    //https://github.com/gocanto/gocanto-pkg
    //https://laravel.com/docs/5.2/packages
    //http://stackoverflow.com/questions/19133020/using-models-on-packages


    public function boot()
    {
        //routes.php
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/mediaRoutes.php';
        }

        //views
        if (is_dir(base_path() . '/resources/views/cp/media')) {
            $this->loadViewsFrom(base_path() . '/resources/views/cp/media', 'media');
        } else {
            $this->loadViewsFrom(__DIR__ . '/views', 'media');
        }


        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');



        $this->loadTranslationsFrom(__DIR__ . '/lang', 'media');

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
        $this->app->make('Cp\Media\Controllers\MediaController');
        $this->app->make('Cp\Media\Controllers\AdminMediaController');


        //config
        $this->mergeConfigFrom(__DIR__ . '/config/media.php', 'media');
    }
}
