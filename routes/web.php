<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------

| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::redirect('/', '/login');
Route::redirect('/admin', '/admin/info');

Route::group([
//    'middleware' => 'role:admin',
    'prefix' => 'user',
//    'namespace' => '',
], function () {
    Route::get('create', 'UserController@create')->name('user.create');
});

Route::group([
    'middleware' => 'auth',
    'prefix' => 'admin',
    'namespace' => 'Admin'
], function () {
    Route::get('info', 'InfoController@index');

    Route::resources([
        'advisor' => 'AdvisorController',
        'student' => 'StudentController',
        'subject' => 'SubjectsController',
    ]);

});
