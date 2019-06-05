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

Route::get('/', 'FrontPage\PostsController@latest');
Route::get('posts', 'FrontPage\PostsController@all');
Route::get('posts/{id}', 'FrontPage\PostsController@single')->name('singlePost');
Route::get('posts/{id}/comments', 'FrontPage\PostsController@getComments');
Route::get('posts/{id}/user', 'FrontPage\PostsController@getUser');
Route::post('posts/addcomment', 'FrontPage\PostsController@addComment');

Route::get('institutes', 'FrontPage\InstitutesController@index');
Route::get('companies', 'FrontPage\CompaniesController@index');
Route::get('companies/{id}', 'FrontPage\CompaniesController@show')->name('singleCompany');
Route::get('institutes/{id}', 'FrontPage\InstitutesController@show')->name('singleInstitute');
Route::get('srip3/{slug}', 'FrontPage\SripController@index');
Route::get('srip4/{slug}', 'FrontPage\SripController@index');

Route::auth();

Route::get('admin', 'Admin\AdminController@index')->name('admin');
Route::get('{slug}', 'SubpagesController@index')->name('subpage');