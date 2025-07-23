<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ImageGenerationController;

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/me', [AuthController::class, 'me'])->name('me');
    Route::post('/password/change', [AuthController::class, 'changePassword'])->name('password.change');
    Route::patch('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
});

Route::post('/requirements/generate', [RequirementController::class, 'generate']);
Route::get('/test', function () {
    return response()->json(['message' => 'API работает']);
});
Route::get('/history', [ChatController::class, 'history']);
Route::post('/chats', [ChatController::class, 'store']);
Route::put('/chats/{id}', [ChatController::class, 'update']);
Route::delete('/chats/{id}', [ChatController::class, 'destroy']);

Route::post('/generate-image', [ImageGenerationController::class, 'generate']);
Route::get('/messages/{chatId}', [MessageController::class, 'index']);
Route::post('/messages', [MessageController::class, 'store']);

