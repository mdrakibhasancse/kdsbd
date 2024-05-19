<?php
//frontend
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'user'], function () {

    Route::get('dashboard', [
        'uses' => 'Cp\UserRole\Controllers\UserRoleController@dashboard',
        'as' => 'user.dashboard'
    ]);

    Route::post('change/my/information', [
        'uses' => 'Cp\UserRole\Controllers\UserRoleController@changeMyInformation',
        'as' => 'user.changeMyInformation'
    ]);
});


//admin
Route::group(['middleware' => ['web', 'auth', 'role:admin'], 'prefix' => 'admin'], function () {


    Route::get('users/all', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@usersAll',
        'as' => 'admin.usersAll'
    ]);



    Route::get('user/create', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@userCreate',
        'as' => 'admin.userCreate'
    ]);

    Route::post('user/store', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@userStore',
        'as' => 'admin.userStore'
    ]);

    Route::get('user/edit/user/{user}', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@userEdit',
        'as' => 'admin.userEdit'
    ]);

    Route::post('user/update/user/{user}', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@userUpdate',
        'as' => 'admin.userUpdate'
    ]);


    Route::post('user/delete/user/{user}', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@userDelete',
        'as' => 'admin.userDelete'
    ]);



    Route::get('roles/all', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@rolesAll',
        'as' => 'admin.rolesAll'
    ]);

    Route::get('role/create', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@roleCreate',
        'as' => 'admin.roleCreate'
    ]);

    Route::get('role/show/role/{role}', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@roleShow',
        'as' => 'admin.roleShow'
    ]);

    Route::post('role/delete/role/{role}', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@roleDelete',
        'as' => 'admin.roleDelete'
    ]);

    Route::get('role/edit/role/{role}', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@roleEdit',
        'as' => 'admin.roleEdit'
    ]);

    Route::post('role/update/role/{role}', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@roleUpdate',
        'as' => 'admin.roleUpdate'
    ]);

    Route::post('role/store', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@roleStore',
        'as' => 'admin.roleStore'
    ]);


    Route::get('permissions/all', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@permissionsAll',
        'as' => 'admin.permissionsAll'
    ]);

    Route::get('permission/edit/permission/{permission}', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@permissionEdit',
        'as' => 'admin.permissionEdit'
    ]);

    Route::post('permission/store', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@permissionStore',
        'as' => 'admin.permissionStore'
    ]);

    Route::post('permission/update/permission/{permission}', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@permissionUpdate',
        'as' => 'admin.permissionUpdate'
    ]);

    Route::post('permission/delete/permission/{permission}', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@permissionDelete',
        'as' => 'admin.permissionDelete'
    ]);

    Route::get('permission/search', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@permissionSearch',
        'as' => 'admin.permissionSearch'
    ]);

    Route::get('assign/role', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@assignRole',
        'as' => 'admin.assignRole'
    ]);

    Route::post('assign/role/store', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@assignRoleStore',
        'as' => 'admin.assignRoleStore'
    ]);

    Route::post('role/detach/{user}', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@roleDetach',
        'as' => 'admin.roleDetach'
    ]);

    Route::get('ajax/user', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@ajaxUserSearch',
        'as' => 'admin.ajaxUserSearch'
    ]);

    Route::get('user/search', [
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@userSearch',
        'as' => 'admin.userSearch'
    ]);
});