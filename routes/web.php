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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::post('/login/custom',[
    'uses' => 'LoginController@login',
    'as' => 'login.custom'
]);
Route::group(['middleware' => 'auth'],function(){
    Route::get('/', function () {
    return view('welcome')->name('home');
});
});

Route::get('/library','SubjectController@index');

Route::get('/getsubjects','SubjectController@getsubjects');
Route::get('/addsubject','SubjectController@addsubject');
Route::get('/subjects/{subject}','SubjectController@subj');
Route::get('/subjects/delete/+{subject}','SubjectController@delsubject');
Route::post('/addquestions','QuestionController@addquestions');
// Route::get('/gettopics','TopicsController@gettopics');
Route::get('/addtopic','TopicsController@addtopic');
Route::get('/activatetopic','TopicsController@activatetopic');
Route::get('/editques','QuestionController@editques');
Route::post('/savequestion','QuestionController@savequestions');


Route::get('/loggedin','HomeController@index');

Route::get('/createtest','TestController@createtest');


Route::get('/topics/{topic}','TagsController@show');
Route::get('/createtag','TagsController@create');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/subjects/get/all', 'SubjectController@fetchSubjects');
Route::get('/subjects/{id}/get/instructions', 'SubjectController@fetchInstructions');

