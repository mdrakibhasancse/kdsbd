<?php

namespace Cp\Product;

use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    //https://github.com/gocanto/gocanto-pkg
    //https://laravel.com/docs/5.2/packages
    //http://stackoverflow.com/questions/19133020/using-models-on-packages


    public function boot()
    {
        //routes.php
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/productRoutes.php';
        }

        //views
        if (is_dir(base_path() . '/resources/views/cp/product')) {
            $this->loadViewsFrom(base_path() . '/resources/views/cp/product', 'product');
        } else {
            $this->loadViewsFrom(__DIR__ . '/views', 'product');
        }


        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');



        $this->loadTranslationsFrom(__DIR__ . '/lang', 'product');

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
        $this->app->make('Cp\Product\Controllers\ProductController');
        $this->app->make('Cp\Product\Controllers\AdminProductController');


        //config
        $this->mergeConfigFrom(__DIR__ . '/config/product.php', 'product');
    }
}
