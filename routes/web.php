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


Route::get('/', 'FrontPage\PostsController@latest')->middleware('basicAuth');
Route::get('posts', 'FrontPage\PostsController@all');
Route::get('posts/{id}', 'FrontPage\PostsController@single')->name('singlePost');
Route::get('posts/{id}/comments', 'FrontPage\PostsController@getComments');
Route::get('fields', 'FrontPage\SripController@getSrips');
Route::get('fields/{id}', 'FrontPage\SripController@getFieldsAndGoals')->name('fields');
Route::get('links', 'FrontPage\CategoriesController@index');
Route::get('contacts', 'FrontPage\ContactsController@index');

Route::group(['middleware' => 'auth'], function() {
    Route::get('institutes', 'FrontPage\InstitutesController@index');
    Route::get('companies', 'FrontPage\CompaniesController@index');
    Route::get('srip{number}/{slug}/{id}', 'FrontPage\SripController@show')->name("showSripItem");
    Route::get('srip{number}/{slug}/{itemId}/{goalId}', 'FrontPage\SripController@getResults')->name("getResults");
    Route::get('srip{number}/{slug}', 'FrontPage\SripController@index')->name("sripItems");
    Route::get('export_all/{slug}', 'FrontPage\ExportController@exportAll')->name('exportAll');
    Route::get('export_results/{slug}/{itemId}/{goalId}', 'FrontPage\ExportController@exportResults')->name('exportResults');
    Route::get('companies/{id}', 'FrontPage\CompaniesController@show')->name('singleCompany');
    Route::get('institutes/{id}', 'FrontPage\InstitutesController@show')->name('singleInstitute');
    Route::post('posts/addcomment', 'FrontPage\PostsController@addComment');
});

Route::auth();

Route::get('admin', 'Admin\AdminController@index')->name('admin');
Route::get('{slug}', 'SubpagesController@index')->name('subpage');
