<?php
//frontend
Route::group(['middleware' => ['web']], function () {

    Route::get('my/slider', [
        'uses' => 'Cp\WebsiteSitting\Controllers\WebsiteSittingController@myWebsiteSitting',
        'as' => 'myWebsiteSitting'
    ]);
});


//admin
Route::group(['middleware' => ['web', 'auth', 'role:admin'], 'prefix' => 'admin'], function () {

    // websitesetting route

    Route::get('websitesetting', [
        'uses' => 'Cp\WebsiteSetting\Controllers\AdminWebsiteSettingController@websitesetting',
        'as' => 'admin.websitesetting'
    ]);

    Route::post('websitesetting/update/{ws}', [
        'uses' => 'Cp\WebsiteSetting\Controllers\AdminWebsiteSettingController@websiteSettingUpdate',
        'as' => 'admin.websiteSettingUpdate'
    ]);
});