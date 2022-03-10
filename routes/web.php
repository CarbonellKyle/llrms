<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LearningResourceController;
use App\Http\Controllers\DownloadController;




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

//Final registration route
Route::get('/continueRegistration', [App\Http\Controllers\Auth\RegisterController::class, 'continueRegister'])->name('continueRegister');

Auth::routes();

//Home Page
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Socialite sign in with google routes
Route::get('/redirect', 'App\Http\Controllers\SocialController@redirect');
Route::get('/callback/google', 'App\Http\Controllers\SocialController@callback');

//Routes for Profile
Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

//Dashboards
Route::get('/personnel', [PersonnelController::class, 'index'])->name('personnel.index');
Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');
Route::get('/student', [StudentController::class, 'index'])->name('student.index');

//LearningResourceController Routes
Route::get('/learningresource/index', [LearningResourceController::class, 'index'])->name('learningresource.index');
Route::get('/learningresource/upload', [LearningResourceController::class, 'upload'])->name('learningresource.upload');
Route::post('/learningresource/upload', [LearningResourceController::class, 'uploadSubmit'])->name('learningresource.uploadSubmit');


// StudentController Routes
Route::get('/student/resources', [LearningResourceController::class, 'studentDashboard'])->name('studentDashboard');

//Download Routes
Route::get('/download', [DownloadController::class, 'download'])->name('download');

