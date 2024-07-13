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


    Route::get('branch/product/quick/pos', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchProductQuickPos',
        'as' => 'admin.branchProductQuickPos'
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



    // Deal Route

    Route::get('deals/all/branch/{branch}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@dealsAll',
        'as' => 'admin.dealsAll'
    ]);

    Route::post('deal/store', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@dealStore',
        'as' => 'admin.dealStore'
    ]);

    Route::get('deal/edit/{deal}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@dealEdit',
        'as' => 'admin.dealEdit'
    ]);

    Route::post('deal/update/{deal}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@dealUpdate',
        'as' => 'admin.dealUpdate'
    ]);

    Route::post('deal/delete/{deal}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@dealDelete',
        'as' => 'admin.dealDelete'
    ]);

    Route::get('deal/status/{deal}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@dealStatus',
        'as' => 'admin.dealStatus'
    ]);
   

    
    Route::get('deal/details/{deal}/branch/{branch}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@dealDetails',
        'as' => 'admin.dealDetails'
    ]);


    Route::get('deal/product/modal/open/{deal}/branch/{branch}/type/{type?}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@dealProductModalOpen',
        'as' => 'admin.dealProductModalOpen'
    ]);


    
    Route::get('branch/product/search/ajax/{branch}/deal/{deal}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchDealProductSearchAjax',
        'as' => 'admin.branchDealProductSearchAjax'
    ]);


    Route::get('select/branch/{branch}/product/{product}/deal/{deal}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@selectbranchDealProduct',
        'as' => 'admin.selectbranchDealProduct'
    ]);

    Route::get('un_select/branch/{branch}/product/{product}/deal/{deal}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@unSelectbranchDealProduct',
        'as' => 'admin.unSelectbranchDealProduct'
    ]);


    Route::get('deal/product/delete/{product}/deal/{deal}/branch/{branch}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@dealProductDelete',
        'as' => 'admin.dealProductDelete'
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



    Route::get('branch/wise/{branch}/order/manage', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchWiseOrderManage',
        'as' => 'admin.branchWiseOrderManage'
    ]);


    Route::get('order/type', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@typeOfOrder',
        'as' => 'admin.typeOfOrder'
    ]);

    Route::get('branch/{branch}/order/report', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@branchOrderReport',
        'as' => 'admin.branchOrderReport'
    ]);


    //pos system

    Route::group(['prefix' => 'pos'], function () {

        Route::get('branch/{branch}/module', [
            'uses' => 'Cp\Product\Controllers\AdminProductController@pos',
            'as' => 'admin.pos'
        ]);


        Route::get('product/search/ajax/branch/{branch}', [
            'uses' => 'Cp\Product\Controllers\AdminProductController@PosProductSearch',
            'as' => 'admin.PosProductSearch'
        ]);


        Route::get('branch/{branch}/another/module', [
            'uses' => 'Cp\Product\Controllers\AdminProductController@posModuleAnother',
            'as' => 'admin.posModuleAnother'
        ]);

        Route::get('branch/{branch}/module/{module}/make/active', [
            'uses' => 'Cp\Product\Controllers\AdminProductController@posModuleMakeActive',
            'as' => 'admin.posModuleMakeActive'
        ]);

        Route::get('branch/{branch}/module/{module}/delete', [
            'uses' => 'Cp\Product\Controllers\AdminProductController@posModuleDelete',
            'as' => 'admin.posModuleDelete'
        ]);

        Route::post('add/module/item/{module}/branch/{branch}', [
            'uses' => 'Cp\Product\Controllers\AdminProductController@addModuleItem',
            'as' => 'admin.addModuleItem'
        ]);


        Route::get('ajax/product/module/item/{module}/branch/{branch}', [
            'uses' => 'Cp\Product\Controllers\AdminProductController@ajaxProductItemStore',
            'as' => 'admin.ajaxProductItemStore'
        ]);


        Route::get('module/{module}/update/item/{item}/quantity', [
            'uses' => 'Cp\Product\Controllers\AdminProductController@moduleUpdateItemQty',
            'as' => 'admin.moduleUpdateItemQty'
        ]);


        Route::get('module/{module}/item/{item}/delete', [
            'uses' => 'Cp\Product\Controllers\AdminProductController@moduleItemDelete',
            'as' => 'admin.moduleItemDelete'
        ]);


        Route::get('module/discount/amount/{module}', [
            'uses' => 'Cp\Product\Controllers\AdminProductController@moduleDiscountAmount',
            'as' => 'admin.moduleDiscountAmount'
        ]);


        Route::get('module/paid/amount/{module}', [
            'uses' => 'Cp\Product\Controllers\AdminProductController@modulePaidAmount',
            'as' => 'admin.modulePaidAmount'
        ]);


        Route::post('/order/store/branch/{branch}/module/{module}', [
            'uses' => 'Cp\Product\Controllers\AdminProductController@posOrderStore',
            'as' => 'admin.posOrderStore'
        ]);

         Route::get('/order/store/and/print/branch/{branch}/module/{module}', [
            'uses' => 'Cp\Product\Controllers\AdminProductController@posOrderStoreAndPrint',
            'as' => 'admin.posOrderStoreAndPrint'
        ]);


        Route::get('/orders/report', [
            'uses' => 'Cp\Product\Controllers\AdminProductController@posOrdersReport',
            'as' => 'admin.posOrdersReport'
        ]);


        Route::get('/order/details/{order}', [
            'uses' => 'Cp\Product\Controllers\AdminProductController@posOrderDetails',
            'as' => 'admin.posOrderDetails'
        ]);

        Route::get('/order/print/{order}', [
            'uses' => 'Cp\Product\Controllers\AdminProductController@posOrderPrint',
            'as' => 'admin.posOrderPrint'
        ]);

        Route::post('/get/user/branch/{branch}/module/{module}', [
            'uses' => 'Cp\Product\Controllers\AdminProductController@getUser',
            'as' => 'admin.getUser'
        ]);

        Route::post('/user/add/new/module/{module}', [
            'uses' => 'Cp\Product\Controllers\AdminProductController@userAddNew',
            'as' => 'admin.userAddNew'
        ]);

    });



});