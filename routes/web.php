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
    Route::get('profile', 'ProfileController@show')->name('profile.show');
    Route::post('profile/isAjax', 'ProfileController@isAjax')->name('profile.is_ajax');


    Route::resources([
        'advisor' => 'AdvisorController',
        'student' => 'StudentController',
        'subject' => 'SubjectsController',
        'teacher' => 'TeacherController',
        'configure' => 'ConfigureController',
        'cabinet' => 'CabinetController',
    ]);

    Route::post('student/debt', 'StudentController@debt')->name('student.debt');

    Route::group([
        'prefix' => 'schedule',
    ], function () {
        Route::get('show', 'ScheduleController@show')->name('schedule.show');
        Route::post('ajax', 'ScheduleController@isAjax')->name('schedule.ajax');
        Route::post('add', 'ScheduleController@add_schedule')->name('schedule.add');
        Route::post('delete', 'ScheduleController@delete_schedule_lesson')->name('schedule.delete');
        Route::post('update', 'ScheduleController@update_schedule_lesson')->name('schedule.update');
    });


    Route::group([
        'prefix' => 'news',
    ], function () {
        Route::get('index', 'NewsController@index')->name('news.index');
        Route::get('create', 'NewsController@create')->name('news.create');
        Route::post('add', 'NewsController@add_news')->name('news.add');
    });
    Route::resource('news', 'NewsController')->only(['destroy', 'edit', 'update']);

    Route::resource('faq', 'FaqController');
    Route::resource('chat', 'ChatController')->only(['destroy', 'index']);

    Route::get('week_days/show', 'ConfigureController@show_week_days')->name('week_days.show');
});

Route::group([
    'middleware' => 'auth',
    'prefix' => 'file',
    'namespace' => 'Common',
], function () {
    Route::post('file/temp_save', 'FileController@tempFileUpload')->name('file.temp_save');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
