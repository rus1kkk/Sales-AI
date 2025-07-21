<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/check-db', function () {
    return config('database.connections.pgsql');
});

Route::middleware('auth')->get('/websockets', function () {
    return view('websockets');
});