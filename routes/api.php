<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::options('/login', function () {
    return response()->json([], 204);
});

Route::post('/login', function (Request $request) {
    return response()->json(['ok' => true]);

});
Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('/user', UserController::class);

    Route::post('/logout', [AuthController::class . 'logout']);
});
