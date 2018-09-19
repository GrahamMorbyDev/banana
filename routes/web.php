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



/*
|--------------------------------------------------------------------------
| Home Routes
|--------------------------------------------------------------------------
*/
    Route::get('/', 'PagesController@home')->name('welcome');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/docs', 'PagesController@docs')->name('docs');

/*
|--------------------------------------------------------------------------
| Video Routes
|--------------------------------------------------------------------------
*/
    //Route::get('/get/video', 'VideoController@get')->middleware('auth:api');
    Route::get('/get/video/single', 'VideoController@single')->middleware('auth:api');
    Route::post('/post/video/single', 'VideoController@postVideo');
    Route::post('/delete/video/single', 'VideoController@delete')->middleware('auth:api');

/*
|--------------------------------------------------------------------------
| Transaction Routes
|--------------------------------------------------------------------------
*/
    Route::post('add/transaction', 'TransactionContoller@Store');
    Route::post('get/video', 'TransactionContoller@Download');


    Auth::routes();


