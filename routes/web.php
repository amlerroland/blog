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

Route::get('/', 'PostController@index')->name('home');

Auth::routes();

Route::resource('posts', 'PostController');

Route::get('/tags', 'TagController@index')->name('tags.index');
Route::get('/tags/{tag}', 'TagController@show')->name('tags.show');

Route::get('/users/{user}', 'UserController@show')->name('users.show');