<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequirementController;

Route::post('/requirements/generate', [RequirementController::class, 'generate']);
Route::get('/test', function () {
    return response()->json(['message' => 'API работает']);
});
