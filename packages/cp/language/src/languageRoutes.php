<?php
//frontend
Route::group(['middleware' => ['web']], function () {
    Route::post('/languages/update/status/{language}', [
        'uses' => 'Cp\Language\Controllers\LanguageController@languageUpdateStatus',
        'as' => 'languageUpdateStatus'
    ]);
});


//admin
Route::group(['middleware' => ['web', 'auth', 'role:admin'], 'prefix' => 'admin'], function () {
    Route::get('languages', [
        'uses' => 'Cp\Language\Controllers\AdminLanguageController@languages',
        'as' => 'admin.languages'
    ]);

    Route::get('language/create', [
        'uses' => 'Cp\Language\Controllers\AdminLanguageController@languageCreate',
        'as' => 'admin.languageCreate'
    ]);

    Route::post('language/store', [
        'uses' => 'Cp\Language\Controllers\AdminLanguageController@languageStore',
        'as' => 'admin.languageStore'
    ]);

    Route::get('language/edit/{language}', [
        'uses' => 'Cp\Language\Controllers\AdminLanguageController@languageEdit',
        'as' => 'admin.languageEdit'
    ]);

    Route::post('language/update/{language}', [
        'uses' => 'Cp\Language\Controllers\AdminLanguageController@languageUpdate',
        'as' => 'admin.languageUpdate'
    ]);

    Route::post('language/delete/{language}', [
        'uses' => 'Cp\Language\Controllers\AdminLanguageController@languageDelete',
        'as' => 'admin.languageDelete'
    ]);

    Route::post('language/status', [
        'uses' => 'Cp\Language\Controllers\AdminLanguageController@languageStatus',
        'as' => 'admin.languageStatus'
    ]);


    Route::get('translations', [
        'uses' => 'Cp\Language\Controllers\AdminLanguageController@translations',
        'as' => 'admin.translations'
    ]);

    Route::post('translation/store', [
        'uses' => 'Cp\Language\Controllers\AdminLanguageController@translationStore',
        'as' => 'admin.translationStore'
    ]);




    Route::get('language/translations/{language}', [
        'uses' => 'Cp\Language\Controllers\AdminLanguageController@languageTranslatoins',
        'as' => 'admin.languageTranslatoins'
    ]);

    Route::post('language/translation/value/store', [
        'uses' => 'Cp\Language\Controllers\AdminLanguageController@languageTranslateValueStore',
        'as' => 'admin.languageTranslateValueStore'
    ]);

    Route::get('language/translation/search/ajax', [
        'uses' => 'Cp\Language\Controllers\AdminLanguageController@languageTranlationSearchAjax',
        'as' => 'admin.languageTranlationSearchAjax'
    ]);

    Route::post('env_key_update', [
        'uses' => 'Cp\Language\Controllers\AdminLanguageController@envKeyUpdate',
        'as' => 'admin.envKeyUpdate'
    ]);

});