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

// login user
Route::get('/login', [UserController::class, 'index']);
Route::get('/auth', [UserController::class, 'login']);

// admin views
Route::middleware('auth.admin')->group(function () {
    Route::get('/admin', function () {
       return view('admin.index') ;
    });
});

// operator views
Route::middleware('auth.operator')->group(function () {
    Route::get('/operator', function () {
        return view('operator.index');
    });
});
