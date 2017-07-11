<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cms', 'middleware' => 'api', 'namespace' => 'Moonshiner\Cms\Http\Controllers'], function () {
    Route::get('config', 'BackendController@config');
    Route::resource('posts', 'BackendController');
    Route::post('file', 'BackendController@saveFile');
});





