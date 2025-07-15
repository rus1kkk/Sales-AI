<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\ChatController;

Route::post('/requirements/generate', [RequirementController::class, 'generate']);
Route::get('/test', function () {
    return response()->json(['message' => 'API работает']);
});
Route::get('/history', [ChatController::class, 'history']);
Route::post('/chats', [ChatController::class, 'store']);
Route::put('/chats/{id}', [ChatController::class, 'update']);
Route::delete('/chats/{id}', [ChatController::class, 'destroy']);
