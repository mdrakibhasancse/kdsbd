<?php
//menupage //menu & page
Route::group(['middleware' => ['web']], function () {

    Route::get('my/media', [
        'uses' => 'Cp\Media\Controllers\MediaController@myMedia',
        'as' => 'myMedia'
    ]);
});


//admin
Route::group(['middleware' => ['web', 'auth', 'role:admin'], 'prefix' => 'admin'], function () {

    // media route

    Route::get('medias/all', [
        'uses' => 'Cp\Media\Controllers\AdminMediaController@mediasAll',
        'as' => 'admin.mediasAll'
    ]);

    Route::post('media/store', [
        'uses' => 'Cp\Media\Controllers\AdminMediaController@mediaStore',
        'as' => 'admin.mediaStore'
    ]);

    Route::get('media/delete/{media}', [
        'uses' => 'Cp\Media\Controllers\AdminMediaController@mediaDelete',
        'as' => 'admin.mediaDelete'
    ]);

    Route::get('medias-ajax', [
        'uses' => 'Cp\Media\Controllers\AdminMediaController@getMediasAjax',
        'as' => 'admin.getMediasAjax'
    ]);
});