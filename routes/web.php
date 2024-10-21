<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
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
    return view('auth/login');
});


Auth::routes();
/** 
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('projects', App\Http\Controllers\ProjectController::class);
Route::resource('users', App\Http\Controllers\UserController::class);
//Route::resource('accounts', App\Http\Controllers\UserController::class);
Route::resource('offices', App\Http\Controllers\OfficeController::class);
*/







Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginPost'])->name('loginPost');


Route::group(['middleware' => ['auth', 'checkRole:1']], function(){
    Route::resource('projects', App\Http\Controllers\ProjectController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('offices', App\Http\Controllers\OfficeController::class);
});

Route::middleware(['auth', 'checkRole:0'])->group(function(){
    Route::resource('projects', App\Http\Controllers\ProjectController::class)->only('index', 'show', 'edit', 'update');
    Route::resource('accounts', App\Http\Controllers\AccountController::class)->only('index', 'edit', 'update');
});

