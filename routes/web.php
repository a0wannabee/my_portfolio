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

// Rute Trash (soft delete) harus didaftarkan sebelum resource agar tidak bentrok dengan projects/{project}
Route::get('/projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');
Route::patch('/projects/{id}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
Route::delete('/projects/{id}/force-delete', [ProjectController::class, 'forceDelete'])->name('projects.force-delete');

// Mengubah rute projects agar terhubung ke ProjectController (Mendukung Index, Create, Store, Show, Edit, Update, Destroy)
Route::resource('projects', ProjectController::class);