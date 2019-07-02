<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

// Admin Page Login
Route::post('auth/login', 'Admin\\AuthController@login');

// Only for SuperAdmin and Editor
Route::group(['middleware' => ['jwt.auth', 'role:super_admin,editor']], function() {
    Route::apiResource('posts', 'Admin\\PostsController');
    Route::apiResource('categories', 'Admin\\CategoriesController');
    Route::apiResource('links', 'Admin\\LinksController');
});

// Details and logout for all roles
Route::group(['middleware' => 'jwt.auth'], function() {
    Route::get('auth/user', 'Admin\\AuthController@user');
    Route::post('auth/logout', 'Admin\\AuthController@logout');
});

// Only for SuperAdmin and Admin
Route::group(['middleware' => ['jwt.auth', 'role:super_admin,admin']], function() {
    Route::get('fields', 'Admin\\FieldsController@index');
    Route::get('goals', 'Admin\\GoalsController@index');
    Route::apiResource('institutes', 'Admin\\InstitutesController');
    Route::post('institutes/import', 'Admin\\InstitutesController@import');
    Route::post('institute_goal', 'Admin\\WizardController@storeIG');
    Route::apiResource('companies', 'Admin\\CompaniesController');
    Route::post('companies/import', 'Admin\\CompaniesController@import');
    Route::post('company_goal', 'Admin\\WizardController@storeCG');
    Route::delete('company_goal', 'Admin\\CompaniesController@deleteConnection');
    Route::delete('institute_goal', 'Admin\\InstitutesController@deleteConnection');
});


// Only for SuperAdmin
Route::group(['middleware' => [ 'jwt.auth', 'role:super_admin' ]], function() {
    Route::get('users', 'Admin\\UsersController@index');
    Route::get('users/admin', 'Admin\\UsersController@admins');
    Route::put('users/admin/{id}/{role}', 'Admin\\UsersController@grantRights');
    Route::delete('users/admin/{id}/{role}', 'Admin\\UsersController@removeRights');
});

Route::group(['middleware' => 'jwt.refresh'], function(){
    Route::get('auth/refresh', 'Admin\\AuthController@refresh');
});
