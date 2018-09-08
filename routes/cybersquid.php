<?php


Route::namespace('Cybersquid\Forum\Http\Controllers\Forum')->group(function () {
    Route::get('forum', '\Web\CategoryController@index');
});
