<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [
    'as' => 'index',
    'uses' => 'StoreController@index',
]);

Route::post('/postLogin', [
    'as' => 'postLogin',
    'uses' => 'LoginUserController@postLogin',
]);

Route::post('/postRegister', [
    'as' => 'postRegister',
    'uses' => 'RegisterUserController@postRegister',
]);

Route::get('/redirect/{social}', [
    'as' => 'redirect.social',
    'uses' => 'SocialAuthController@redirect',
]);

Route::get('/callback/{social}', [
    'as' => 'callback.social',
    'uses' => 'SocialAuthController@callback',
]);

Route::get('/product/{slug}', [
    'as' => 'product.single',
    'uses' => 'StoreController@singleProduct',
]);

Route::get('/category/{slug}', [
    'as' => 'category.single',
    'uses' => 'StoreController@singleCategory',
]);

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function (){
    Route::get('home', 'HomeController@index')->name('home');

    Route::get('/order/index',[
        'as' => 'admin.order.index',
        'uses' => 'AdminOrderController@index',
    ]);

    Route::post('/order/change-status/{id}/{status}',[
        'as' => 'admin.order.changeStatus',
        'uses' => 'AdminOrderController@changeStatus',
    ]);

    Route::get('/suggest',[
        'as' => 'admin.suggest',
        'uses' => 'SuggestController@index',
    ]);

    Route::get('/suggest/{id}/{status}',[
        'as' => 'admin.changeStatus',
        'uses' => 'SuggestController@changeStatus',
    ]);

    Route::get('product/trashed', [
        'as' => 'product.trashed',
        'uses' => 'ProductController@trashed',
    ]);

    Route::delete('product/kill/{id}', [
        'as' => 'product.kill',
        'uses' => 'ProductController@kill'
    ]);

    Route::get('product/restore/{id}', [
        'as' => 'product.restore',
        'uses' => 'ProductController@restore',
    ]);

    Route::resource('user', 'UsersController', ['as' => 'admin']);

    Route::resource('category', 'CategoriesController', ['as' => 'admin']);

    Route::resource('product', 'ProductController', ['as' => 'admin']);
});
