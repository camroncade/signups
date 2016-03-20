<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/{slug}', 'SignupsController@show');
    Route::get('/{slug}/edit', 'SignupsController@edit');
    Route::post('/{slug}/edit', 'SignupsController@update');

    Route::post('/fields/sort', 'FieldsController@updateSort');
    Route::post('/fields/{id}', 'FieldsController@update');
    Route::post('/fields', 'FieldsController@store');
    Route::delete('/fields/{id}', 'FieldsController@destroy');

    Route::post('/groups/sort', 'GroupsController@updateSort');
    Route::post('/groups/{id}', 'GroupsController@update');
    Route::post('/groups', 'GroupsController@store');
});
