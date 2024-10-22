<?php

use Illuminate\Support\Facades\Route;
use Spatie\Activitylog\Models\Activity;

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

Route::get('/', function () {
    //return Activity::all()->last();
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('projects', App\Http\Controllers\ProjectController::class);
Route::resource('accounts', App\Http\Controllers\AccountController::class);
Route::resource('offices', App\Http\Controllers\OfficeController::class);
Route::resource('dashboard', App\Http\Controllers\DashboardController::class);

