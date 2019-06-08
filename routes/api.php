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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/login', 'Admin\\AuthController@login');

Route::group(['middleware' => 'jwt.auth'], function() {
    Route::get('auth/user', 'Admin\\AuthController@user');
    Route::post('auth/logout', 'Admin\\AuthController@logout');
    Route::apiResource('posts', 'Admin\\PostsController');
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

Route::group(['middleware' => 'jwt.refresh'], function(){
    Route::get('auth/refresh', 'Admin\\AuthController@refresh');
});
