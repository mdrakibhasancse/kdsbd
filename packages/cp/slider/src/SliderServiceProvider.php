<?php

namespace Cp\Slider;

use Illuminate\Support\ServiceProvider;

class SliderServiceProvider extends ServiceProvider
{
    //https://github.com/gocanto/gocanto-pkg
    //https://laravel.com/docs/5.2/packages
    //http://stackoverflow.com/questions/19133020/using-models-on-packages


    public function boot()
    {
        //routes.php
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/sliderRoutes.php';
        }

        //views
        if (is_dir(base_path() . '/resources/views/cp/slider')) {
            $this->loadViewsFrom(base_path() . '/resources/views/cp/slider', 'slider');
        } else {
            $this->loadViewsFrom(__DIR__ . '/views', 'slider');
        }


        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');



        $this->loadTranslationsFrom(__DIR__ . '/lang', 'slider');

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
        $this->app->make('Cp\Slider\Controllers\SliderController');
        $this->app->make('Cp\Slider\Controllers\AdminSliderController');


        //config
        $this->mergeConfigFrom(__DIR__ . '/config/slider.php', 'slider');
    }
}
