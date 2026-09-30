<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/education', function () {
    return view('education');
})->name('education');

// Mengubah rute projects agar terhubung ke ProjectController (Mendukung Index, Create, Store, Show, Edit, Update, Destroy)
Route::resource('projects', ProjectController::class);