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
        Route::get('/{id}/edit', 'PostsController@edit')->name('editposts');
        Route::patch('/update', 'PostsController@update')->name('updateposts');
        Route::delete('/delete', 'PostsController@destroy')->name('destroyposts');
    });
    Route::prefix('/categories')->group(function (){
        Route::get('/', 'CategoryController@index')->name('categories');
        Route::put('/store', 'CategoryController@store')->name('storecategory');
        Route::get('/{id}/edit', 'CategoryController@edit')->name('editcategory');
        Route::patch('/update', 'CategoryController@update')->name('updatecategory');
        Route::delete('/delete', 'CategoryController@destroy')->name('destroycategory');
    });
    Route::prefix('/users')->group(function (){
        // Users
        Route::get('/', 'UsersController@index')->name('users');
        Route::put('/store', 'UsersController@store')->name('storeuser');
        Route::get('/{id}/edit', 'UsersController@edit')->name('editusers');
        Route::patch('/update', 'UsersController@update')->name('updateusers');
        Route::delete('/delete', 'UsersController@destroy')->name('destroyuser');
    });

    Route::prefix('/roles')->group(function (){
        // Roles
        Route::get('/', 'RolesController@index')->name('roles');
        Route::put('/store', 'RolesController@store')->name('storeroles');
        Route::get('/{id}/edit/', 'RolesController@edit')->name('editroles');
        Route::patch('/update', 'RolesController@update')->name('updateroles');
        Route::delete('/delete', 'RolesController@destroy')->name('destroyroles');
    });

    Route::prefix('/comments')->group(function (){
        //R
        Route::get('/', "CommentsController@index")->name('comments');
        Route::post('/', "CommentsController@allow")->name('allowcomment');
        Route::delete('/', "CommentsController@destroy")->name('deletecomment');
    });

    Route::prefix('/content')->group(function (){
        Route::get('/', "ContentController@index")->name('content');
        Route::patch('/', "ContentController@store")->name('updatecontent');
    });

    Route::post('/sendmail', 'PortalController@guestsMail')->name('email');
});


