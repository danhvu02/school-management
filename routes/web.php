<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'AuthLogin'])->name('login.store');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('forgot-password', [AuthController::class, 'forgotpassword'])->name('forgot-password');
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword'])->name('forgot-password.store');
Route::get('reset/{token}', [AuthController::class, 'reset'])->name('reset');
Route::post('reset/{token}', [AuthController::class, 'PostReset'])->name('reset.store');

Route::group(['middleware' => 'admin'], function (){
    //dashboard
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    //admin
    Route::get('admin/admin/list', [AdminController::class, 'list'])->name('admin.list');
    Route::get('admin/admin/add', [AdminController::class, 'add'])->name('admin.add');
    Route::post('admin/admin/add', [AdminController::class, 'insert'])->name('admin.store');
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');

    //class
    Route::resource('admin/class', ClassController::class);
    Route::get('admin/class/{class}', ['as' => 'class.delete', 'uses' => 'App\Http\Controllers\ClassController@destroy']);

    //subject
    Route::resource('admin/subject', SubjectController::class);
    Route::get('admin/subject/{subject}', ['as' => 'subject.delete', 'uses' => 'App\Http\Controllers\SubjectController@destroy']);

});

Route::group(['middleware' => 'teacher'], function (){
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard'])->name('teacher.dashboard');
});

Route::group(['middleware' => 'student'], function (){
    Route::get('student/dashboard', [DashboardController::class, 'dashboard'])->name('student.dashboard');
});

Route::group(['middleware' => 'parent'], function (){
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard'])->name('parent.dashboard');
});
