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

Route::delete('/deleteOperator/{id}', [AdminController::class, 'destroyOperator']);
Route::post('/addOperator', [AdminController::class, 'addOperator']);

// con {id} es el name en backend
Route::delete('/deleteDriver/{id}', [AdminController::class, 'destroyDriver']);
Route::post('/addDriver', [AdminController::class, 'addDriver']);
