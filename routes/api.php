<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\RegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/events', EventController::class);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('events', [RegistrationController::class, 'index']);
    Route::post('events/{eventId}/subscribe', [RegistrationController::class, 'subscribeToEvent']);
    Route::post('events/{eventId}/unsubscribe', [RegistrationController::class, 'unsubscribeFromEvent']);
});
