<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;



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


//Dashboards
Route::get('/personnel', [PersonnelController::class, 'index'])->name('personnel.index');
Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');
Route::get('/student', [StudentController::class, 'index'])->name('student.index');


