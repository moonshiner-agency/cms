<?php

use Illuminate\Support\Facades\Route;

Route::prefix('cms')
    ->middleware('api')
    ->namespace('Moonshiner\Cms\Http\Controllers')
    ->group(function () {
        Route::get('config', 'BackendController@config');
        Route::resource('posts', 'BackendController');
        Route::post('file', 'BackendController@saveFile'); 
    });
Route::namespace('Moonshiner\Cms\Http\Controllers')->group(function(){
    Route::get('/{slug?}', 'FrontendController@index')->where('slug', '(.*)');
}); 
