<?php

use App\Http\Controllers\LogsController;
use App\Http\Controllers\OfficeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    if(Auth::check()){
        return redirect()->route('dashboard.index');
    }
    return view('auth/login');
})->name('home');


Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    Route::get('change-password', [App\Http\Controllers\UserController::class, 'getChangePasswordForm'])->name('change.password.form');
    Route::post('change-password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('change.password');
});

Route::group(['middleware' => ['auth', 'requirePasswordChange', 'checkProjectManager']],function(){
    Route::resource('projects', App\Http\Controllers\ProjectController::class)->only('create', 'store');
    Route::resource('users', App\Http\Controllers\UserController::class)->only('create', 'store');
    Route::resource('offices', App\Http\Controllers\OfficeController::class);
    Route::get('/offices/similar', [App\Http\Controllers\OfficeController::class, 'similar'])->name('offices.similar');
});

Route::group(['middleware' => ['auth', 'requirePasswordChange','checkProjectManagerOrDeveloper']], function(){
    Route::resource('projects', App\Http\Controllers\ProjectController::class)->except('create', 'store');
    Route::resource('users', App\Http\Controllers\UserController::class)->except('create', 'store');
    Route::resource('logs', App\Http\Controllers\LogsController::class);
    Route::resource('dashboard', App\Http\Controllers\DashboardController::class);
});




