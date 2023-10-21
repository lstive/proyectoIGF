<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
   |--------------------------------------------------------------------------
   | API Routes
   |--------------------------------------------------------------------------
   |
   | Here is where you can register API routes for your application. These
   | routes are loaded by the RouteServiceProvider and all of them will
   | be assigned to the "api" middleware group. Make something great!
   |
 */
use App\Http\Controllers\Api\AdminController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getOperators', [AdminController::class, 'getOperators']);
Route::delete('/deleteOperator/{id}', [AdminController::class, 'destroyOperator']);
Route::post('/addOperator', [AdminController::class, 'addOperator']);

Route::get('/getDrivers', [AdminController::class, 'getDrivers']);
Route::delete('/deleteDriver/{id}', [AdminController::class, 'destroyDriver']);
Route::post('/addDriver', [AdminController::class, 'addDriver']);

Route::post('/addClient', [AdminController::class, 'addClient']);
Route::delete('/deleteClient/{id}', [AdminController::class, 'destroyClient']);

Route::post('/filterClients', [AdminController::class, 'filterClients']);
Route::post('/filterDrivers', [AdminController::class, 'filterDrivers']);

Route::post('/addTravel', [AdminController::class, 'addTravel']);
Route::delete('/deleteTravel/{id}', [AdminController::class, 'destroyTravel']);
