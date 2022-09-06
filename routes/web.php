<?php

use App\Http\Livewire\SearchList;
use App\Models\Complaint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear-cache', function () {
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return 'done';
});
 Route::get('test',function(){
     return view('website.profile');

 });

//auth routes
Route::group(['middleware' => ['guest:web']], function () {
    Route::get('login',"AuthController@viewLogin")->name('viewLogin');
    Route::post('login',"AuthController@login")->name('customer.login');
    Route::get('signup',"AuthController@viewSignup")->name('viewSignup');
    Route::post('signup',"AuthController@signup")->name('signup');
      // Social login providers...
    Route::get('login/{provider}/', 'SocialLoginController@redirectToProvider')->name('google.login');
    Route::get('login/{provider}/callback', 'SocialLoginController@handleProviderCallback')->name('facebook.login');
    //reset password
    Route::get('view-reset-password','AuthController@resetPassword')->name('reset-password');
    Route::post('check-email','AuthController@checkEmail')->name('checkEmail');
    Route::get('pin-code-check','AuthController@pinCheck')->name('pin-code-check');
    Route::post('check-code','AuthController@checkCode')->name('checkCode');
    Route::get('change-pass','AuthController@changePass')->name('change-pass');
    Route::put('change-pass-mark','AuthController@changPassMark')->name('MarkPass');
});
    Route::group(['middleware' => ['auth:web']], function () {
    Route::get('logout', 'AuthController@customerLogout')->name('logout');
    Route::get('contact-us', 'ComplaintController@contactUs')->name('contact-us');
    Route::post('contact-us/store','ComplaintController@storeData')->name('contact-us.store');
    //profile
    Route::get('profile',"ProfileController@index")->name('profile');
    Route::put('profile/address',"ProfileController@addressUpdate")->name('address.update');
    Route::put('profile/edit',"ProfileController@profileUpdate")->name('profile.update');
    //order details
    Route::get('order/{id}/details',"OrderController@orderDetails")->name('order.details');
    });

//home
    Route::get('/',"HomeController@index")->name('home');
    Route::get('/return-policy',"HomeController@policy")->name('policy');
    Route::get('/privacy',"HomeController@privacy")->name('privacy');
    Route::get('/terms-conditions',"HomeController@terms")->name('terms');
    Route::get('/about-us',"HomeController@aboutUs")->name('about-us');




//products
    Route::get('all-products','ProductController@allProducts')->name('all-products');
    Route::get('product-detail/{id}','ProductController@productDetail')->name('product-detail');
    Route::get('/sub-category/products','ProductController@subCategoryProducts')->name('subCategory,products');
    Route::get('/supplier/{id}/products','ProductController@supplierProducts')->name('supplier.products');

 //searchhh products
    Route::get('/search','ProductController@search')->name('search');




// cart
Route::group(['prefix' => 'cart'], function () {

    Route::get('/',"CartController@index")->name('cart');
    Route::get('add/{id}',"CartController@add")->name('cart.add');
    Route::get('/destroy/{id}', 'CartController@deleteRow')->name('cart.deleteRow');
    Route::post('checkout',"CartController@checkout")->name('cart.checkout');
    Route::get('credit',"PaymentController@credit")->name('cart.credit');
    Route::get('callback',"PaymentController@callback")->name('cart.callback');
    


});

//oreder canceled from customer
Route::Post('order/{id}/cancel','OrderController@cancelOrder')->name('order.cancel');









