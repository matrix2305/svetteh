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
    Route::prefix('/posts')->group(function (){
        Route::get('/', 'PostsController@index')->name('posts');
        Route::get('/create', 'PostsController@create')->name('createposts');
        Route::put('/store', 'PostsController@store')->name('storeposts');
        Route::get('/{$id}/edit', 'PostsController@edit')->name('editposts');
        Route::put('/update', 'PostsController@update')->name('updateposts');
        Route::delete('/delete', 'PostsController@destroy')->name('destroyposts');
    });
    Route::prefix('/categories')->group(function (){
        Route::get('/', 'CategoryController@index')->name('categories');
        Route::put('/store', 'CategoryController@store')->name('storecategory');
        Route::get('/{$id}/edit', 'CategoryController@edit')->name('editcategory');
        Route::put('/update', 'CategoryController@update')->name('updatecategory');
        Route::delete('/delete', 'CategoryController@destroy')->name('destroycategory');
    });
    Route::prefix('/users')->group(function (){
        // Users
        Route::get('/', 'UsersController@index')->name('users');
        Route::put('/store', 'UsersController@store')->name('storeuser');
        Route::get('/{$id}/edit', 'UsersController@edit')->name('editusers');
        Route::put('/update', 'UsersController@update')->name('updateusers');
        Route::delete('/delete', 'UsersController@destroy')->name('destroyuser');
    });

    Route::prefix('/roles')->group(function (){
        // Route
        Route::get('/', 'RolesController@index')->name('roles');
        Route::put('/store', 'RolesController@store')->name('storeroles');
        Route::get('/{$id}/edit', 'RolesController@edit')->name('editroles');
        Route::put('/update', 'RolesController@update')->name('updateroles');
        Route::delete('/delete', 'RolesController@destroy')->name('destroyroles');
    });
});


