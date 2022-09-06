<?php

use App\Http\Controllers\Supplier\OrderController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;



    Route::group(['middleware' => ['guest:supplier']], function () {

        Route::get('/login', 'LoginController@viewLogin')->name('supplier.login');
        Route::post('/login', 'LoginController@login');
    });

    Route::group( ['middleware' => ['auth:supplier'],'as'=>'supplier.'], function () {
        //logOut
         Route::post('logout', 'LoginController@supplierLogout')->name('logout');
         //editAccount
         Route::get('account', 'LoginController@editAccount')->name('editAccount');
         Route::put('account', 'LoginController@updateAccount')->name('updateAccount');
         //home
        Route::get('/home', 'HomeController@index')->name('home');
        //products
        Route::resource('products', 'ProductController');
        Route::get('products/toggle-boolean/{id}/{action}', 'ProductController@toggleBoolean')->name('products.toggleBoolean');
        Route::delete('photos/destory/{id}', 'PhotoController@destroy')->name('photo.destroy');
         //rejected products
         Route::get('/rejected_products','ProductController@rejectedProducts')->name('products.rejected');
         Route::get('/rejected_products/{id}','ProductController@rejectedShow')->name('rejectedproducts.show');



        Route::group(['prefix'=>"product","as"=>"product."], function () {
                //addQuantity
                 Route::post('/addQuantity/{id}', 'AddQuantityController@addQ')->name('addQuantity');
                 Route::get('addQuantity/rejected','AddQuantityController@rejected')->name('addQuantity.rejected');
                Route::resource('addQuantity', 'AddQuantityController');
                //pullQuantity
                Route::get('pullQuantity/rejected','PullQuantityController@rejected')->name('pullQuantity.rejected');
                Route::post('/pullQuantity/{id}', 'PullQuantityController@pullQ')->name('pullQuantity');
                Route::resource('pullQuantity', 'PullQuantityController');
                //outofstock
                Route::get('products/out-of-stock', 'ProductController@outofstock')->name('outofstock');
                
    });
            Route::get('orders' , 'OrderController@index')->name('orders');
            Route::get('orders/received' , 'OrderController@receivedOrders')->name('orders.received');
            Route::get('orders/refunds' , 'OrderController@refundOrders')->name('orders.refunds');


            Route::resource('payment','PaymentController');




    });

