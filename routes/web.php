<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', function (){
    return redirect()->route('landing.index');
});
Route::resource('client', 'ClientController');
Route::resource('landing', 'LandingController');

Route::post('image', ['as' => 'image.store', 'uses' => 'ImageController@store']);
Route::post('image/{image_id}', ['as' => 'image.destroy', 'uses' => 'ImageController@destroy']);

Route::group(['prefix' => 'landingUrlField'], function () {
    Route::get('check', ['as' => 'landingUrlField.check', 'uses' => 'LandingUrlFieldController@check']);
    Route::get('{id}/hits', ['as' => 'landingUrlField.hits', 'uses' => 'LandingUrlFieldController@hits']);
    Route::post('', ['as' => 'landingUrlField.store', 'uses' => 'LandingUrlFieldController@store']);
    Route::get('{url_name}', ['as' => 'landingUrlField.view', 'uses' => 'LandingUrlFieldController@view']);
    Route::get('', ['as' => 'landingUrlField.index', 'uses' => 'LandingUrlFieldController@index']);
    Route::delete('{id}', ['as' => 'landingUrlField.destroy', 'uses' => 'LandingUrlFieldController@destroy']);
});

Route::group(['prefix' => 'landingDbField'], function () {
    Route::get('check', ['as' => 'landingDbField.check', 'uses' => 'LandingDbFieldController@check']);
    Route::post('', ['as' => 'landingDbField.store', 'uses' => 'LandingDbFieldController@store']);
    Route::get('', ['as' => 'landingDbField.index', 'uses' => 'LandingDbFieldController@index']);
    Route::delete('{id}', ['as' => 'landingDbField.destroy', 'uses' => 'LandingDbFieldController@destroy']);
});

Route::group(['prefix' => 'DbManageField'], function () {
    Route::post('', ['as' => 'DbManageField.store', 'uses' => 'DbManageFieldController@store']);
    Route::get('{id}', ['as' => 'DbManageField.show', 'uses' => 'DbManageFieldController@show']);
    Route::get('{id}/excel', ['as' => 'DbManageField.excelExport', 'uses' => 'DbManageFieldController@excelExport']);
});

/*Route::get('/client', ['as' => 'client.index', 'uses' => 'ClientController@index']);
Route::get('/client/list', ['as' => 'client.list', 'uses' => 'ClientController@getList']);
Route::get('/client/create', ['as' => 'client.create', 'uses' => 'ClientController@create']);
Route::post('/client/store', ['as' => 'client.store', 'uses' => 'ClientController@store']);*/


/*Route::group(['prefix' => 'client'], function () {
    Route::get('/', 'ClientController@index');
    Route::get('/{client_id}', 'ClientController@get');
    Route::post('/store', 'ClientController@store');
});*/
