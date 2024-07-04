<?php
//frontend
Route::group(['middleware' => ['web']], function () {


    Route::get('/', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@welcome',
        'as' => 'welcome'
    ]);


    Route::post('/send/otp', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@sendOtp',
        'as' => 'sendOtp'
    ]);

    Route::post('/send/otp/match', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@sendOtpMatch',
        'as' => 'sendOtpMatch'
    ]);

    Route::post('/send/otp/match/user', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@sendOtpMatchUser',
        'as' => 'sendOtpMatchUser'
    ]);


    Route::get('/categories/all', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@categoriesAll',
        'as' => 'categoriesAll'
    ]);


    Route::get('/category/{slug}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@category',
        'as' => 'category'
    ]);


    Route::post('/subcategory', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@subcategory',
        'as' => 'subcategory'
    ]);
    

    Route::get('/offer/products', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@offerProducts',
        'as' => 'offerProducts'
    ]);


    Route::get('/product/{slug}/{id}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@product',
        'as' => 'product'
    ]);

  

    Route::get('area/change', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@areaChange',
        'as' => 'areaChange'
    ]);


    Route::post('add-to-cart/{product}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@addToCart',
        'as' => 'addToCart'
    ]);


    Route::post('/cart/update/qty/{cart}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@cartUpdateQty',
        'as' => 'cartUpdateQty'
    ]);

    Route::post('/cart/remove/item/{cart}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@cartRemoveItem',
        'as' => 'cartRemoveItem'
    ]);


    Route::post('add-to-cart-deal-product/{deal}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@addToCartDealProduct',
        'as' => 'addToCartDealProduct'
    ]);


    Route::get('/page/{slug?}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@page',
        'as' => 'page'
    ]);


    Route::get('/search', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@search',
        'as' => 'search'
    ]);


    Route::get('/deal-of-the-week/{deal}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@dealOfTheWeek',
        'as' => 'dealOfTheWeek'
    ]);
   
    Route::get('/sitemap.xml', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@sitemap',
        'as' => 'sitemap'
    ]);

});


Route::group(['middleware' => ['web', 'auth']], function () {
   

    Route::get('/checkout', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@checkout',
        'as' => 'checkout'
    ]);
    
    Route::post('/order/store', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@orderStore',
        'as' => 'orderStore'
    ]);

   
});