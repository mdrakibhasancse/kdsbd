<?php
//frontend

Route::group(['middleware' => ['web', 'auth']], function () {
    
});


//admin
Route::group(['middleware' => ['web', 'auth', 'role:admin'], 'prefix' => 'admin'], function () {

    Route::get('product/categories/all', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoriesAll',
        'as' => 'admin.productCategoriesAll'
    ]);


    Route::get('product/category/create', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoryCreate',
        'as' => 'admin.productCategoryCreate'
    ]);


    Route::post('product/category/store', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoryStore',
        'as' => 'admin.productCategoryStore'
    ]);

    Route::get('product/category/edit/{category}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoryEdit',
        'as' => 'admin.productCategoryEdit'
    ]);

    Route::post('product/category/update/{category}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoryUpdate',
        'as' => 'admin.productCategoryUpdate'
    ]);


    Route::post('product/category/delete/{category}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoryDelete',
        'as' => 'admin.productCategoryDelete'
    ]);


    Route::get('category/status/{category}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@categoryStatus',
        'as' => 'admin.categoryStatus'
    ]);

    // SubCategory route

    Route::get('product/subCategories/all', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoriesAll',
        'as' => 'admin.productSubCategoriesAll'
    ]);


    Route::get('product/subcategory/create', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoryCreate',
        'as' => 'admin.productSubCategoryCreate'
    ]);


    Route::post('product/subCategory/store', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoryStore',
        'as' => 'admin.productSubCategoryStore'
    ]);

    Route::get('product/subCategory/edit/subCategory/{subCategory}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoryEdit',
        'as' => 'admin.productSubCategoryEdit'
    ]);

    Route::post('product/subCategory/update/subCategory/{subCategory}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoryUpdate',
        'as' => 'admin.productSubCategoryUpdate'
    ]);

    Route::post('product/subCategory/delete/subCategory/{subCategory}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoryDelete',
        'as' => 'admin.productSubCategoryDelete'
    ]);

    Route::get('subcategory/status/{subcategory}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@subcategoryStatus',
        'as' => 'admin.subcategoryStatus'
    ]);

    // Branch route

    Route::get('branches/all', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchesAll',
        'as' => 'admin.branchesAll'
    ]);

    Route::get('branch/create', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchCreate',
        'as' => 'admin.branchCreate'
    ]);

    Route::post('branch/store', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchStore',
        'as' => 'admin.branchStore'
    ]);

    Route::get('branch/edit/{branch}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchEdit',
        'as' => 'admin.branchEdit'
    ]);

    Route::post('branch/update/{branch}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchUpdate',
        'as' => 'admin.branchUpdate'
    ]);

    Route::post('branch/delete/{branch}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchDelete',
        'as' => 'admin.branchDelete'
    ]);

    Route::get('branch/show/{branch}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchShow',
        'as' => 'admin.branchShow'
    ]);


    Route::get('branch/wise/{branch}/product/manage', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchWiseProductManage',
        'as' => 'admin.branchWiseProductManage'
    ]);



    // Branch area route

    Route::get('branch/{branch}/brancharea', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchArea',
        'as' => 'admin.branchArea'
    ]);

    Route::post('branch/area/store', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchAreaStore',
        'as' => 'admin.branchAreaStore'
    ]);

    Route::get('branch/area/edit/{brancharea}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchAreaEdit',
        'as' => 'admin.branchAreaEdit'
    ]);

    Route::post('branch/area/update/{brancharea}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchAreaUpdate',
        'as' => 'admin.branchAreaUpdate'
    ]);

    Route::post('branch/area/delete/{brancharea}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchAreaDelete',
        'as' => 'admin.branchAreaDelete'
    ]);

    Route::get('branch/area/status/{brancharea}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchAreaStatus',
        'as' => 'admin.branchAreaStatus'
    ]);


    Route::get('branch/product/status', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchProductStatus',
        'as' => 'admin.branchProductStatus'
    ]);



    // product route

    Route::get('products/all', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productsAll',
        'as' => 'admin.productsAll'
    ]);

    Route::get('product/create', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCreate',
        'as' => 'admin.productCreate'
    ]);

    Route::post('product/store', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productStore',
        'as' => 'admin.productStore'
    ]);

    Route::get('product/edit/{product}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productEdit',
        'as' => 'admin.productEdit'
    ]);

    Route::get('product/show/{product}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productShow',
        'as' => 'admin.productShow'
    ]);


    Route::post('product/update/{product}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productUpdate',
        'as' => 'admin.productUpdate'
    ]);

    Route::post('product/delete/{product}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productDelete',
        'as' => 'admin.productDelete'
    ]);


    Route::get('product/status/{product}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productStatus',
        'as' => 'admin.productStatus'
    ]);

    Route::get('product/tags', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productTags',
        'as' => 'admin.productTags'
    ]);


    Route::get('product/search/type/{type}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSearch',
        'as' => 'admin.productSearch'
    ]);


    Route::get('product/add/stock/{product}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productAddStock',
        'as' => 'admin.productAddStock'
    ]);


   


    // order route

    Route::get('order/list', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@orderList',
        'as' => 'admin.orderList'
    ]);

    Route::get('order/details/{order}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@orderDeatils',
        'as' => 'admin.orderDeatils'
    ]);

    Route::post('order/status/{order}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@orderStatus',
        'as' => 'admin.orderStatus'
    ]);

    Route::post('order/payment/{order}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@orderPayment',
        'as' => 'admin.orderPayment'
    ]);

    Route::post('orderdelete/{order}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@orderDelete',
        'as' => 'admin.orderDelete'
    ]);


    Route::post('order/item/delete/{orderItem}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@orderItemDelete',
        'as' => 'admin.orderItemDelete'
    ]);



    Route::post('update/qty/{item}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@updateQty',
        'as' => 'updateQty'
    ]);
    

    Route::get('invoice/print/{order}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@orderPrint',
        'as' => 'admin.orderPrint'
    ]);


    Route::get('product/modal/open/{order}/type/{type?}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productModalOpen',
        'as' => 'admin.productModalOpen'
    ]);


    Route::get('branch/product/search/ajax/{branch}/order/{order}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchProductSearchAjax',
        'as' => 'admin.branchProductSearchAjax'
    ]);


    Route::get('select/branch/{branch}/product/{product}/order/{order}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@selectbranchProduct',
        'as' => 'admin.selectbranchProduct'
    ]);

    Route::get('un_select/branch/{branch}/product/{product}/order/{order}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@unSelectbranchProduct',
        'as' => 'admin.unSelectbranchProduct'
    ]);

});