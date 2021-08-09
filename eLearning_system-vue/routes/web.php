<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Auth::routes();

// -------------------------------  CONTENT BUILDER SYSTEM -------------------------------

// Admin - Dashboard
Route::get('/home', [App\Http\Controllers\HomeController::class, 'dashboardView'])->name('dahsboard');
Route::get('/dashboard/stats', [App\Http\Controllers\HomeController::class, 'dashboardStats']);
// Admin - Dashboard --> users tables
Route::get('/dashboard/getUsers', [App\Http\Controllers\UserController::class, 'getAllUsers']);
Route::post('/dashboard/addNewUser', [App\Http\Controllers\UserController::class, 'addNewUser']);
Route::post('/dashboard/updateUser/{id}', [App\Http\Controllers\UserController::class, 'updateUser']);
Route::delete('/dashboard/deleteUsere/{id}', [App\Http\Controllers\UserController::class, 'deleteUser']);

// Admin - Program Specification
Route::get('/program-spec', [App\Http\Controllers\HomeController::class, 'displayUserData'])->name('program_specification');
// Admin - Program Specification validated programs
Route::get('/program-spec/validation', [App\Http\Controllers\HomeController::class, 'validatedPrograms']);
// Admin - Program Specification data
Route::get('/program-spec/programData/{id}', [App\Http\Controllers\HomeController::class, 'getProgramData']);
// Admin - delete program
Route::delete('/home/{id}', [App\Http\Controllers\ProgramController::class, 'deleteProgram']);

// Admin - creating new program
Route::get('/home/newProgram', [App\Http\Controllers\ProgramController::class, 'index'])->name('display_program_data');
Route::post('/home/newProgram', [App\Http\Controllers\ProgramController::class, 'createProgram'])->name('createProgram');

// Admin - View/edit program and table of modules + adding new module
Route::get('/home/program/{id}', [App\Http\Controllers\ProgramController::class, 'viewProgram']);
Route::post('/home/program/{id}', [App\Http\Controllers\ProgramController::class, 'updateProgram']);
Route::post('/home/program/newModule/{id}', [App\Http\Controllers\ModuleController::class, 'createModule']);

// Admin - View/edit Module and table of units + adding new unit
Route::get('/home/module/{id}', [App\Http\Controllers\ModuleController::class, 'viewModule']);
Route::post('/home/module/{id}', [App\Http\Controllers\ModuleController::class, 'updateModule']);
Route::post('/home/module/newUnit/{id}', [App\Http\Controllers\UnitController::class, 'createUnit']);
Route::delete('/home/module/{id}', [App\Http\Controllers\ModuleController::class, 'deleteModule']);

// Admin - View/edit Unit and table of Lessons + adding new lesson
Route::get('/home/unit/{id}', [App\Http\Controllers\UnitController::class, 'viewUnit']);
Route::post('/home/unit/{id}', [App\Http\Controllers\UnitController::class, 'updateUnit']);
Route::post('/home/unit/newLesson/{id}', [App\Http\Controllers\LessonController::class, 'createLesson']);
Route::delete('/home/unit/{id}', [App\Http\Controllers\UnitController::class, 'deleteUnit']);

// Admin - View/edit Lesson and table of activities + adding new activity
Route::get('/home/lesson/{id}', [App\Http\Controllers\LessonController::class, 'viewLesson']);
Route::post('/home/lesson/{id}', [App\Http\Controllers\LessonController::class, 'updateLesson']);
Route::post('/home/lesson/newActivity/{id}', [App\Http\Controllers\ActivityController::class, 'createActivity']);
Route::delete('/home/lesson/{id}', [App\Http\Controllers\LessonController::class, 'deleteLesson']);

// Admin - View/edit Activity 
Route::get('/home/activity/{id}', [App\Http\Controllers\ActivityController::class, 'viewActivity']);
Route::post('/home/activity/{id}', [App\Http\Controllers\ActivityController::class, 'updateActivity']);
Route::delete('/home/activity/{id}', [App\Http\Controllers\ActivityController::class, 'deleteActivity']);

// Validator - validate a program/module/unit/lesson/activity
Route::post('/home/program/validate/{id}', [App\Http\Controllers\UserController::class, 'validation']);



// -------------------------------  E-LEARNING SYSTEM -------------------------------
// Homepage of the elearning system
Route::get('/eLearning/home', [App\Http\Controllers\HomeController::class, 'index'])->name('eLearning_home');
// Homepage of the elearning system
Route::get('/eLearning/membership', [App\Http\Controllers\HomeController::class, 'membershipView'])->name('membershipView');
// Page that shows the structure of the programs
Route::get('/eLearning/program/{id}', [App\Http\Controllers\ProgramController::class, 'getProgramById']);
// update activity details status e.g. score, tries and time
Route::post('/eLearning/activityDetails/{id}', [App\Http\Controllers\ActivityController::class, 'updatingActivityScore']);
// Student dashboard
Route::get('/eLearning/dashboard/{id}', [App\Http\Controllers\StudentUserController::class, 'getStudentDashboardById']);
// Student Statistics
Route::get('/eLearning/dashboard/stats/{id}', [App\Http\Controllers\StudentUserController::class, 'getStats']);

