<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('welcome');
});

Route::get('/loggedin','HomeController@index');

Route::get('/createtest','TestController@createtest');

// Route::get('/library','QuestionController@index');
// Route::get('/tags/{tag}','TagsController@show');
// Route::get('/createtag','TagsController@create');
// Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('subjects')->group(function () {
    Route::get('get/all', 'SubjectController@fetchSubjects');
    Route::get('{id}/get/instructions', 'SubjectController@fetchInstructions');
});
Route::prefix('admin')->group(function () {
    Route::get('/dashboard','AdminController@index');
});
Route::prefix('teacher')->group(function () {
    Route::get('/home','TeacherController@index');
});
Route::prefix('student')->group(function () {
    Route::get('/home', 'StudentController@index');
});


