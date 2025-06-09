<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Api\WordStatisticsController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\SearchController;

use App\Http\Controllers\PostController;


//　ホーム

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/policy', [PostController::class, 'policy'])->name('policy');

Route::get('/howto', [PostController::class,'howto'])->name('howto');

// クイズ

Route::get('/quiz/random', [QuizController::class, 'randomShow'])->name('quiz.random');
Route::get('/quiz/{theme}', [QuizController::class, 'show'])->name('quiz.show');
Route::post('/api/word-statistics/update', [WordStatisticsController::class, 'update'])->name('api.word-statistics.update');


Route::get('/words/{word}', [WordController::class, 'show'])->name('words.show');


Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');


Route::get('/sitemap.xml', [SitemapController::class, 'sitemap'])->name('sitemap.sitemap');


Route::get('/sitemap/words.xml', [SitemapController::class, 'wordSitemap'])->name('sitemap.word');
Route::get('/sitemap/words-{page}.xml', [SitemapController::class, 'wordSitemapPage'])->name('sitemap.word.page');


Route::get('/sitemap/quiz.xml', [SitemapController::class, 'quizSitemap'])->name('sitemap.quiz');


// ランキング


Route::get('/ranking', [RankingController::class, 'ranking'])->name('ranking');

Route::get('/ranking/play_count', [RankingController::class, 'playCount'])->name('ranking.play_count');
Route::get('/ranking/correct_count', [RankingController::class, 'correctCount'])->name('ranking.correct_count');
Route::get('/ranking/hint_count', [RankingController::class, 'hintCount'])->name('ranking.hint_count');
Route::get('/ranking/flashcard_count', [RankingController::class, 'flashcardCount'])->name('ranking.flashcard_count');

// 検索
Route::get('/search', [SearchController::class, 'index'])->name('search.index');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/themes/create', [ThemeController::class, 'create'])->name('themes.create');
    Route::get('/themes', [ThemeController::class, 'index'])->name('themes.index');
    
    Route::post('/themes', [ThemeController::class, 'store'])->name('themes.store');
    
    Route::get('/themes/{theme}/edit', [ThemeController::class, 'edit'])->name('themes.edit');
    Route::post('/themes/{theme}', [ThemeController::class, 'update'])->name('themes.update');
    Route::delete('/themes/{theme}/word/{word}', [ThemeController::class, 'detachWord'])->name('themes.word.detach');

});