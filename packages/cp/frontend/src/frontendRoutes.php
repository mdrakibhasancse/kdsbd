<?php
//frontend
Route::group(['middleware' => ['web']], function () {


    Route::get('/', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@welcome',
        'as' => 'welcome'
    ]);

    Route::any('/register/modal/type/{type?}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@registerModal',
        'as' => 'registerModal'
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
    

    Route::get('/product/{slug}/{id}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@product',
        'as' => 'product'
    ]);

    Route::any('/location/type/{type?}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@location',
        'as' => 'location'
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