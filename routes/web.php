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

Route::get('/', 'FrontPage\PostsController@latest')->name('home');
Route::post('import', 'InstitutesController@import')->name('import');
Route::get('posts', 'FrontPage\PostsController@all')->name('posts');
Route::get('posts/{id}', 'FrontPage\PostsController@single')->name('singlePost');
Route::get('posts/{id}/comments', 'FrontPage\PostsController@getComments');
Route::get('posts/{id}/user', 'FrontPage\PostsController@getUser');
Route::post('posts/addcomment', 'FrontPage\PostsController@addComment');

Route::auth();

Route::get('admin', 'Admin\AdminController@index')->name('admin');
Route::get('{slug}', 'SubpagesController@index')->name('subpage');