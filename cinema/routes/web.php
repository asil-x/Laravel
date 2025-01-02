<?php

use App\Http\Controllers\DistributorController;
use App\Http\Controllers\GenereController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('movies', MovieController::class);
    Route::resource('distributors', DistributorController::class);
    Route::resource('genere', GenereController::class);

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class)->except(['edit', 'update']);
    });
});

require __DIR__.'/auth.php';
