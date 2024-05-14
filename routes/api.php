<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
    Route::post('logout', [AuthController::class, 'logout']);
});
