<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Application routes for regular users
    Route::get('/apply', [ApplicationController::class, 'create'])->name('application.create');
    Route::post('/apply', [ApplicationController::class, 'store'])->name('application.store');
    
    // Admin-only routes with gate check
    Route::middleware('can:manage-applications')->group(function() {
        Route::get('/applications', [ApplicationController::class, 'index'])->name('application.index');
        Route::get('/applications/{id}', [ApplicationController::class, 'show'])->name('application.show');
        Route::patch('/applications/{id}/status', [ApplicationController::class, 'updateStatus'])->name('application.status.update');
        Route::delete('/applications/{id}', [ApplicationController::class, 'destroy'])->name('application.destroy');
    });
});

require __DIR__.'/auth.php';
