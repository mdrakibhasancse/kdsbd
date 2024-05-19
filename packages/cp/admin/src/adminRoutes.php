<?php
//admin route 
use Illuminate\Support\Facades\Artisan;

Route::group(['middleware' => ['web', 'auth', 'role:admin'], 'prefix' => 'admin'], function () {


    Route::get('dashboard', [
        'uses' => 'Cp\Admin\Controllers\AdminController@dashboard',
        'as' => 'admin.dashboard'
    ]);

    Route::get('theme/change', [
        'uses' => 'Cp\Admin\Controllers\AdminController@themeChange',
        'as' => 'admin.themeChange'
    ]);


    Route::get('image', function () {
        Artisan::call('storage:link');
        return back();
    });

    Route::get('/clear', function () {
        Artisan::call('optimize:clear');
        return back();
    })->name('clear_cache');


    Route::get('all/contact-us', [
        'uses' => 'Cp\Admin\Controllers\AdminController@contactsAll',
        'as' => 'admin.contactsAll'
    ]);

    Route::post('delete/contact/{id}', [
        'uses' => 'Cp\Admin\Controllers\AdminController@contactDelete',
        'as' => 'admin.contactDelete'
    ]);

});