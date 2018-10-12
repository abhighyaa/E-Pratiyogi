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

Route::get('/library','QuestionController@index');
// Route::get('/tags/{tag}','TagsController@show');
// Route::get('/createtag','TagsController@create');
// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/topics/{topic}','TagsController@show');
Route::get('/createtag','TagsController@create');


Route::prefix('subjects')->group(function () {
    Route::get('get/all', 'SubjectController@fetchSubjects');
    Route::get('{id}/get/instructions', 'SubjectController@fetchInstructions');
    Route::get('remove/{id}', 'SubjectController@remove');
    Route::get('add/{name}', 'SubjectController@CreateSubject');
    Route::get('update/{id}/{subject}','SubjectController@update');
    Route::get('get/default','SubjectController@getDefaultSubjects');
});
Route::prefix('courses')->group(function(){
    Route::get('get/all','Coursecontroller@index');
    Route::get('{id}/get/branches','Coursecontroller@Fetch_branches_by_Course');
    Route::get('branch/{id}/get/subjects','Coursecontroller@Fetch_subjects_by_Branch');
});
Route::prefix('admin')->group(function () {
    Route::get('/dashboard','AdminController@index');
    Route::get('get/all/users','AdminController@FetchUsers');
    Route::get('get/all/teachers','AdminController@Fetch_all_teachers');
    Route::get('get/all/students','AdminController@Fetch_all_students');
    Route::get('get/all/roles','AdminController@Fetch_all_roles');
    Route::get('update/role/{id}/user/{name}','AdminController@update_role_of_user');
    Route::get('remove/user/{id}','AdminController@Remove_user');
    Route::get('get/all/courses','AdminController@FetchCourses');
    Route::get('get/all/branches','AdminController@Fetch_branches_with_course');
});
Route::prefix('teacher')->group(function () {
    Route::get('/home','QuestionController@index');
});
Route::prefix('student')->group(function () {
    Route::get('/home', 'StudentController@index');
    Route::get('/home/{id}','StudentController@Taketest');
});
Route::get('/starttest/{id}','SubjectController@testQuestion');

