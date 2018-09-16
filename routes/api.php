<?php
use \Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => 'forums/api',
    'namespace'  => 'Cybersquid\Forum\Controllers\Api',
    'middleware' => 'auth:api',
    'as'         => 'forums.api.',
], function () {

});