<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
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
/*
Route::get('/login', [AccountController::class, 'login'])->name('home');
Route::post('/login', [AccountController::class, 'loginPost'])->name('login.post');

Route::middleware(['auth', 'role:1'])->group(function(){
    Route::resource('projects', App\Http\Controllers\ProjectController::class);
    Route::resource('accounts', App\Http\Controllers\AccountController::class);
    Route::resource('offices', App\Http\Controllers\OfficeController::class);
});

Route::middleware(['auth', 'role:0'])->group(function(){
    Route::resource('projects', App\Http\Controllers\ProjectController::class)->only('index', 'show', 'edit', 'update');
    Route::resource('accounts', App\Http\Controllers\AccountController::class)->only('index', 'edit', 'update');
});
*/


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('projects', App\Http\Controllers\ProjectController::class);
Route::resource('accounts', App\Http\Controllers\AccountController::class);
Route::resource('offices', App\Http\Controllers\OfficeController::class);

