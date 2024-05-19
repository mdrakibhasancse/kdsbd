<?php

namespace App\Providers;


use Cp\Menupage\Models\Menu;
use Cp\Menupage\Models\Page;
use Cp\Product\Models\Branch;
use Cp\Product\Models\Cart;
use Cp\Product\Models\BranchArea;
use Cp\Product\Models\ProductCategory;
use Cp\WebsiteSetting\Models\WebsiteSetting;
use Laravel\Ui\Presets\Bootstrap;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $seconds = 86400; //24 hours

            $headerMenus = cache()->remember('headerMenus', $seconds, function () {
                return Menu::whereActive(true)->orderBy('drag_id')->where('type','header_menu')->latest()->get();
            });
            View::share('headerMenus', $headerMenus);

            $footerMenus = cache()->remember('footerMenus', $seconds, function () {
                return Menu::whereActive(true)->orderBy('drag_id')->where('type', 'footer_menu')->latest()->get();
            });
            View::share('footerMenus', $footerMenus);

            
            $branches = cache()->remember('branches', $seconds, function () {
                return Branch::whereActive(true)->latest()->get();
            });
            View::share('branches', $branches);

            $areas = cache()->remember('areas', $seconds, function () {
                return BranchArea::whereActive(true)->latest()->get();
            });
            View::share('areas', $areas);
            

            // $categories = cache()->remember('categories', $seconds, function () {
            //     return ProductCategory::whereActive(true)->latest()->get();
            // });
            // View::share('categories', $categories);



            $ws =  cache()->remember('ws', $seconds, function () {
                return WebsiteSetting::first();
            });
            View::share('ws', $ws);


            // $collections = cache()->remember('collections', $seconds, function () {
            //     return $collections = Cart::getCartItems();
            // });
            // View::share('collections', $collections);

           View::share('cats', $cats = ProductCategory::whereActive(true)->latest()->take(7)->get());

           

            View::share('collections', $collections = Cart::getCartItems());

        });

        paginator::useBootstrap();
    }
}