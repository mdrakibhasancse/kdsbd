<?php
// frontend
Route::group(['middleware' => ['web']], function () {

    Route::get('my/slider', [
        'uses' => 'Cp\Slider\Controllers\SliderController@mySlider',
        'as' => 'mySlider'
    ]);
});


//admin
Route::group(['middleware' => ['web', 'auth', 'role:admin'], 'prefix' => 'admin'], function () {

    // slider route

    Route::get('sliders/all', [
        'uses' => 'Cp\Slider\Controllers\AdminSliderController@slidersAll',
        'as' => 'admin.slidersAll'
    ]);

    Route::post('slider/store', [
        'uses' => 'Cp\Slider\Controllers\AdminSliderController@sliderStore',
        'as' => 'admin.sliderStore'
    ]);

    Route::get('slider/edit/{slider}', [
        'uses' => 'Cp\Slider\Controllers\AdminSliderController@sliderEdit',
        'as' => 'admin.sliderEdit'
    ]);

    Route::post('slider/update/{slider}', [
        'uses' => 'Cp\Slider\Controllers\AdminSliderController@sliderUpdate',
        'as' => 'admin.sliderUpdate'
    ]);

    Route::post('slider/delete/{slider}', [
        'uses' => 'Cp\Slider\Controllers\AdminSliderController@sliderDelete',
        'as' => 'admin.sliderDelete'
    ]);

    Route::get('slider/status/{slider}', [
        'uses' => 'Cp\Slider\Controllers\AdminSliderController@sliderStatus',
        'as' => 'admin.sliderStatus'
    ]);

    Route::get('slider/search', [
        'uses' => 'Cp\Slider\Controllers\AdminSliderController@sliderSearch',
        'as' => 'admin.sliderSearch'
    ]);
});