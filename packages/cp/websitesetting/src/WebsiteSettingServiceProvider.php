<?php

namespace Cp\WebsiteSetting;

use Illuminate\Support\ServiceProvider;

class WebsiteSettingServiceProvider extends ServiceProvider
{
    //https://github.com/gocanto/gocanto-pkg
    //https://laravel.com/docs/5.2/packages
    //http://stackoverflow.com/questions/19133020/using-models-on-packages


    public function boot()
    {
        //routes.php
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/websiteSettingRoutes.php';
        }

        //views
        if (is_dir(base_path() . '/resources/views/cp/websitesetting')) {
            $this->loadViewsFrom(base_path() . '/resources/views/cp/websitesetting', 'websitesetting');
        } else {
            $this->loadViewsFrom(__DIR__ . '/views', 'websitesetting');
        }


        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');



        $this->loadTranslationsFrom(__DIR__ . '/lang', 'websitesetting');

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
        $this->app->make('Cp\WebsiteSetting\Controllers\WebsiteSettingController');
        $this->app->make('Cp\WebsiteSetting\Controllers\AdminWebsiteSettingController');


        //config
        $this->mergeConfigFrom(__DIR__ . '/config/websitesetting.php', 'websitesetting');
    }
}
