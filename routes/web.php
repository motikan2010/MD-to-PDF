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
    return view('index');
})->name('index');

Route::get('login', 'Auth\LoginController@redirectToProvider')->name('login');
Route::get('auth/callback', 'Auth\LoginController@handleProviderCallback');


Route::group(['prefix' => 'repository'], function () {
    Route::get('', 'RepositoryController@index')->name('repository.index');
    Route::get('detail', 'RepositoryController@detail')->name('repository.detail');
    Route::get('convert', 'RepositoryController@convert')->name('repository.convert');
});

/**
 * API
 */
Route::group(['prefix' => 'api', 'namespace' => 'Api'], function (){
    Route::get('repository/detail', 'RepositoryController@detail');
    Route::post('repository/convert', 'RepositoryController@convert');
});
