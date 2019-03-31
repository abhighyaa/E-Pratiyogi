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
use App\Notifications\NewUserRegistration;
use Illuminate\Notifications\Notification;
use App\User;
Auth::routes();

Route::get('/', function () {
    // return view('welcome');
    return view('layouts.WebHomePage');
});
Route::get('/home', function () {
    // return view('welcome');
    return view('layouts.WebHomePage');
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
Route::get('user/{id}/profile','StudentController@manageProfile')->name('profile');
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
    Route::get('update/{id}/course/{name}','AdminController@update_course');
    Route::get('add/course/{name}','AdminController@add_course');
    Route::get('get/all/branches','AdminController@Fetch_branches_with_course');
    Route::get('get/all/subjects','AdminController@Fetch_subjects_with_course_branch');
    Route::get('update/{id}/branch/{name}','AdminController@update_branch');
    Route::get('add/branch/{branch}/to/{course}','AdminController@add_branch_to_course');
    Route::get('fetch/branches/for/course/{course}','AdminController@fetch_branches_for_this_course');
    Route::get('add/{subject}/{branch}/{course}','AdminController@add_subject');
    Route::get('remove/subject/{id}','AdminController@remove_subject');
    Route::get('notification/{id}/{NID}','AdminController@getNotification')->name('notification');
});
Route::prefix('teacher')->group(function () {
    Route::get('/home','TeacherController@index');
    Route::get('/subjects','SubjectController@getSubjectsTeacher');
    Route::get('/categories/{subject}','CategoryController@getcategories');
    Route::get('/questions/{cat}/{sub}','QuestionController@getquestions');
    Route::get('/editquestion/{q}','QuestionController@getequestion');
    Route::post('/saveedits','QuestionController@editquestion');
    Route::get('/delete/{q}','QuestionController@deletequestion');
    Route::get('/testdelete/{test}','TestController@deletetest');
    Route::get('/testdistribute/{test}','TestController@distributetest');
    Route::get('/getsubcat/{sid}/{cid}','HomeController@getdetails');
    Route::post('/savequestion','QuestionController@savequestion');
    Route::post('/createtest','TestController@createtest');
    Route::get('/gettests','TestController@gettests');
    Route::get('/gettestdetails/{t}','TestController@gettestdetails');
    Route::post('/savequestiontotest','TestController@savequetotest');
    // Route::get('/test/{test}',function()
    // {
    //    return view('teacher.userTestRegister');
    // });
    Route::post('/test/{test}','TestController@registerusers');
    Route::get('/coding',function(){
        return view('teacher.coding');
    });
    Route::get('/getoutput','TestController@getoutput');
});
Route::prefix('student')->group(function () {   
    Route::get('/home', 'StudentController@index');
    Route::get('/get/myteachers','StudentController@getTeachers');
    Route::post('/changerole','StudentController@RequestToChangeRole');
});
Route::get('/starttest/{id}','SubjectController@testQuestion');

Route::get('open/ChangePassword/form','ChangePasswordController@open_change_password_form');
Route::post('change/my/password','ChangePasswordController@change_password');

Route::get('markasread',function(){
    \Auth::user()->notifications->markAsRead();
    return redirect()->back();
})->name('markAsRead');

Route::get('open/request/form','ChangeRoleController@open_request_form');
