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

Route::get('/', 'GachaController@start');

Route::get('/gachaSingle', 'GachaController@gachaSingle');
Route::get('/gachaMultiple', 'GachaController@gachaMultiple');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::get('prize/create', 'Admin\PrizeController@add');
    Route::post('prize/create', 'Admin\PrizeController@create');
    
    Route::get('prize/edit', 'Admin\PrizeController@edit');
    Route::post('prize/edit', 'Admin\PrizeController@update');
    
    Route::get('prize/index', 'Admin\PrizeController@index');
    
    Route::get('rarity/create', 'Admin\PrizeController@addRarity');
    Route::post('rarity/create', 'Admin\PrizeController@createRarity');
    
});
    
