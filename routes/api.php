<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CongTyController;
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

Route::middleware('json')->middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware("auth")->get('/cong-ty', [CongTyController::class, 'index']);
Route::middleware("auth")->get('/cong-ty', [CongTyController::class, 'index']);
Route::get('/cong-ty/{id}', [CongTyController::class, 'show']);
Route::get('/cong-ty/viec-lam/{id}', [CongTyController::class, 'viecLamCongTy']);
// Route::resource('cong-ty', CongTyController::class);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});