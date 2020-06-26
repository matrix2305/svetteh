<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PortalController@index')->name('index');

Auth::routes(['register' => false]);

Route::middleware('auth')->prefix('dashboard')->group(function (){
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::prefix('/category')->group(function (){
        Route::get('/create', 'CategoryController@create')->name('addcategory');
        Route::put('/add', 'CategoryController@store')->name('storecategory');
    });
    Route::prefix('/user')->group(function (){
        Route::get('/add', 'UsersController@index')->name('createuser');
        Route::put('/store', 'UsersController@store')->name('storeuser');
    });
});


