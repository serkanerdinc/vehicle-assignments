<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleAssignmentController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Kullanıcı girişi
Route::post('login', [AuthController::class, 'login']);

// Middleware tanımlama
Route::middleware('jwt.auth')->group(function () {
    // Token yenileme
    Route::get('refresh', [AuthController::class, 'refresh']);

    // Kullanıcı çıkış
    Route::delete('logout', [AuthController::class, 'logout']);

    //users
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });

    //vehicle
    Route::group(['prefix' => 'vehicles'], function () {
        Route::get('/', [VehicleController::class, 'index']);
        Route::post('/', [VehicleController::class, 'store']);
        Route::get('/{vehicleId}', [VehicleController::class, 'show']);
        Route::put('/{vehicleId}', [VehicleController::class, 'update']);
        Route::delete('/{vehicleId}', [VehicleController::class, 'destroy']);

        //vehicle assignment
        Route::group(['prefix' => '/{vehicleId}/assignments'], function () {
            Route::get('/', [VehicleAssignmentController::class, 'index']);
            Route::post('/', [VehicleAssignmentController::class, 'store']);
            Route::get('/{assignment}', [VehicleAssignmentController::class, 'show']);
            Route::put('/{id}', [VehicleAssignmentController::class, 'update']);
            Route::delete('/{id}', [VehicleAssignmentController::class, 'destroy']);
        });
    });
});
