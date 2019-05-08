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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function (){
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
