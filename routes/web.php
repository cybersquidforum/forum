<?php
use \Illuminate\Support\Facades\Route;

Route::group([
    'prefix'    => 'forums',
    'namespace' => 'Cybersquid\Forum\Controllers\Web',
    'as'        => 'forums.',
], function () {

    Route::group([
        'prefix' => 'categories',
        'as'     => 'categories.',
    ], function () {
        Route::get('/', 'CategoriesController@list')->name('list');
        Route::get('/{item}', 'CategoriesController@get')->name('item');
        Route::post('/{item}', 'CategoriesController@post');
        Route::delete('/{item}', 'CategoriesController@delete');
    });

    Route::group([
        'prefix' => 'forums',
        'as'     => 'forums.',
    ], function () {
        Route::get('/', 'ForumsController@list')->name('list');
        Route::get('/{item}', 'ForumsController@get')->name('item');
        Route::post('/{item}', 'ForumsController@post');
        Route::delete('/{item}', 'ForumsController@delete');
    });

    Route::group([
        'prefix' => 'posts',
        'as'     => 'posts.',
    ], function () {
        Route::get('/', 'PostsController@list')->name('list');
        Route::get('/{item}', 'PostsController@get')->name('item');
        Route::post('/{item}', 'PostsController@post');
        Route::delete('/{item}', 'PostsController@delete');
    });

    Route::group([
        'prefix' => 'users',
        'as'     => 'users.',
    ], function () {
        Route::get('/', 'UsersController@list')->name('list');
        Route::get('/{item}', 'UsersController@get')->name('item');
        Route::post('/{item}', 'UsersController@post');
        Route::delete('/{item}', 'UsersController@delete');
    });
});