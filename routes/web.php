<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;   // <-- ADD THIS LINE
Route::get('/', function () {
    return view('home');
});
Route::get('/search', [SearchController::class, 'search']);
