<?php

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
use App\Http\Controllers\UserController;

/* login */
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::get('/auth', [UserController::class, 'login']);


/* admins views */
Route::middleware('auth.admin')->prefix('admins')->group(function () {
    Route::get('/', function () {
        return view('admins.index');
    })->name('index');
});

/* operators views */
Route::middleware('auth.operator')->prefix('operators')->name('operators.')->group(function () {
    Route::get('/', function () {
        return view('operators.index');
    })->name('index');
});

/* logout */
Route::middleware('auth')->get('/logout', [UserController::class, 'logout']);
