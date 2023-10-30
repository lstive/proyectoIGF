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
use App\Http\Controllers\DriverController;

/* login */
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::get('/auth', [UserController::class, 'login']);
Route::get('/', function () {
    return redirect(route('login'));
});


/* admins views */
Route::middleware('auth.admin')->prefix('admins')->name('admins.')->group(function () {
    Route::get('/', function () {
        return view('admins.index');
    })->name('index');

    Route::get('/operators', [UserController::class, 'operators'])->name('operators');
    Route::get('/drivers', [UserController::class, 'drivers'])->name('drivers');
});

/* operators views */
Route::middleware('auth.operator')->prefix('operators')->name('operators.')->group(function () {
    Route::get('/', function () {
        return view('operators.index');
    })->name('index');

    Route::get('/clients', [UserController::class, 'clients'])->name('clients');
    Route::get('/trips', [UserController::class, 'trips'])->name('trips');
    Route::get('/travels', [UserController::class, 'travels'])->name('travels');
});

Route::middleware('auth.driver')->prefix('drivers')->name('drivers.')->group(function () {
    Route::get('/', function () {
        return view('drivers.index');
    })->name('index');
    Route::get('/available', [DriverController::class, 'available'])->name('available');
    Route::get('/doing', [DriverController::class, 'doing'])->name('doing');
});

/* logout */
Route::middleware('auth')->get('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::middleware('auth.driver')->get('/logoutDriver', [UserController::class, 'logoutDriver'])->name('user.logoutDriver');
