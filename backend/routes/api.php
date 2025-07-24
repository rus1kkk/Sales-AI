<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ImageGenerationController;
use App\Http\Controllers\PresentationController;

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
Route::get('/history', [HistoryController::class, 'history']);
Route::post('/chats', [HistoryController::class, 'store']);
Route::put('/chats/{id}', [HistoryController::class, 'update']);
Route::delete('/chats/{id}', [HistoryController::class, 'destroy']);
Route::get('/chats/{id}', [HistoryController::class, 'show']);

Route::post('/generate-image', [ImageGenerationController::class, 'generate']);
Route::get('/messages/{chatId}', [MessageController::class, 'index']);
Route::get('/messages/{chatId}', [MessageController::class, 'index']); //TODO: обернуть в sanctum
Route::post('/messages', [MessageController::class, 'store']);
Route::post('/messages/with-ai', [MessageController::class, 'storeWithAIResponse']);

Route::get('/presentation/{chatId}', [PresentationController::class, 'show']);
