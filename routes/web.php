<?php

use App\Http\Controllers\LogsController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth/login');
})->name('login');


Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    Route::get('change-password', [App\Http\Controllers\UserController::class, 'getChangePasswordForm'])->name('change.password.form');
    Route::post('change-password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('change.password');
});

Route::group(['middleware' => ['auth', 'checkRole:project manager']],function(){
    Route::resource('projects', App\Http\Controllers\ProjectController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('offices', App\Http\Controllers\OfficeController::class);
    Route::resource('logs', App\Http\Controllers\LogsController::class);
    Route::resource('dashboard', App\Http\Controllers\DashboardController::class);
});

Route::group(['middleware' => ['auth', 'checkRole:developer']], function(){
    Route::resource('projects', App\Http\Controllers\ProjectController::class)->only('index', 'show', 'edit', 'update');
    Route::resource('users', App\Http\Controllers\UserController::class)->only('index', 'edit', 'update');
    Route::resource('logs', App\Http\Controllers\LogsController::class);
    Route::resource('dashboard', App\Http\Controllers\DashboardController::class);
});



