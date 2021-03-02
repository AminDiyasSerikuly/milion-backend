<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', 'Api\AuthController@login');

Route::group([
    'namespace' => 'Api',
    'middleware' => 'auth:api',
], function () {
    Route::get('/user', 'UserController@info');
    Route::get('schedule', 'ScheduleController@schedule');
    Route::get('news', 'NewsController@news');
    Route::get('news/{id}', 'NewsController@newsById');
});
