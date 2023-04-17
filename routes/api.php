<?php

use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();});

Route::middleware(['jwt.verify'])->group(function () {
Route::get('/categories',[ApiController::class,'categories']);
Route::get('/category/{id}',[ApiController::class,'category']);
Route::post('/store',[ApiController::class,'store']);
Route::post('/update/{id}',[ApiController::class,'update']);
Route::post('/delete/{id}',[ApiController::class,'delete']);
});