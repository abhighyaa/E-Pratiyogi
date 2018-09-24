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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/loggedin','HomeController@index');

Route::get('/createtest','TestController@createtest');

Route::get('/library','QuestionController@index');

Route::get('/tags/{tag}','TagsController@show');
Route::get('/createtag','TagsController@create');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/subjects/get/all', 'SubjectController@fetchSubjects');
Route::get('/subjects/{id}/get/instructions', 'SubjectController@fetchInstructions');
