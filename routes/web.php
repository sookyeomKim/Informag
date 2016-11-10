<?php
Auth::routes();

Route::get('/', function () {
    return redirect()->route('landing.index');
});

Route::get('landingUrlField/{url_name}', ['as' => 'landingUrlField.view', 'uses' => 'LandingUrlFieldController@view']);

Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['administrator']], function () {
    /*Route::get('register');*/

    Route::post('image', ['as' => 'image.store', 'uses' => 'ImageController@store']);
    Route::post('image/{image_id}', ['as' => 'image.destroy', 'uses' => 'ImageController@destroy']);

    Route::group(['prefix' => 'landing'], function () {
        Route::get('', ['as' => 'landing.index', 'uses' => 'LandingController@index', 'roles' => ['User']]);
        Route::post('', ['as' => 'landing.store', 'uses' => 'LandingController@store']);
        Route::get('create', ['as' => 'landing.create', 'uses' => 'LandingController@create']);
        Route::put('{id}', ['as' => 'landing.update', 'uses' => 'LandingController@update']);
        Route::get('{id}/edit', ['as' => 'landing.edit', 'uses' => 'LandingController@edit']);
    });

    Route::group(['prefix' => 'client'], function () {
        Route::post('register', ['as' => 'client.register', 'uses' => 'ClientController@register']);
        Route::get('', ['as' => 'client.index', 'uses' => 'ClientController@index']);
    });

    Route::group(['prefix' => 'landingUrlField'], function () {
        Route::get('check', ['as' => 'landingUrlField.check', 'uses' => 'LandingUrlFieldController@check']);
        Route::get('{id}/hits', ['as' => 'landingUrlField.hits', 'uses' => 'LandingUrlFieldController@hits']);
        Route::post('', ['as' => 'landingUrlField.store', 'uses' => 'LandingUrlFieldController@store']);
        Route::get('', ['as' => 'landingUrlField.index', 'uses' => 'LandingUrlFieldController@index']);
        Route::delete('{id}', ['as' => 'landingUrlField.destroy', 'uses' => 'LandingUrlFieldController@destroy']);
    });

    Route::group(['prefix' => 'landingDbField'], function () {
        Route::get('check', ['as' => 'landingDbField.check', 'uses' => 'LandingDbFieldController@check']);
        Route::post('', ['as' => 'landingDbField.store', 'uses' => 'LandingDbFieldController@store']);
        Route::get('', ['as' => 'landingDbField.index', 'uses' => 'LandingDbFieldController@index']);
        Route::delete('', ['as' => 'landingDbField.destroy', 'uses' => 'LandingDbFieldController@destroy']);
    });

    Route::group(['prefix' => 'DbManageField'], function () {
        Route::post('', ['as' => 'DbManageField.store', 'uses' => 'DbManageFieldController@store']);
        Route::get('{id}', ['as' => 'DbManageField.show', 'uses' => 'DbManageFieldController@show', 'roles' => ['User']]);
        Route::get('{id}/excel', ['as' => 'DbManageField.excelExport', 'uses' => 'DbManageFieldController@excelExport', 'roles' => ['User']]);
    });

    Route::group(['prefix' => 'landingClauseField'], function () {
        Route::post('', ['as' => 'landingClauseField.store', 'uses' => 'LandingClauseFieldController@store']);
        Route::get('{lan_id}', ['as' => 'landingClauseField.index', 'uses' => 'LandingClauseFieldController@index']);
        Route::delete('', ['as' => 'landingClauseField.destroy', 'uses' => 'LandingClauseFieldController@destroy']);
    });
});


