<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cms', 'middleware' => 'api', 'namespace' => 'Moonshiner\Cms\Http\Controllers'], function () {
    Route::get('config', 'BackendController@config');
    Route::resource('posts', 'BackendController');
    Route::post('file', 'BackendController@saveFile');

    Route::get('tags', [
        'uses' => 'TagController@index'
    ]);

    // Create Tag
    Route::post('tags/create', [
        'uses' => 'TagController@store',
    ]);

    // Update Tag
    Route::put('tags/{tag_id}', [
        'uses' => 'TagController@update',
    ]);

    // Delete Tag
    Route::delete('tags/{tag_id}', [
        'uses' => 'TagController@destroy',
    ]);

  
});





