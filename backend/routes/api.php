<?php

declare(strict_types=1);

use App\Http\Controllers\API\Auth\AuthController;

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
   Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
   Route::get('/me', [AuthController::class, 'me'])->name('me');
   Route::post('/password/change', [AuthController::class, 'changePassword'])->name('password.change');
   Route::patch('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
});
