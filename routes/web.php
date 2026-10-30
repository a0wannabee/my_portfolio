<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;

// Halaman publik, bisa dibuka tanpa login
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/education', function () {
    return view('education');
})->name('education');

// Wajib login: URL jadi /post/..., nama route tetap projects.* agar view dan controller tidak perlu diubah
Route::prefix('post')->middleware('auth')->group(function () {
    Route::get('/profile-saya', function () {
        return view('profile-saya');
    })->name('profile.saya');

    // Kelola project hanya untuk admin (auth dulu, baru admin)
    Route::middleware('admin')->group(function () {
        // Rute Trash (soft delete) harus didaftarkan sebelum resource agar tidak bentrok dengan projects/{project}
        Route::get('/projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');
        Route::patch('/projects/{id}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
        Route::delete('/projects/{id}/force-delete', [ProjectController::class, 'forceDelete'])->name('projects.force-delete');

        // Mengubah rute projects agar terhubung ke ProjectController (Mendukung Index, Create, Store, Show, Edit, Update, Destroy)
        Route::resource('projects', ProjectController::class);
    });
});

// Bawaan Breeze: /dashboard diarahkan ke daftar project
Route::get('/dashboard', function () {
    return redirect()->route('projects.index');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
