<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest:admin']], function () {
    Route::get('/login', 'AuthController@viewLogin')->name('login');
    Route::post('/login', 'AuthController@login')->name('login');
});

Route::group(['middleware' => ['auth:admin']], function () {

    // logout
    Route::post('admin-logout', 'AuthController@adminLogout')->name('admin.logout');

    // home
    Route::get('/','HomeController@index');
    Route::get('home','HomeController@index');



    //governments
    Route::resource('goverments', 'GovermentController');

     //categories
     Route::resource('categories', 'CategoryController');
     Route::resource('categories.sub-categories', 'SubCategoryController');

     //suppliers
     Route::resource('suppliers', 'SupplierController');
     Route::get('suppliers/products/{id}','SupplierController@supplierProducts');
     Route::put('suppliers/products/discount-value/{id}/active','SupplierController@activateAllDiscountValue');
     Route::put('suppliers/products/{id}/active','SupplierController@activateAllProducts');
     Route::put('suppliers/products/{id}/not-active','SupplierController@dactivateAllProducts');
     Route::put('suppliers/products/discount-percent/{id}/active','SupplierController@activateAllDiscountPercent');
     Route::get('suppliers/toggle-boolean/{id}/{action}', 'SupplierController@toggleBoolean')->name('supplier.is_active');



     //start routes for store
     Route::get('store', 'StoreController@entryPoint')->name('store.index');
     //this routes for products on store
     Route::get('store/products', 'StoreController@getProducts')->name('store.get-products');
     Route::get('store/products/show/{id}', 'StoreController@showProductOnStore')->name('store.product.show');

     //this routes for add quantity from product on store (AddQuantity controller)
     Route::get('store/pending-add-quantity', 'AddQuantityController@pendingAddQuantityFormProduct')->name('store.add-quantity');
     Route::get('store/pending-add-quantity/show/{id}', 'AddQuantityController@showAddQuantityProduct')->name('store.add-quantity.show');
     Route::put('store/pending-add-quantity/{id}/accept', 'AddQuantityController@acceptPendingAddQuantityFormProduct')->name('store.add-quantity.accept');
     Route::put('store/pending-add-quantity/{id}/reject', 'AddQuantityController@rejectPendingAddQuantityFormProduct')->name('store.add-quantity.reject');

     //this routes for pull quantity form products on store (PullQuantityController)
     Route::get('store/pending-pull-quantity', 'PullQuantityController@pendingPullQuantityFormProduct')->name('store.pull-quantity');
     Route::get('store/pending-pull-quantity/show/{id}', 'PullQuantityController@showPullQuantityProduct')->name('store.pull-quantity.show');
     Route::put('store/pending-pull-quantity/{id}/accept', 'PullQuantityController@acceptPendingPullQuantityFormProduct')->name('store.pull-quantity.accept');
     Route::put('store/pending-pull-quantity/{id}/reject', 'PullQuantityController@rejectPendingPullQuantityFormProduct')->name('store.pull-quantity.reject');

     //end routes for store.

     //start routes for products
     //this routes for pending products
     Route::get('products/pending', 'ProductController@indexForPendingProducts')->name('products.pending');
     Route::get('products/pending/show/{id}', 'ProductController@showPendingProduct')->name('product.pending.show');
     Route::put('products/pending/{id}/accept', 'ProductController@acceptPendingProduct')->name('product.pending.accept');
     Route::put('products/pending/{id}/reject', 'ProductController@rejectPendingProduct')->name('product.pending.reject');

     //this route for accepted products
     Route::resource('products/accepted', 'ProductController');
     Route::get('products/accepted/toggle-boolean/{id}/{action}', 'ProductController@toggleBoolean')->name('products.accepted.toggleBoolean');
     Route::delete('photos/destory/{id}', 'PhotoController@destroy')->name('admin.photo.destroy');

     //this routes for products out of stock
     Route::get('products/out-of-stock', 'ProductController@indexForProductsOutOfStock')->name('products.out-of-stock');

     //end routes for products

     //discount code routes
     Route::resource('discount-code', 'DiscountCodeController');
     Route::get('discount-code/toggle-boolean/{id}/{action}', 'DiscountCodeController@toggleBoolean')->name('discount-code.toggleBoolean');

     //advertisement
     Route::resource('advertisements', 'AdvertisementController');
     Route::get('advertisements/toggle-boolean/{id}/{action}', 'AdvertisementController@toggleBoolean')->name('advertisements.toggleBoolean');


     //complaint
     Route::resource('complaints', 'ComplaintController');

    // logs
    Route::resource('logs', 'LogController');

    // settings
    Route::get('settings', 'SettingController@view')->name('settings.index');
    Route::post('settings', 'SettingController@update')->name('settings.update');
    Route::resource('developer/setting', 'DeveloperSetting');
    Route::resource('developer/settings/categories', 'SettingCategoryController');

    // policis
    // Route::resource('policies','PolicyController');
    //payments
    Route::get('payment/all','PaymentController@allPayments')->name('all.payment');
    Route::resource('payment','PaymentController');

    // users
    Route::get('update-profile', 'UserController@updateProfileView');
    Route::post('update-profile', 'UserController@updateProfile');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');

    // backups
    Route::get('backup', 'BackupController@index')->name('backup.index');
    Route::post('download', 'BackupController@download')->name('db-download');
    Route::post('upload', 'BackupController@upload')->name('db-upload');

    //orders
    Route::group(['prefix' => 'orders'], function () {
        
        Route::get('paymob','OrderController@paymob')->name('orders.paymob');


        Route::group(['prefix' => 'pending'],function () {
            Route::get('','OrderController@pendingOrders')->name('orders.pending');
            Route::get('show/{id}','OrderController@showPendingOrder')->name('orders.pending.show');
            Route::put('accept/{id}', 'OrderController@acceptPendingOrder')->name('orders.pending.accept');

        });

        Route::group(['prefix' => 'inProgress'],function () {
            Route::get('','OrderController@inProgressOrders')->name('orders.inProgress');
            Route::get('show/{id}','OrderController@showInProgressOrder')->name('orders.inProgress.show');
            Route::put('accept/{id}', 'OrderController@acceptInProgressOrder')->name('orders.inProgress.accept');

        });

        Route::group(['prefix' => 'ready'],function () {
            Route::get('','OrderController@readyOrders')->name('orders.ready');
            Route::get('show/{id}','OrderController@showReadyOrder')->name('orders.ready.show');
        Route::put('accept/{id}', 'OrderController@acceptReadyOrder')->name('orders.ready.accept');

        });

        Route::group(['prefix' => 'delivering'],function () {
            Route::get('','OrderController@deliveringOrders')->name('orders.delivering');
            Route::get('show/{id}','OrderController@showDeliveringOrder')->name('orders.delivering.show');
            Route::put('accept/{id}', 'OrderController@acceptDeliveringOrder')->name('orders.delivering.accept');

        });

        Route::group(['prefix' => 'received'],function () {
            Route::get('','OrderController@receivedOrders')->name('orders.received');
            Route::get('show/{id}','OrderController@showReceivedOrder')->name('orders.received.show');
            Route::post('{order_id}/refund/store','RefundController@store')->name('refund.store');
        });

        Route::group(['prefix' => 'canceled'],function () {
            Route::get('','OrderController@canceledOrders')->name('orders.canceled');
            Route::get('show/{id}','OrderController@showCanceledOrder')->name('orders.canceled.show');
            Route::post('{order_id}/canceled/accept','OrderController@canceledOrderAccept')->name('canceled.accept');
        });

    });
///refunds
    Route::get('refund','RefundController@index')->name('refund.index');
    Route::get('refund/{id}/show','RefundController@show')->name('refund.show');
//reports
Route::get('reports','ReportController@index')->name('report.index');
Route::get('reports/{id}/show','ReportController@orderRefund')->name('report.order.refunds');

//customers 
Route::get('customers','CustomerController@index')->name('customers.index');
Route::get('customers/{id}/orders','CustomerController@customerOrders')->name('customer.orders');


});
