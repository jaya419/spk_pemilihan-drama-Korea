<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DramaController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;



Route::middleware('auth')->group(function () {
Route::get('/dashboard', [ScoreController::class, 'dashboard'])->name('dashboard');

// Drama Routes
Route::get('/drama', [DramaController::class, 'index'])->name('drama.index');
Route::get('/drama/create', [DramaController::class, 'create'])->name('drama.create');
Route::post('/drama', [DramaController::class, 'store'])->name('drama.store');
Route::get('/drama/{id}/edit', [DramaController::class, 'edit'])->name('drama.edit');
Route::put('/drama/{id}', [DramaController::class, 'update'])->name('drama.update');
Route::delete('/drama/{id}', [DramaController::class, 'destroy'])->name('drama.destroy');

// Genre Routes
Route::get('/genre', [GenreController::class, 'index'])->name('genre.index');
Route::get('/genre/create', [GenreController::class, 'create'])->name('genre.create');
Route::post('/genre', [GenreController::class, 'store'])->name('genre.store');
Route::get('/genre/{id}/edit', [GenreController::class, 'edit'])->name('genre.edit');
Route::put('/genre/{id}', [GenreController::class, 'update'])->name('genre.update');
Route::delete('/genre/{id}', [GenreController::class, 'destroy'])->name('genre.destroy');

// Score Routes
Route::get('/score', [ScoreController::class, 'index'])->name('score.index');
Route::post('/score', [ScoreController::class, 'store'])->name('score.store');
Route::get('/result', [ScoreController::class, 'calculateSAW'])->name('score.result');
});

Route::get('/register', [RegisterController::class, 'showForm'])->name('auth.register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::post('/login-proses', [AuthController::class, 'login'])->name('loginproccess');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');