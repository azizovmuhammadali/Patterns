<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::middleware('language')->group(function(){
    Route::middleware('auth:sanctum')->group(function(){
      Route::get('user',[AuthController::class,'findUser']);
      Route::get('logout',[AuthController::class,'logout']);
});
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::get('email-verify',[AuthController::class,'verifyEmail']);
});