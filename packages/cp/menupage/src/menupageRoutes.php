<?php
//frontend
Route::group(['middleware' => ['web']], function () {

    Route::get('my/menupage', [
        'uses' => 'Cp\Menupage\Controllers\MenupageController@myMenupage',
        'as' => 'myMenupage'
    ]);
});


//admin
Route::group(['middleware' => ['web', 'auth', 'role:admin'], 'prefix' => 'admin'], function () {


    // menu route

    Route::get('menus/all', [
        'uses' => 'Cp\Menupage\Controllers\AdminMenupageController@menusAll',
        'as' => 'admin.menusAll'
    ]);


    Route::post('menu/store', [
        'uses' => 'Cp\Menupage\Controllers\AdminMenupageController@menuStore',
        'as' => 'admin.menuStore'
    ]);

    Route::get('menu/edit/menu/{menu}', [
        'uses' => 'Cp\Menupage\Controllers\AdminMenupageController@menuEdit',
        'as' => 'admin.menuEdit'
    ]);

    Route::post('menu/update/menu/{menu}', [
        'uses' => 'Cp\Menupage\Controllers\AdminMenupageController@menuUpdate',
        'as' => 'admin.menuUpdate'
    ]);

    Route::get('menu/show/menu/{menu}', [
        'uses' => 'Cp\Menupage\Controllers\AdminMenupageController@menuShow',
        'as' => 'admin.menuShow'
    ]);

    Route::post('menu/delete/menu/{menu}', [
        'uses' => 'Cp\Menupage\Controllers\AdminMenupageController@menuDelete',
        'as' => 'admin.menuDelete'
    ]);

    Route::get('menu/sort', [
        'uses' => 'Cp\Menupage\Controllers\AdminMenupageController@menuSort',
        'as' => 'admin.menuSort'
    ]);


    // page route

    Route::get('pages/all', [
        'uses' => 'Cp\Menupage\Controllers\AdminMenupageController@pagesAll',
        'as' => 'admin.pagesAll'
    ]);


    Route::post('page/store', [
        'uses' => 'Cp\Menupage\Controllers\AdminMenupageController@pageStore',
        'as' => 'admin.pageStore'
    ]);

    Route::get('page/edit/page/{page}', [
        'uses' => 'Cp\Menupage\Controllers\AdminMenupageController@pageEdit',
        'as' => 'admin.pageEdit'
    ]);

    Route::post('page/update/page/{page}', [
        'uses' => 'Cp\Menupage\Controllers\AdminMenupageController@pageUpdate',
        'as' => 'admin.pageUpdate'
    ]);

    Route::get('page/delete/page/{page}', [
        'uses' => 'Cp\Menupage\Controllers\AdminMenupageController@pageDelete',
        'as' => 'admin.pageDelete'
    ]);

    Route::get('page/sort', [
        'uses' => 'Cp\Menupage\Controllers\AdminMenupageController@pageSort',
        'as' => 'admin.pageSort'
    ]);



    // pageItem route

    Route::get('page/{page}/pageItem/create', [
        'uses' => 'Cp\Menupage\Controllers\AdminMenupageController@pageItemCreate',
        'as' => 'admin.pageItemCreate'
    ]);


    Route::post('pageItem/store', [
        'uses' => 'Cp\Menupage\Controllers\AdminMenupageController@pageItemStore',
        'as' => 'admin.pageItemStore'
    ]);

    Route::get('pageItem/edit/pageItem/{pageItem}', [
        'uses' => 'Cp\Menupage\Controllers\AdminMenupageController@pageItemEdit',
        'as' => 'admin.pageItemEdit'
    ]);

    Route::post('pageItem/update/pageItem/{pageItem}', [
        'uses' => 'Cp\Menupage\Controllers\AdminMenupageController@pageItemUpdate',
        'as' => 'admin.pageItemUpdate'
    ]);

    Route::get('pageItem/delete/pageItem/{pageItem}', [
        'uses' => 'Cp\Menupage\Controllers\AdminMenupageController@pageItemDelete',
        'as' => 'admin.pageItemDelete'
    ]);

    Route::get('menupage/search/type/{type}', [
        'uses' => 'Cp\Menupage\Controllers\AdminMenupageController@menupageSearch',
        'as' => 'admin.menupageSearch'
    ]);
});