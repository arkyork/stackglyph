<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\Theme;
use App\Models\Category;

class QuizController extends Controller
{
    public function randomShow()
    {
        $word = Word::inRandomOrder()->first();

        return view('quiz.show', [
            'word' => $word,
        ]);
    }
    public function show(Theme $theme)
    {
        $categories = Category::all();

        $words = $theme->words()->inRandomOrder()->with('wordStatistics')->limit(10)->get();
    
        if ($words->isEmpty()) {
            abort(404);
        }
    
        return view('quiz.batch', [
            'theme' => $theme,
            'words' => $words,
            'categories' => $categories
        ]);
    }
}
