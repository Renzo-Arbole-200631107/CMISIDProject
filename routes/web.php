<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () { 
    return view('auth/login');
})->name('login');


Auth::routes();

Route::group(['middleware' => ['auth', 'checkRole:project manager']],function(){
    Route::resource('projects', App\Http\Controllers\ProjectController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('offices', App\Http\Controllers\OfficeController::class);
});

Route::group(['middleware' => ['auth', 'checkRole:developer']], function(){
    Route::resource('projects', App\Http\Controllers\ProjectController::class)->only('index', 'show', 'edit', 'update');
    Route::resource('users', App\Http\Controllers\UserController::class)->only('index', 'edit', 'update');
});



