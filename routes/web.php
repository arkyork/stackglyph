<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Api\WordStatisticsController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');



Route::get('/themes/create', [ThemeController::class, 'create'])->name('themes.create');
Route::get('/themes', [ThemeController::class, 'index'])->name('themes.index');

Route::post('/themes', [ThemeController::class, 'store'])->name('themes.store');

Route::get('/themes/{theme}/edit', [ThemeController::class, 'edit'])->name('themes.edit');
Route::post('/themes/{theme}', [ThemeController::class, 'update'])->name('themes.update');
Route::delete('/themes/{theme}/word/{word}', [ThemeController::class, 'detachWord'])->name('themes.word.detach');



Route::get('/quiz', [QuizController::class, 'show'])->name('quiz.random');
Route::get('/quiz/{theme}', [QuizController::class, 'show'])->name('quiz.show');


Route::post('/api/word-statistics/update', [WordStatisticsController::class, 'update'])->name('api.word-statistics.update');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/ranking', [ThemeController::class, 'ranking'])->name('ranking');
